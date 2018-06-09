<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'wnyachiro@questholdings.biz',
            'password' => bcrypt('Quest@201?'),
            'created_at'=> date('y/m/d-h:m:s'),
        ]);
    }
}
