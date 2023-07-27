<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();

        $users = array(
            array(
                'id' => 1,
                'name' => 'John Doe',
                'email' => 'john@admin.com',
                'email_verified_at' => '2023-06-06 10:13:53',
                'password' => Hash::make('123456'),
                'role_id' => 1 // ADMIN
            ),
            array(
                'id' => 2,
                'name' => 'Jane Doe',
                'email' => 'jane@editor.com',
                'email_verified_at' => '2023-06-06 10:13:53',
                'password' => Hash::make('123456'),
                'role_id' => 2 // EDITOR
            ),
            array(
                'id' => 3,
                'name' => 'Sally Doe',
                'email' => 'sally@admin.com',
                'email_verified_at' => '2023-06-06 10:13:53',
                'password' => Hash::make('123456'),
                'role_id' => 1 // ADMIN
            ),
            array(
                'id' => 4,
                'name' => 'James Doe',
                'email' => 'james@admin.com',
                'email_verified_at' => '2023-06-06 10:13:53',
                'password' => Hash::make('123456'),
                'role_id' => 1 // ADMIN
            ),
            array(
                'id' => 5,
                'name' => 'David Doe',
                'email' => 'david@editor.com',
                'email_verified_at' => '2023-06-06 10:13:53',
                'password' => Hash::make('123456'),
                'role_id' => 2 // EDITOR
            ),
        );

        foreach ($users as $user){
            User::create($user);
        }
    }
}
