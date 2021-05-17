<?php

use App\Category;
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
        $array=[
            'Cucina Italiana',
            'Cucina Cinese',
            'Cucina Giapponese',
            'Cucina Americana',
            'Cucina Indiana',
            'Cucina Greca',
            'Cucina Asiatica',
            'Cucina Messicana',
            'Cucina Sudamericana',
            'Pizzeria',
            'Paninoteca'
        ];
        for($i=0; $i < count($array); $i++) {
            $category = new Category();
            $category->name = $array[$i];
            $category->save();}
    }
}
