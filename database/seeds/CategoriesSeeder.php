<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //array di categorie
        $categories = [
            ["title"=> "informatica", "description" => "Post che riguarda l'informatica"],
            ["title"=> "cucina", "description" => "Post che riguarda la cucina"],
            ["title"=> "animali", "description" => "Post che riguarda gli animali domestici e non"],
            ["title"=> "giochi", "description" => "Post che riguarda il mondo dei video giochi"],
            ["title"=> "film", "description" => "Post che riguarda i film"],
            ["title"=> "serie TV", "description" => "Post che riguarda le serie tv"]
        ];

        foreach($categories as $category){
            $newCat = new Category();
            $newCat->fill($category);
            $newCat->save();
        }
      
    }
}
