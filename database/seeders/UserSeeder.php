<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ADMIN
        User::create([
            'name' => 'Smart Job',
            'email' => 'smartjob@gmail.com',
            'username' => 'smart_job',
            'password' => bcrypt(1234),
            'img_account' => 'img/img_account/img_account.png',
            'active' => '1',
        ]);

        // USER
        User::create([
            'name' => 'João',
            'email' => 'joao@gmail.com',
            'username' => 'joao',
            'password' => bcrypt(1234),
            'img_account' => 'img/img_account/img_account.png',
            'active' => '1',
        ]);
    }
}
