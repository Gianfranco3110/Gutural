<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class UpdatePostsContent extends Command
{
    protected $signature = 'posts:update-content';
    protected $description = 'Actualizar el contenido de los posts de RESILENCE, WILLPOWER y GRATITUDE';

    public function handle()
    {
        $this->info('Actualizando contenido de los posts...');

        // RESILENCE
        $resilence = Post::where('slug', 'resilence')->first();
        if ($resilence) {
            $resilence->update([
                'content' => "Es la capacidad de una persona para atravesar momentos difíciles, adaptarse y salir transformada, no necesariamente intacta, sino más consciente, más preparada y, muchas veces, más fuerte emocionalmente.\n\nUna persona resiliente:\nNo evita el dolor, lo enfrenta, no niega las caídas, aprende de ellas, no vuelve a ser la misma después de una crisis... se reconstruye mejor.\n\nDesde el comportamiento humano, la resilencia implica tres cosas clave:\n\n- 1. Interpretación de la realidad: No es lo que te pasa, sino cómo lo interpretas. Dos personas viven lo mismo, pero una se rompe y otra evoluciona.\n\n- 2. Regulación emocional: Sentir miedo, tristeza o frustración es normal. La resilencia está en no quedarse atrapado ahí.\n\n- 3. Acción adaptativa: El resiliente no se queda paralizado: ajusta, aprende, intenta otra vez.\n\nEn pocas palabras: La resilencia es el arte de doblarse sin quebrarse... y volver con más claridad de quién eres y de lo que eres capaz.\n\nLo más importante: no es un talento con el que naces o no, es una habilidad que se construye, golpe a golpe, decisión a decisión."
            ]);
            $this->info('✓ RESILENCE actualizado');
        }

        // WILLPOWER
        $willpower = Post::where('slug', 'willpower')->first();
        if ($willpower) {
            $willpower->update([
                'content' => "La fuerza de voluntad es la capacidad de controlar tus impulsos, mantener el enfoque en tus metas y actuar de manera consistente, incluso cuando no tienes ganas.\n\nNo se trata de ser perfecto, sino de ser constante. Es la diferencia entre querer algo y hacer lo necesario para conseguirlo.\n\nLa fuerza de voluntad se entrena:\n\n- 1. Empieza pequeño: No intentes cambiar todo de golpe. Un hábito a la vez.\n\n- 2. Elimina tentaciones: Si no quieres comer dulces, no los tengas en casa.\n\n- 3. Descansa bien: La falta de sueño debilita tu autocontrol.\n\n- 4. Celebra tus victorias: Cada pequeño logro refuerza tu disciplina.\n\nRecuerda: La motivación te pone en marcha, pero la disciplina te mantiene en el camino.\n\nLa fuerza de voluntad no es infinita, pero se puede fortalecer con práctica constante."
            ]);
            $this->info('✓ WILLPOWER actualizado');
        }

        // GRATITUDE
        $gratitude = Post::where('slug', 'gratitude')->first();
        if ($gratitude) {
            $gratitude->update([
                'content' => "La gratitud es el reconocimiento consciente de lo que tienes, en lugar de enfocarte en lo que te falta.\n\nNo es ignorar los problemas, es elegir ver también lo bueno. Es una práctica que transforma tu perspectiva y mejora tu bienestar emocional.\n\nBeneficios de practicar la gratitud:\n\n- 1. Reduce el estrés y la ansiedad\n- 2. Mejora la calidad del sueño\n- 3. Fortalece las relaciones personales\n- 4. Aumenta la autoestima\n- 5. Te hace más resiliente ante las adversidades\n\nCómo practicar la gratitud:\n\n- Escribe 3 cosas por las que estás agradecido cada día\n- Expresa tu agradecimiento a las personas importantes en tu vida\n- Reflexiona sobre los momentos positivos antes de dormir\n- Aprecia las pequeñas cosas: un café caliente, una conversación, un momento de paz\n\nLa gratitud no cambia tu realidad, cambia cómo la experimentas.\n\nNo esperes a tener todo para ser agradecido. Sé agradecido y tendrás más."
            ]);
            $this->info('✓ GRATITUDE actualizado');
        }

        $this->info("\n✓ Proceso completado exitosamente!");

        return 0;
    }
}
