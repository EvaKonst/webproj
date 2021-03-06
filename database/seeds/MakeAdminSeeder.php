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
        DB::table('users')->where('name', 'Eva')->update(['role' => 'admin']);
        DB::table('users')->where('name', 'Katerina')->update(['role' => 'admin']);
        DB::table('users')->where('name', 'maria')->update(['role' => 'admin']);
    }
}
