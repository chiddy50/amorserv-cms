<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->truncate();

        $roles = array(
            array('id' => 1, 'name' => 'admin', 'description' => 'Admin'),
            array('id' => 2, 'name' => 'editor', 'description' => 'Editor')
        );

        foreach ($roles as $role){
            Role::create($role);
        }

    }
}
