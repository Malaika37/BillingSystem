<?php

namespace Database\Seeders;
use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::insert([
            [
                'name' => 'Office Chair',
                'price' => 8000,
                
            ],
            [
                'name' => 'Round Table',
                'price' => 15000,
            ],
            [
                'name' => 'Square Table',
                'price' => 17000,
            ],
            [
                'name' => 'Book Case',
                'price' => 5000,
            ],
            [
                'name' => 'Conference Table',
                'price' => 20000,
            ],
            [
              'name' => 'Pens',
              'price' => 50,  
            ],
            [
                'name' => 'Highlighter',
                'price' => 100,
            ],
            [
                'name' => 'Sticky Notes',
                'price' => 120,
            ],
            [
                'name' => 'Scissors',
                'price' => 200,
            ],
        ]);
    }
}
