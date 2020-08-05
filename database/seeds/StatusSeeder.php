<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = new App\Models\Status;
        $status->name = "Activo";
        $status->save();

        $status = new App\Models\Status;
        $status->name = "Inactivo";
        $status->save();

    }
}
