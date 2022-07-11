<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Category::insert([
            ['name'=>'VueJS','slug'=>'VueJs'],
            ['name'=>'ReactJS','slug'=>'ReactJS'],
            ['name'=>'Svelte','slug'=>'Svelte'],
            ['name'=>'Angular','slug'=>'Angular'],
            ['name'=>'Alpine','slug'=>'Angular']
        ]);
    }
}
