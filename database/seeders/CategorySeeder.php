<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tecnologia = new Category();
        $tecnologia->name = "Tecnologia";
        $tecnologia->descripcion = "Todo lo relacionado a tecnologia";

        $tecnologia->save();

    }
}
