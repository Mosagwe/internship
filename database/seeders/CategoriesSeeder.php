<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $categories=[
            ['id'=>1,'name'=>'Centre Assistant','parent_id'=>null,'salary'=>null],
            ['id'=>2,'name'=>'Centre Assistant - Tea','parent_id'=>1,'salary'=>13000],
            ['id'=>3,'name'=>'Centre Assistant - Tea II','parent_id'=>1,'salary'=>20000],
            ['id'=>4,'name'=>'Centre Assistant - Cleaner','parent_id'=>1,'salary'=>13000],

            ['id'=>5,'name'=>'Security','parent_id'=>null,'salary'=>null],
            ['id'=>6,'name'=>'X-NYS','parent_id'=>4,'salary'=>20000],
            ['id'=>7,'name'=>'NYS','parent_id'=>4,'salary'=>null],
            
            ['id'=>8,'name'=>'Contact Center','parent_id'=>null,'salary'=>25000],

            ['id'=>9,'name'=>'ICT Assistants','parent_id'=>null,'salary'=>null],
            ['id'=>10,'name'=>'ICT Assistants I','parent_id'=>9,'salary'=>25000],
            ['id'=>11,'name'=>'ICT Assistants II','parent_id'=>9,'salary'=>20000],

            ['id'=>12,'name'=>'General Duties','parent_id'=>null,'salary'=>null],
            ['id'=>13,'name'=>'General Duties I','parent_id'=>12,'salary'=>25000],
            ['id'=>14,'name'=>'General Duties II','parent_id'=>12,'salary'=>20000],
        ];

        foreach ($categories as $category){
            Category::updateOrCreate(['id'=>$category['id']],$category);
        }
    }
}
