<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Faker\Factory as FactoryHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = FactoryHelper::create();
           $admin = collect(Admin::get()->modelKeys());
           $name=  $faker->sentence(mt_rand(3, 6), true);

        return [
            
            'name'=>$name, 
            'slug'=>Str::slug($name), 
            'image'=>"image", 
            'admin_id'=>$admin->random(),
             'status'=> (string)rand(0,1),
        ];
        
    }
}
