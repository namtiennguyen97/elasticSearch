<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CateforiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
          ['name' => 'MMO'],
          ['name' => 'Mobile'],
          ['name' => 'Game'],
          ['name' => 'Blog'],
          ['name' => 'Sport'],
        ];

        Categories::insert($data);
    }
}
