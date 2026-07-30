<?php

namespace App\Services;

use App\Models\Bill;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;

class WhatsAppServices
{
    private $apiUrl;
    private $token;
    private $phoneNumberId;
    private $version;
    private $templateName;

    public function __construct()
    {
        $this->apiUrl = config('whatsapp.api_url');
        $this->token = config('whatsapp.token');
        $this->phoneNumberId = config('whatsapp.phone_number_id');
        $this->version = config('whatsapp.version');
        $this->templateName = config('whatsapp.template_name');
        
    }

    public function uploadDocument($pdfPath)
    {
        $url = $this->apiUrl . '/' . $this->version . '/' . $this->phoneNumberId . '/media';

        $response = Http::withToken($this->token)
            ->attach(
                'file',
                fopen($pdfPath, 'r'),
                basename($pdfPath)
            )
            ->post($url, [
                'messaging_product' => 'whatsapp',
            ]);

        if ($response->successful()) {
            return $response->json()['id'];
        }

        throw new \Exception($response->body());
    }

    public function sendDocument($phone, $mediaId, $fileName)
    {
        $url = $this->apiUrl . '/' . $this->version . '/' . $this->phoneNumberId . '/messages';

        $response = Http::withToken($this->token)
            ->post($url, [
                'messaging_product' => 'whatsapp',
                'to' => $phone,
                'type' => 'document',
                'document' => [
                    'id' => $mediaId,
                    'filename' => $fileName,
                ],
            ]);

        if ($response->successful()) {
            return true;
        }

        throw new \Exception($response->body());
    }

    public function sendTemplateDocument($phone, $mediaId, Bill $bill)
    {
        $url = $this->apiUrl . '/' . $this->version . '/' . $this->phoneNumberId . '/messages';

        $response = Http::withToken($this->token)
            ->post($url, [
                'messaging_product' => 'whatsapp',
                'to' => $phone,
                'type' => 'template',

                'template' => [
                    'name' => $this->templateName,

                    'language' => [
                        'code' => 'en'
                    ],

                    'components' => [

                        [
                            'type' => 'header',
                            'parameters' => [
                                [
                                    'type' => 'document',
                                    'document' => [
                                        'id' => $mediaId,
                                        'filename' => 'Invoice_' . $bill->invoice_number . '.pdf',
                                    ]
                                ]
                            ]
                        ],

                        [
                            'type' => 'body',
                            'parameters' => [
                                [
                                    'type' => 'text',
                                    'text' => $bill->customer->name,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $bill->invoice_number,
                                ]
                            ]
                        ]

                    ]
                ]
            ]);

        if ($response->successful()) {
            return true;
        }

        throw new \Exception($response->body());
    }

    public function sendInvoice(Bill $bill)
    {
        $bill->load('customer', 'billItems.item');

        $fileName = 'Invoice_' . $bill->invoice_number . '.pdf';
        $pdfPath = storage_path('app/temp/' . $fileName);

        $pdf = Pdf::loadView('invoicePdf', compact('bill'));
        $pdf->save($pdfPath);

        $mediaId = $this->uploadDocument($pdfPath);

        $phone = $bill->customer->whatsapp;
       

      $this->sendTemplateDocument(
    $phone,
    $mediaId,
    $bill
);
        

        if (file_exists($pdfPath)) {
            unlink($pdfPath);
        }
    }
}