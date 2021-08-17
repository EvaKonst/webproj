<?php

use Illuminate\Database\Seeder;

class MakeAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->where('name', 'iamadmin')->update(['role' => 'admin']);
    }
}
