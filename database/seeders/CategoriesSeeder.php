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
            ['id'=>1,'name'=>'Hospitality','parent_id'=>null,'salary'=>null],
            ['id'=>2,'name'=>'Hospitality Assistant II','parent_id'=>1,'salary'=>13000],
            ['id'=>3,'name'=>'Hospitality Assistant  I','parent_id'=>1,'salary'=>20000],
            ['id'=>4,'name'=>'Support Staff','parent_id'=>null,'salary'=>13000],

            ['id'=>5,'name'=>'Security','parent_id'=>null,'salary'=>null],
            ['id'=>6,'name'=>'Security Wardens','parent_id'=>5,'salary'=>20000],
            ['id'=>7,'name'=>'NYS','parent_id'=>5,'salary'=>null],

            ['id'=>8,'name'=>'Contact Center Agent','parent_id'=>null,'salary'=>25000],

            ['id'=>9,'name'=>'ICT Assistants','parent_id'=>null,'salary'=>null],
            ['id'=>10,'name'=>'ICT Assistant I','parent_id'=>9,'salary'=>25000],
            ['id'=>11,'name'=>'ICT Assistant II','parent_id'=>9,'salary'=>20000],

            ['id'=>12,'name'=>'Customer Care','parent_id'=>null,'salary'=>null],
            ['id'=>13,'name'=>'Customer Care Assistant I','parent_id'=>12,'salary'=>25000],
            ['id'=>14,'name'=>'Customer Care Assistant II','parent_id'=>12,'salary'=>20000],
            ['id'=>15,'name'=>'Customer Care Assistant III','parent_id'=>12,'salary'=>13000],
        ];

        foreach ($categories as $category){
            Category::updateOrCreate(['id'=>$category['id']],$category);
        }
    }
}
