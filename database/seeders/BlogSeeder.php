<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'Punishing: Gray Raven',
                'content' => 'Punishing: Gray Raven is an action role-playing game developed and published by Kuro Games. It was first released in China on December 5, 2019, and a year later on December 4, 2020, in Japan. The game was released globally on July 16, 2021.',
                'author' => 'Nam',
                'tags' => 'mmo,mobile'
            ],
            [
                'title' => 'Punishing: Gray Raven Worldview/Lore',
                'content' => "The Virus was found to have initially emerged from the vacuum chamber of an A-Series Zero-Point energy reactor operating at ultrahigh density. The virus broke out from a leak when technicians attempted to isolate and refine the viral particles. The subsequent explosion from the attempt expelled the virus into the atmosphere and had spread worldwide. The Punishing Virus can affect both biological and non-biological forms like humans and electronics as it directly attacks an organism's cells or hijacks the logic circuits of Mechanoids, and in effect Corrupting them, once infected, apparent symptoms are manifestations of extreme hostility towards any individual displaying human consciousness or behaviors.",
                'author' => 'Nam',
                'tags' => 'mmo,mobile'
            ],
        ];

        Blog::insert($data);
    }
}
