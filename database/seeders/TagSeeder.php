<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Nature' => 'success', // green
            'Inspiration' => 'light', // white grey
            'Friends' => 'info', // turquoise
            'Love' => 'danger', // red
        ];

        foreach ($tags as $key => $value) {
            $tag = new Tag(
                [
                    'nombre' => $key,
                    'estilo' => $value
                ]
            );
            $tag->save();
        }
    }
}
