<?php

use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $expense = new App\Models\Expense;
        $expense->name = "Mantenimiento";
        $expense->description = null;
        $expense->save();

        $expense = new App\Models\Expense;
        $expense->name = "Porteria";
        $expense->description = null;
        $expense->save();
    }
}
