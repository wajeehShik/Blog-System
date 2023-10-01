<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FactoryHelper;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faq>
 */
class FaqFactory extends Factory
{
    protected $model = Faq::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = FactoryHelper::create();
        $admin = collect(Admin::get()->modelKeys());
        return [
            'title'=>$this->faker->name(),
            'body'=> $faker->sentence(mt_rand(30, 100), true),
            'status'=>(string)rand(0,1),
            'admin_id'=>$admin->random()

            //
        ];
    }
}
