<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name'        => 'Resilencia',
                'description' => 'Colección de T-Shirts Resilencia - Diseños exclusivos que representan fuerza y perseverancia',
                'price'       => 45.00,
                'type'        => 'tshirt',
                'collection'  => 'resilencia',
                'images'      => [
                    'hombre espalda resilence.png',
                    'Espalda-hombre-LOW.png',
                    'hombre frente resilence.png',
                    'Pose-Frontal-HOMBRE-LOW.png',
                    'mujer frente resilence.png',
                    'mujer espalda resilence.png',
                    'Mujer Espalda resilence.jpg',
                    'ghost manekin resilence.png',
                    'resilence Detail.jpg',
                ],
                'variants'    => [
                    ['color' => 'Blanco', 'hex' => '#FFFFFF', 'sizes' => ['S', 'M', 'L', 'XL']],
                    ['color' => 'Negro', 'hex' => '#000000', 'sizes' => ['S', 'M', 'L', 'XL']],
                ],
            ],
            [
                'name'        => 'Willpower',
                'description' => 'Colección de T-Shirts Willpower - Diseños que representan determinación y fuerza de voluntad',
                'price'       => 45.00,
                'type'        => 'tshirt',
                'collection'  => 'willpower',
                'images'      => [
                    'Espalda hombre willpower.jpg',
                    'Pose-Frontal-HOMBRE-LOW.png',
                    'hombre frente resilence.png',
                    'mujer frente resilence.png',
                    'Mujer Espalda willpower.jpg',
                    'Ghost Mannequin willpower.png',
                    'resilence Detail.jpg',
                ],
                'variants'    => [
                    ['color' => 'Blanco', 'hex' => '#FFFFFF', 'sizes' => ['S', 'M', 'L', 'XL']],
                    ['color' => 'Negro', 'hex' => '#000000', 'sizes' => ['S', 'M', 'L', 'XL']],
                ],
            ],
            [
                'name'        => 'Gratitude',
                'description' => 'Colección Gratitude - Mono exclusivo que representa gratitud y abundancia',
                'price'       => 75.00,
                'type'        => 'mono',
                'collection'  => 'gratitude',
                'images'      => [
                    'Pose-Frontal-HOMBRE-LOW.png',
                    'Espalda hombre gratitude.jpg',
                    'hombre frente resilence.png',
                    'Ghost Mannequin gratitude.png',
                    'mujer frente resilence.png',
                    'Mujer Espalda gratitude.jpg',
                    'resilence Detail.jpg',
                ],
                'variants'    => [
                    ['color' => 'Blanco', 'hex' => '#FFFFFF', 'sizes' => ['S', 'M', 'L', 'XL']],
                    ['color' => 'Negro', 'hex' => '#000000', 'sizes' => ['S', 'M', 'L', 'XL']],
                ],
            ],
        ];

        foreach ($products as $data) {
            // Avoid duplicates on re-seed
            $product = Product::updateOrCreate(
                ['slug' => Str::slug($data['name'])],
                [
                    'name'        => $data['name'],
                    'description' => $data['description'],
                    'price'       => $data['price'],
                    'type'        => $data['type'],
                    'collection'  => $data['collection'],
                    'is_active'   => true,
                ]
            );

            // Clear existing images and variants on re-seed
            foreach ($product->images as $img) {
                Storage::disk('public')->delete($img->path);
            }
            $product->images()->delete();
            $product->variants()->delete();

            // Create directory for product images
            Storage::disk('public')->makeDirectory("products/{$product->id}");

            // Copy images from public/images/shop to storage
            $sourceDir = public_path("images/shop/{$data['collection']}");
            
            foreach ($data['images'] as $order => $imageName) {
                $srcPath = $sourceDir . '/' . $imageName;
                
                if (file_exists($srcPath)) {
                    $ext      = pathinfo($srcPath, PATHINFO_EXTENSION);
                    $filename = pathinfo($srcPath, PATHINFO_FILENAME) . '.' . $ext;
                    $destPath = "products/{$product->id}/{$filename}";

                    Storage::disk('public')->put($destPath, file_get_contents($srcPath));

                    ProductImage::create([
                        'product_id' => $product->id,
                        'path'       => $destPath,
                        'is_primary' => $order === 0,
                        'sort_order' => $order,
                    ]);
                }
            }

            // Create variants
            foreach ($data['variants'] as $variantData) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'color'      => $variantData['color'],
                    'hex_color'  => $variantData['hex'],
                    'sizes'      => $variantData['sizes'],
                ]);
            }

            $this->command->info("✓ Seeded: {$product->name} ({$product->images->count()} images, {$product->variants->count()} variants)");
        }
    }
}
