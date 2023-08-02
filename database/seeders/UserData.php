<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserData extends Seeder
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
                'name' => 'Adminisitrator',
                'username' => 'admin',
                'password' => bcrypt('admin.123'),
                'level'=> 1,
                'email' => 'admin@naufal.com'
            ]

        ];
        foreach($user as $key => $value){
            User::create($value);
        }
    }
}
