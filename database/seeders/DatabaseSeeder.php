<?php

namespace Database\Seeders;

use App\Models\User;
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

        
        User::factory()->count(5)->create()->each(function ($user) {


            $profile = $user->profile()->save(Profile::factory()->make());

            $profile->location()->save(Location::factory()->make());

            $user->groups()->attach($this-array(rand(1, 3)));

            $user->image()->create([
                'url' => 'https://picsum.com/90/90',
            ]);
        });

        Category::factory()->count(4)->create();

        Tag::factory()->count(12)->create();
        /*factory(App\Models\Tag::class, 12)->create();*/

    }
        Post::factory()->count(40)->create()->each(function ($post) use ($tags)){
        /*factory(App\Models\Post::class, 40)->create()->each(function ($post)*/ 

            $post->image()->save(factory(App\Models\Post::class)->make());
 
    });

    
    public function array($max)
    {
        $values = [];

        for ($i=1; $i < $max ; $i++) {
            $values[] = $i;

        }

        return $values;
    
    }


}

