<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Support\Str;
use Faker\Factory as FactoryHelper;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = FactoryHelper::create();
        $admin = collect(Admin::get()->modelKeys());
        $name=  $faker->sentence(mt_rand(1, 3), true);
        return [
            'name'=>$name,
            'slug'=>Str::slug($name),
            'admin_id'=>$admin->random(),
            'status'=>(string)rand(0,1),
        ];
    }
}
