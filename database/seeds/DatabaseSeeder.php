<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('co_users')->insert([
            'name' => 'admin',
            'fullname' => 'Nguyễn Nhật Trường',
            'email' => 'nntruong91@gmail.com',
            'password' => bcrypt(1),
            'remark' => '',
        ]);
    }
}
