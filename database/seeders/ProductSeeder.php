<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Services\SlugService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Mingi de Baschet
            [
                'category_id' => NULL, // Acest id trebuie să se potrivească cu id-ul categoriei 'Mingi de Baschet'
                'name' => 'Mingie de Baschet Nike',
                'description' => 'Descriere pentru mingie de baschet Nike.',
                'availability' => 0,
                'price' => 99.99,
                'image' => 'mingie-nike.jpg',
            ],
            [
                'category_id' => 1,
                'name' => 'Mingie de Baschet Adidas',
                'description' => 'Descriere pentru mingie de baschet Adidas.',
                'availability' => true,
                'price' => 89.99,
                'image' => 'mingie-adidas.jpg',
            ],
            [
                'category_id' => 1,
                'name' => 'Mingie de Baschet Spalding',
                'description' => 'Descriere pentru mingie de baschet Spalding.',
                'availability' => false,
                'price' => 79.99,
                'image' => 'mingie-spalding.jpg',
            ],

            // Echipamente de Antrenament
            [
                'category_id' => 2,
                'name' => 'Bandă de Rezistență',
                'description' => 'Descriere pentru bandă de rezistență.',
                'availability' => false,
                'price' => 29.99,
                'image' => 'banda-rezistenta.jpg',
            ],
            [
                'category_id' => 2,
                'name' => 'Cinele pentru Antrenament',
                'description' => 'Descriere pentru cinele pentru antrenament.',
                'availability' => false,
                'price' => 49.99,
                'image' => 'cinele-antrenament.jpg',
            ],
            [
                'category_id' => 2,
                'name' => 'Conuri de Antrenament',
                'description' => 'Descriere pentru conuri de antrenament.',
                'availability' => false,
                'price' => 19.99,
                'image' => 'conuri-antrenament.jpg',
            ],

            // Tricouri și Pantaloni
            [
                'category_id' => 3,
                'name' => 'Tricou Nike',
                'description' => 'Descriere pentru tricou Nike.',
                'availability' => false,
                'price' => 39.99,
                'image' => 'tricou-nike.jpg',
            ],
            [
                'category_id' => 3,
                'name' => 'Pantaloni Adidas',
                'description' => 'Descriere pentru pantaloni Adidas.',
                'availability' => true,
                'price' => 59.99,
                'image' => 'pantaloni-adidas.jpg',
            ],
            [
                'category_id' => 3,
                'name' => 'Tricou Under Armour',
                'description' => 'Descriere pentru tricou Under Armour.',
                'availability' => true,
                'price' => 34.99,
                'image' => 'tricou-under-armour.jpg',
            ],

            // Protecții și Echipamente de Siguranță
            [
                'category_id' => 4,
                'name' => 'Genunchiere de Protecție',
                'description' => 'Descriere pentru genunchiere de protecție.',
                'availability' => true,
                'price' => 19.99,
                'image' => 'genunchiere-protectie.jpg',
            ],
            [
                'category_id' => 4,
                'name' => 'Coate de Protecție',
                'description' => 'Descriere pentru coate de protecție.',
                'availability' => true,
                'price' => 14.99,
                'image' => 'coate-protectie.jpg',
            ],
            [
                'category_id' => 4,
                'name' => 'Casca de Baschet',
                'description' => 'Descriere pentru cască de baschet.',
                'availability' => false,
                'price' => 39.99,
                'image' => 'casca-baschet.jpg',
            ],

            // Accesorii și Îngrijire pentru Echipament
            [
                'category_id' => 5,
                'name' => 'Pompa de Mingi',
                'description' => 'Descriere pentru pompă de mingi.',
                'availability' => true,
                'price' => 9.99,
                'image' => 'pompa-mingi.jpg',
            ],
            [
                'category_id' => 5,
                'name' => 'Spray Igienizant',
                'description' => 'Descriere pentru spray igienizant.',
                'availability' => true,
                'price' => 4.99,
                'image' => 'spray-igienizant.jpg',
            ],
            [
                'category_id' => 5,
                'name' => 'Ghiozdan de Baschet',
                'description' => 'Descriere pentru ghiozdan de baschet.',
                'availability' => 0,
                'price' => 49.99,
                'image' => 'ghiozdan-baschet.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate([
                'name' => $product['name'],
                'category_id' => $product['category_id'],
                'description' => $product['description'],
                'availability' => $product['availability'],
                'price' => $product['price'],
                'image' => $product['image'],
                'slug' => SlugService::createForModel(Product::class, $product['name']),
            ]);
        }
    }
}
