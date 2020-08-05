<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new App\User;
        $user->name = "Admin";
        $user->email = "admin@admin.com";
        $user->password = Hash::make('admin');
        $user->save();

        $user = new App\User;
        $user->name = "Emir";
        $user->email = "mvdcreativo@gmail.com";
        $user->password = Hash::make('admin');
        $user->save();
    }
}
