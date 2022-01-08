<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserSeeder extends Seeder
{
    use RefreshDatabase;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(['id' => 1],[
            'name' => 'admin',
            'email' =>'admin@admin',
            'password' => Hash::make('admin')
        ]);
    }
}
