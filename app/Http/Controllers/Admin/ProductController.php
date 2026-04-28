<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with('images')->latest()->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        return view('admin.products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'type'        => ['required', 'in:tshirt,mono,accesorio'],
            'collection'  => ['required', 'in:resilencia,willpower,gratitude,general'],
            'is_active'   => ['boolean'],
            'images'      => ['nullable', 'array'],
            'images.*'    => ['image', 'max:5120'],
            'variants'    => ['nullable', 'array'],
        ]);

        $product = Product::create([
            'name'        => $validated['name'],
            'slug'        => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'price'       => $validated['price'],
            'type'        => $validated['type'],
            'collection'  => $validated['collection'],
            'is_active'   => $request->boolean('is_active', true),
        ]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store("products/{$product->id}", 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'path'       => $path,
                    'is_primary' => $index === 0,
                    'sort_order' => $index,
                    'color'      => $request->input("image_colors.{$index}") ?: null,
                ]);
            }
        }

        // Handle variants
        if ($request->has('variants')) {
            foreach ($request->input('variants', []) as $variantData) {
                if (empty($variantData['color'])) {
                    continue;
                }
                $sizes = array_filter(array_map('trim', $variantData['sizes'] ?? []));
                if (empty($sizes)) {
                    continue;
                }
                ProductVariant::create([
                    'product_id' => $product->id,
                    'color'      => $variantData['color'],
                    'hex_color'  => $variantData['hex_color'] ?? null,
                    'sizes'      => array_values($sizes),
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', "Producto \"{$product->name}\" creado exitosamente.");
    }

    public function edit(Product $product): View
    {
        $product->load('images', 'variants');

        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'type'        => ['required', 'in:tshirt,mono,accesorio'],
            'collection'  => ['required', 'in:resilencia,willpower,gratitude,general'],
            'images'      => ['nullable', 'array'],
            'images.*'    => ['image', 'max:5120'],
            'variants'    => ['nullable', 'array'],
            'delete_images' => ['nullable', 'array'],
            'delete_images.*' => ['integer'],
        ]);

        $product->update([
            'name'        => $validated['name'],
            'slug'        => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'price'       => $validated['price'],
            'type'        => $validated['type'],
            'collection'  => $validated['collection'],
            'is_active'   => $request->boolean('is_active', true),
        ]);

        // Delete selected images
        if ($request->has('delete_images')) {
            foreach ($request->input('delete_images') as $imageId) {
                $image = ProductImage::where('id', $imageId)
                    ->where('product_id', $product->id)
                    ->first();
                if ($image) {
                    Storage::disk('public')->delete($image->path);
                    $image->delete();
                }
            }
        }

        // Add new images
        if ($request->hasFile('images')) {
            $maxOrder = $product->images()->max('sort_order') ?? -1;
            $hasPrimary = $product->images()->where('is_primary', true)->exists();

            foreach ($request->file('images') as $index => $file) {
                $path = $file->store("products/{$product->id}", 'public');
                $maxOrder++;
                ProductImage::create([
                    'product_id' => $product->id,
                    'path'       => $path,
                    'is_primary' => !$hasPrimary && $index === 0,
                    'sort_order' => $maxOrder,
                    'color'      => $request->input("image_colors.{$index}") ?: null,
                ]);
                $hasPrimary = true;
            }
        }

        // Update color of existing images
        foreach ($request->input('existing_image_colors', []) as $imageId => $color) {
            ProductImage::where('id', $imageId)->where('product_id', $product->id)
                ->update(['color' => $color ?: null]);
        }
        if ($request->has('variants')) {
            $product->variants()->delete();
            foreach ($request->input('variants', []) as $variantData) {
                if (empty($variantData['color'])) {
                    continue;
                }
                $sizes = array_filter(array_map('trim', $variantData['sizes'] ?? []));
                if (empty($sizes)) {
                    continue;
                }
                ProductVariant::create([
                    'product_id' => $product->id,
                    'color'      => $variantData['color'],
                    'hex_color'  => $variantData['hex_color'] ?? null,
                    'sizes'      => array_values($sizes),
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', "Producto \"{$product->name}\" actualizado exitosamente.");
    }

    public function destroy(Product $product): RedirectResponse
    {
        \Illuminate\Support\Facades\Log::info('DESTROY called for product: ' . $product->id . ' - ' . $product->name);
        
        // Delete stored images
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', "Producto eliminado exitosamente.");
    }

    public function toggleActive(Product $product): RedirectResponse|\Illuminate\Http\JsonResponse
    {
        \Illuminate\Support\Facades\Log::info('Toggle called for product: ' . $product->id . ' - Current status: ' . $product->is_active);
        
        $product->update(['is_active' => !$product->is_active]);

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'is_active' => $product->is_active,
                'message' => 'Estado del producto actualizado.'
            ]);
        }

        return back()->with('success', 'Estado del producto actualizado.');
    }
}
