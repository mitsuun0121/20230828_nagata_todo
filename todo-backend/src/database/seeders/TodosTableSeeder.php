<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Todo;

class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
          'content' => 'test1'
          
        ];
        $todo = new Todo;
        $todo->fill($param)->save();

        $param = [
          'content' => 'test2'
          
        ];
        $todo = new Todo;
        $todo->fill($param)->save();
        
        $param = [
          'content' => 'test3'
          
        ];
        $todo = new Todo;
        $todo->fill($param)->save();
    }
    
}
