<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImportResilienceImages extends Command
{
    protected $signature = 'import:resilience-images';
    protected $description = 'Importar imágenes de RESILENCIA desde la carpeta de recursos';

    public function handle()
    {
        $sourceDir = 'C:\Users\Tucalzado\Pictures\Gutural\Recursos\SHOP\resilence';
        
        if (!File::exists($sourceDir)) {
            $this->error("La carpeta fuente no existe: {$sourceDir}");
            return 1;
        }

        $product = Product::where('slug', 'resilencia')
            ->orWhere('slug', 'resilience')
            ->orWhere('name', 'like', '%resilencia%')
            ->orWhere('name', 'like', '%resilience%')
            ->first();

        if (!$product) {
            $this->error('No se encontró el producto RESILENCIA en la base de datos');
            return 1;
        }

        $this->info("Producto encontrado: {$product->name} (ID: {$product->id})");

        $this->info('Eliminando imágenes existentes...');
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }

        $images = File::files($sourceDir);
        
        if (empty($images)) {
            $this->error('No se encontraron imágenes en la carpeta');
            return 1;
        }

        $this->info("Se encontraron " . count($images) . " imágenes");

        $primaryOrder = [
            'ghost manekin resilence.png',
            'hombre frente resilence.png',
            'Pose-Frontal-HOMBRE-LOW.png',
        ];

        $sortOrder = 0;
        $primarySet = false;

        foreach ($images as $image) {
            $filename = $image->getFilename();
            $extension = $image->getExtension();
            
            $newFilename = 'products/resilencia/' . time() . '_' . $sortOrder . '.' . $extension;
            
            Storage::disk('public')->makeDirectory('products/resilencia');
            Storage::disk('public')->put($newFilename, File::get($image->getPathname()));
            
            $isPrimary = !$primarySet && in_array($filename, $primaryOrder);
            if ($isPrimary) {
                $primarySet = true;
            }
            
            ProductImage::create([
                'product_id' => $product->id,
                'path' => $newFilename,
                'is_primary' => $isPrimary,
                'sort_order' => $sortOrder,
            ]);
            
            $this->info("✓ Importada: {$filename}" . ($isPrimary ? ' (PRINCIPAL)' : ''));
            $sortOrder++;
        }

        if (!$primarySet) {
            $firstImage = $product->images()->first();
            if ($firstImage) {
                $firstImage->update(['is_primary' => true]);
                $this->info('Se estableció la primera imagen como principal');
            }
        }

        $this->info("\n✓ Proceso completado exitosamente!");
        $this->info("Total de imágenes importadas: {$sortOrder}");

        return 0;
    }
}
