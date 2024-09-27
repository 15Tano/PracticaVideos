<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Level;
use App\Models\Profile;
use App\Models\Category;
use App\Models\Video;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Location;
use App\Models\Group;




// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        

        Level::factory()->create(['name' => 'Oro']);
        Level::factory()->create(['name' => 'Plata']);
        Level::factory()->create(['name' => 'Bronce']);


        // Crear grupos
        $group1 = Group::factory()->create(['name' => 'Group 1']);
        $group2 = Group::factory()->create(['name' => 'Group 2']);
        $group3 = Group::factory()->create(['name' => 'Group 3']);

        // Crear usuarios y asociar grupos
        User::factory()->count(5)->create()->each(function ($user) use ($group1, $group2, $group3) {
            $profile = $user->profile()->save(Profile::factory()->make());
            $profile->location()->save(Location::factory()->make());

            // Asignar grupos aleatoriamente a los usuarios
            $groups = [$group1->id, $group2->id, $group3->id];
            $user->groups()->attach(array_rand(array_flip($groups), rand(1, 3)));

            $user->image()->create([
                'url' => 'https://picsum.com/90/90',
            ]);
        });
        
        User::factory()->count(5)->create()->each(function ($user) {


            $profile = $user->profile()->save(Profile::factory()->make());

            $profile->location()->save(Location::factory()->make());

            $user->groups()->attach($this->array(rand(1, 3)));

            $user->image()->create([
                'url' => 'https://picsum.com/90/90',
            ]);
        });

        Category::factory()->count(4)->create();

        $tags = Tag::factory()->count(12)->create(); // Línea 77

                                                    /*factory(App\Models\Tag::class, 12)->create();*/

    
        Post::factory()->count(40)->create()->each(function ($post) use ($tags){
                                                    /*factory(App\Models\Post::class, 40)->create()->each(function ($post)*/ 

            $post->image()->save(Image::factory()->make());

            $post->tags()->attach($this->array(rand(1, 12)));

            $number_comments = rand(1, 6);

            for ($i=0; $i < $number_comments; $i++){
                $post->comments()->save(Comment::factory()->make());

            }
 
    });

        Video::factory()->count(40)->create()->each(function ($video) use ($tags){
                                                    
            $video->image()->save(Image::factory()->make());

            $video->tags()->attach($this->array(rand(1, 12)));

            $number_comments = rand(1, 6);

            for ($i=0; $i < $number_comments; $i++){
                $video->image()->save(Image::factory()->make());

            }
 
    });

    }
    
    public function array($max)
    {
        $values = [];

        for ($i=1; $i < $max ; $i++) {
            $values[] = $i;

        }

        return $values;
    
    }


}

