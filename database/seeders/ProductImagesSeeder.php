<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductImagesSeeder extends Seeder
{
    public function run(): void
    {
        // Mapeo de productos por colección
        $imageMapping = [
            'resilencia' => [
                'Espalda-hombre-LOW.png',
                'hombre frente resilence.png',
                'hombre espalda resilence.png',
                'ghost manekin resilence.png',
                'mujer frente resilence.png',
                'mujer espalda resilence.png',
                'resilence Detail.jpg',
            ],
            'willpower' => [
                'Pose-Frontal-HOMBRE-LOW.png',
                'Espalda hombre willpower.jpg',
                'hombre frente resilence.png',
                'Ghost Mannequin willpower.png',
                'mujer frente resilence.png',
                'Mujer Espalda willpower.jpg',
                'resilence Detail.jpg',
            ],
            'gratitude' => [
                'Pose-Frontal-HOMBRE-LOW.png',
                'Espalda hombre gratitude.jpg',
                'hombre frente resilence.png',
                'Ghost Mannequin gratitude.png',
                'mujer frente resilence.png',
                'Mujer Espalda gratitude.jpg',
                'resilence Detail.jpg',
            ],
        ];

        foreach ($imageMapping as $collection => $images) {
            $products = Product::where('collection', $collection)->get();
            
            foreach ($products as $product) {

            // Eliminar imágenes existentes del storage
            foreach (ProductImage::where('product_id', $product->id)->get() as $img) {
                Storage::disk('public')->delete($img->path);
            }
            ProductImage::where('product_id', $product->id)->delete();

            $sourcePath = "c:\\Users\\Tucalzado\\Pictures\\Gutural\\Recursos\\SHOP\\{$collection}\\";
            
            foreach ($images as $index => $imageName) {
                $sourceFile = $sourcePath . $imageName;
                
                if (File::exists($sourceFile)) {
                    $extension = pathinfo($imageName, PATHINFO_EXTENSION);
                    $newFileName = "products/{$product->id}/" . uniqid() . ".{$extension}";
                    
                    // Crear directorio si no existe
                    Storage::disk('public')->makeDirectory("products/{$product->id}");
                    
                    // Copiar imagen
                    Storage::disk('public')->put($newFileName, File::get($sourceFile));
                    
                    // Crear registro en base de datos
                    ProductImage::create([
                        'product_id' => $product->id,
                        'path' => $newFileName,
                        'sort_order' => $index,
                        'is_primary' => $index === 0,
                    ]);
                }
            }
            }
        }
    }
}
