<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
          'name' => 'test1',
         
        ];
        $category = new Category;
        $category->fill($param)->save();
        $param = [
          'name' => 'test2',
        
        ];
        $category = new Category;
        $category->fill($param)->save();
        $param = [
          'name' => 'test3',
        
        ];
        $category = new Category;
        $category->fill($param)->save();
    }
}
