<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Invoice</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            margin: 30px;
            color: #000;
        }

        h1 {
            text-align: center;
            margin-bottom: 0;
        }

        h3 {
            text-align: center;
            margin-top: 5px;
            margin-bottom: 20px;
        }

        hr {
            border: 1px solid #000;
            margin-bottom: 20px;
        }

        .info {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .info td {
            padding: 5px;
        }

        .items {
            width: 100%;
            border-collapse: collapse;
        }

        .items th {
            border: 1px solid black;
            background: #e5e5e5;
            padding: 8px;
            text-align: center;
        }

        .items td {
            border: 1px solid black;
            padding: 8px;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        .summary {
            width: 40%;
            margin-top: 20px;
            margin-left: auto;
            border-collapse: collapse;
        }

        .summary td {
            border: 1px solid black;
            padding: 8px;
        }

        .net {
            font-weight: bold;
            background: #e5e5e5;
        }

        .footer {
            margin-top: 60px;
            text-align: center;
            font-size: 12px;
        }
    </style>

</head>

<body>

<h1>SKYLINE BILLING SYSTEM</h1>
<h3>SALES INVOICE</h3>

<hr>

<table class="info">

    <tr>
        <td>
            <strong>Invoice No:</strong>
            {{ $bill->invoice_number }}
        </td>

        <td class="right">
            <strong>Date:</strong>
            {{ $bill->invoice_date }}
        </td>
    </tr>

    <tr>
        <td>
            <strong>Customer:</strong>
            {{ $bill->customer->name }}
        </td>

        <td class="right">
            <strong>WhatsApp:</strong>
            {{ $bill->customer->whatsapp }}
        </td>
    </tr>

</table>

<table class="items">

    <thead>

    <tr>
        <th width="45%">Item</th>
        <th width="15%">Qty</th>
        <th width="20%">Price</th>
        <th width="20%">Amount</th>
    </tr>

    </thead>

    <tbody>

    @foreach($bill->billItems as $item)

    <tr>

        <td>
            {{ $item->item->name }}
        </td>

        <td class="center">
            {{ $item->quantity }}
        </td>

        <td class="right">
            {{ number_format($item->price,2) }}
        </td>

        <td class="right">
            {{ number_format($item->amount,2) }}
        </td>

    </tr>

    @endforeach

    </tbody>

</table>

<table class="summary">

    <tr>
        <td><strong>Gross Amount</strong></td>
        <td class="right">
            {{ number_format($bill->gross_amount,2) }}
        </td>
    </tr>

    <tr>
        <td><strong>Discount ({{ $bill->discount_percentage }}%)</strong></td>
        <td class="right">
            {{ number_format($bill->discount_amount,2) }}
        </td>
    </tr>

    <tr class="net">
        <td>Net Amount</td>
        <td class="right">
            {{ number_format($bill->net_amount,2) }}
        </td>
    </tr>

</table>

<div class="footer">

    <hr>

    <strong>Thank You For Your Order!</strong>

    <br><br>

    <span>This is a computer generated invoice.</span>

</div>

</body>

</html>