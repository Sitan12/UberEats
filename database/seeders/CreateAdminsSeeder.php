<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateAdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name'=> 'ADMIN',
                'email' => 'admindefaut@admin.com',
                'role' => 'ADMIN',
                'is_admin' => '1',
                'password' => bcrypt('admin2021'),
            ],
        ];
        foreach ($user as $key => $value){
            User::create($value);
        }
    }
}
