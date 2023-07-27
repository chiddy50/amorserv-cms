<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pages')->truncate();

        $users = array(
            array(
                'id' => 1,
                'title' => 'blog',
                'order' => 1,
                'slug' => 'blog',
                'content' => 'blog',
                'is_published' => 1
            ),
        );

        foreach ($users as $user){
            Page::create($user);
        }
    }
}
