<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Pages extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Page::create([
            'parent_id' => 0,
            'title' => 'Strona główna',
            'content' => '<h1>Witamy na naszej stronie!</h1>',
            'active' => 1,
            'is_menu' => 1,
            'position' => 1,
            'new_window' => 0,
            'meta_title' => 'Strona główna',
            'meta_description' => 'Opis strony głównej',
            'meta_keywords' => 'strona, główna, witamy',
            'slug' => '',
        ]);        
        \App\Models\Page::create([
            'parent_id' => 0,
            'title' => 'Kontakt',
            'content' => '<h1>Witamy na naszej stronie kontaktu!</h1>',
            'active' => 1,
            'is_menu' => 1,
            'position' => 1,
            'new_window' => 0,
            'meta_title' => 'kontakt',
            'meta_description' => 'Opis strony głównej',
            'meta_keywords' => 'strona, główna, witamy',
            'slug' => 'kontakt',
        ]);        
    }
}
