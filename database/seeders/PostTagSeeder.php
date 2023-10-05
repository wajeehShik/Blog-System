<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB ;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        $posts = Post::all();
        // $tags = collect(Tag::get()->modelKeys());
        $days = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28'];
        $months = ['01', '02', '03', '04', '05', '06', '07', '08'];
       
        foreach($posts as $post){
        
            $post_date = "2023-" . Arr::random($months) . "-" . Arr::random($days) . " 01:01:01";
            $tags = Tag::inRandomOrder()->limit(5)->get();
            $post->tags()->attach($tags);
    }

     
            
     
      

        }
}
