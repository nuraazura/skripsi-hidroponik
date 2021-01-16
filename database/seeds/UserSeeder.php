<?php

use Illuminate\Database\Seeder;

use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            ['name'=>'admin', 'email'=>'admin@gmail.com', 'password'=>bcrypt('123456'), 'level'=>'admin'],
            ['name'=>'petani', 'email'=>'petani@gmail.com', 'password'=>bcrypt('123456'), 'level'=>'petani'],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
