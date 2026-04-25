<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        // Asegurar que el directorio destino en storage existe
        $storageDir = storage_path('app/public/posts');
        if (! File::exists($storageDir)) {
            File::makeDirectory($storageDir, 0755, true);
        }

        $posts = [
            [
                'title'        => 'RESILENCE',
                'slug'         => 'resilence',
                'subtitle'     => '(RESILENCIA)',
                'collection'   => 'resilencia',
                'excerpt'      => 'La capacidad de una persona para atravesar momentos difíciles, adaptarse y salir transformada, no necesariamente intacta, sino más consciente, más preparada y, muchas veces, más fuerte emocionalmente.',
                'is_published' => true,
                'published_at' => '2022-12-12 00:00:00',
                'src_image'    => 'miniatura blog seccion 5 resilencia.png',
                'dest_image'   => 'resilencia.png',
            ],
            [
                'title'        => 'WILLPOWER',
                'slug'         => 'willpower',
                'subtitle'     => '(FUERZA DE VOLUNTAD)',
                'collection'   => 'willpower',
                'excerpt'      => 'La capacidad de una persona para atravesar momentos difíciles con determinación y fuerza interior inquebrantable hacia cualquier meta que se proponga.',
                'is_published' => true,
                'published_at' => '2022-12-18 00:00:00',
                'src_image'    => 'miniatura blog seccion 5 willpower.png',
                'dest_image'   => 'willpower.png',
            ],
            [
                'title'        => 'GRATITUDE',
                'slug'         => 'gratitude',
                'subtitle'     => '(GRATITUD)',
                'collection'   => 'gratitude',
                'excerpt'      => 'La capacidad de una persona para atravesar momentos difíciles reconociendo las bendiciones y aprendizajes del camino con gratitud y apertura.',
                'is_published' => true,
                'published_at' => '2022-12-20 00:00:00',
                'src_image'    => 'miniatura blog seccion 5 gratitud.png',
                'dest_image'   => 'gratitude.png',
            ],
        ];

        foreach ($posts as $data) {
            // Copiar imagen de public/images/home/ → storage/app/public/posts/
            $src  = public_path('images/home/' . $data['src_image']);
            $dest = $storageDir . '/' . $data['dest_image'];

            if (File::exists($src) && ! File::exists($dest)) {
                File::copy($src, $dest);
            }

            Post::updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'title'        => $data['title'],
                    'subtitle'     => $data['subtitle'],
                    'collection'   => $data['collection'],
                    'excerpt'      => $data['excerpt'],
                    'is_published' => $data['is_published'],
                    'published_at' => $data['published_at'],
                    'image'        => 'posts/' . $data['dest_image'],
                ]
            );
        }
    }
}
