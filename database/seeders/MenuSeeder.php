<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menu = [
            'Kopi' => [
                ['Kopi Susu Gula Aren', 22000, 'Espresso, susu segar, dan gula aren.', true],
                ['Americano', 18000, 'Espresso dengan air panas atau es.', false],
            ],
            'Makanan Berat' => [
                ['Nasi Goreng Special', 35000, 'Nasi goreng dengan telur, ayam, dan acar.', true],
                ['Mie Goreng Jawa', 32000, 'Mie goreng bumbu khas dengan sayuran.', false],
            ],
            'Camilan' => [
                ['Kentang Goreng', 20000, 'Kentang goreng renyah dengan saus pilihan.', false],
            ],
        ];

        foreach (array_keys($menu) as $i => $categoryName) {
            $category = Category::updateOrCreate(
                ['slug' => Str::slug($categoryName)],
                ['name' => $categoryName, 'sort_order' => $i]
            );

            foreach ($menu[$categoryName] as [$name, $price, $desc, $featured]) {
                Product::updateOrCreate(
                    ['slug' => Str::slug($name)],
                    [
                        'category_id'  => $category->id,
                        'name'         => $name,
                        'description'  => $desc,
                        'price'        => $price,
                        'is_featured'  => $featured,
                        'is_available' => true,
                    ]
                );
            }
        }
    }
}