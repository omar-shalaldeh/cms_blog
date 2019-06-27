<?php

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $category1=Category::create([
            'name'=>'News',

        ]);
        $category2=Category::create([
            'name'=>'Markiting',

        ]);
        $category3=Category::create([
            'name'=>'Product',

        ]);

        $authuser1=User::create([
           'name'=>'john',
           'email'=>'john@gmail.com',
           'password'=>Hash::make('password')
        ]);
        $authuser2=User::create([
            'name'=>'gorse',
            'email'=>'gorse@gmail.com',
            'password'=>Hash::make('password')
        ]);
        $authuser1=User::create([
            'name'=>'prosly',
            'email'=>'prosly@gmail.com',
            'password'=>Hash::make('password')
        ]);

        $post1=Post::create([
        'title'=>'We relocated our office to a new designed garage',
        'description'=>'relocated our office to a new designed garage',
        'contents'=>'relocated our office to a new designed garage',
        'category_id'=>$category1->id,
          'user_id'=>$authuser1->id,
          'image'=>'posts/1.jpg'
    ]);
        $post2=Post::create([
            'title'=>'Top 5 brilliant content marketing strategies',
            'description'=>'relocated our office to a new designed garage',
            'contents'=>'relocated our office to a new designed garage',
            'category_id'=>$category2->id,
            'user_id'=>$authuser2->id,
            'image'=>'posts/2.jpg'
        ]);


        $post3=Post::create([
            'title'=>'Best practices for minimalist design with example',
            'description'=>'relocated our office to a new designed garage',
            'contents'=>'relocated our office to a new designed garage',
            'category_id'=>$category1->id,
            'user_id'=>$authuser2->id,
            'image'=>'posts/3.jpg'
        ]);
        $post4=Post::create([
            'title'=>'Congratulate and thank to Maryam for joining our team',
            'description'=>'relocated our office to a new designed garage',
            'contents'=>'relocated our office to a new designed garage',
            'category_id'=>$category3->id,
            'user_id'=>$authuser1->id,
            'image'=>'posts/4.jpg'
        ]);


        $tag1=Tag::create([
            'name'=>'record'
        ]);

        $tag2=Tag::create([
            'name'=>'costumers'


        ]);
        $tag3=Tag::create([
            'name'=>'progress'


        ]);


$post1->tags()->attach([$tag1->id,$tag2->id]);
$post2->tags()->attach([$tag2->id,$tag3->id]);
$post3->tags()->attach([$tag1->id,$tag3->id]);
    }
}
