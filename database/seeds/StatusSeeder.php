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
        // $status = new App\Models\Status;
        // $status->name = "Activo";
        // $status->for = "ALL";
        // $status->save();

        // $status = new App\Models\Status;
        // $status->name = "Inactivo";
        // $status->for = "ALL";
        // $status->save();

        // $status = new App\Models\Status;
        // $status->name = "Destacada";
        // $status->for = "PUB";
        // $status->save();

        // $status = new App\Models\Status;
        // $status->name = "Normal";
        // $status->for = "PUB";
        // $status->save();

        $status = new App\Models\Status;
        $status->name = "Vendido";
        $status->for = "PUB";
        $status->save();

        $status = new App\Models\Status;
        $status->name = "Alquilado";
        $status->for = "PUB";
        $status->save();

    }
}
