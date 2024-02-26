<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Services\SlugService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Mingi de Baschet',
            ],
            [
                'name' => 'Echipamente de Antrenament',
            ],
            [
                'name' => 'Tricouri și Pantaloni',
            ],
            [
                'name' => 'Protecții și Echipamente de Siguranță',
            ],
            [
                'name' => 'Accesorii și Îngrijire pentru Echipament',
            ]
        ];

        foreach ($categories as $category) {
            Category::insert([
                'name' => $category['name'],
                'slug' => SlugService::createForModel(Category::class, $category['name']),
            ]);
        }
    }
}
