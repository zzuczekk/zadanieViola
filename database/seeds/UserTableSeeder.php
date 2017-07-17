<?php

use Illuminate\Database\Seeder;
use App\User;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Michal Zuk',
            'username'=>'zzuczekk',
            'email'=>'zzuczekk@hotmail.com',
            'password'=>bcrypt('qwerty'),
            'type'=>2,
            'status'=>1
        ]);
    }
}
