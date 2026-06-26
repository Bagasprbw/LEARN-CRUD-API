<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Elektronik'],
            ['name' => 'Pakaian'],
            ['name' => 'Makanan & Minuman'],
            ['name' => 'Kesehatan & Kecantikan'],
            ['name' => 'Olahraga'],
            ['name' => 'Rumah Tangga'],
            ['name' => 'Buku & Alat Tulis'],
            ['name' => 'Otomotif'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category['name']]);
        }
    }
}
