<?php

use Illuminate\Database\Seeder;
use App\Tag;
use App\User;
use App\Post;
use App\Category;
use Illuminate\Support\Facades\Hash;
class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $auther1=User::create([
            'name'=>'saif',
            'email'=>'saifhd85@gmail.com',
            'password'=>Hash::make('saif1234')
        ]);
        $auther2=User::create([
            'name'=>'siraj',
            'email'=>'sirajhd85@gmail.com',
            'password'=>Hash::make('saif1234')
        ]);
        $tag1=Tag::create([
            'name'=>'Job'
        ]);
        $tag2=Tag::create([
            'name'=>'Customers'
        ]);
        $tag3=Tag::create([
            'name'=>'Record'
        ]);
        $category1=Category::create([
            'name'=>'News'
        ]);
        $category2=Category::create([
            'name'=>'Marketing'
        ]);
        $category3=Category::create([
            'name'=>'Partnership'
        ]);
        $post1=Post::create([
            'title'=>'We relocated our office to a new designed garage',
            'description'=>"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ullam asperiores porro dolorem rerum nostrum tempore quas",
            'content'=>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit autem quasi, quae modi, atque optio ipsum saepe et eos repudiandae architecto. Laborum quas atque placeat excepturi, doloremque ea debitis? Quos.",
            'category_id'=>$category1->id,
            'image'=>'posts/1.jpg',
            'user_id'=>$auther1->id
        ]);
        $post2=Post::create([
            'title'=>'Top 5 brilliant content marketing strategies',
            'description'=>"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ullam asperiores porro dolorem rerum nostrum tempore quas",
            'content'=>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit autem quasi, quae modi, atque optio ipsum saepe et eos repudiandae architecto. Laborum quas atque placeat excepturi, doloremque ea debitis? Quos.",
            'category_id'=>$category2->id,
            'image'=>'posts/2.jpg',
            'user_id'=>$auther1->id
        
        ]);
        $post3=Post::create([
            'title'=>'>Best practices for minimalist design with example',
            'description'=>"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ullam asperiores porro dolorem rerum nostrum tempore quas",
            'content'=>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit autem quasi, quae modi, atque optio ipsum saepe et eos repudiandae architecto. Laborum quas atque placeat excepturi, doloremque ea debitis? Quos.",
            'category_id'=>$category3->id,
            'image'=>'posts/3.jpg',
            'user_id'=>$auther1->id
        
        ]);
        $post4=Post::create([
            'title'=>'Congratulate and thank to Maryam for joining our team',
            'description'=>"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ullam asperiores porro dolorem rerum nostrum tempore quas",
            'content'=>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit autem quasi, quae modi, atque optio ipsum saepe et eos repudiandae architecto. Laborum quas atque placeat excepturi, doloremque ea debitis? Quos.",
            'category_id'=>$category2->id,
            'image'=>'posts/4.jpg',
            'user_id'=>$auther1->id
        
        ]);
        $post5=Post::create([
            'title'=>'New published books to read by a product designer',
            'description'=>"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ullam asperiores porro dolorem rerum nostrum tempore quas",
            'content'=>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit autem quasi, quae modi, atque optio ipsum saepe et eos repudiandae architecto. Laborum quas atque placeat excepturi, doloremque ea debitis? Quos.",
            'category_id'=>$category3->id,
            'image'=>'posts/5.jpg',
            'user_id'=>$auther2->id
        
        ]);
        $post6=Post::create([
            'title'=>'This is why its time to ditch dress codes at work',
            'description'=>"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ullam asperiores porro dolorem rerum nostrum tempore quas",
            'content'=>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit autem quasi, quae modi, atque optio ipsum saepe et eos repudiandae architecto. Laborum quas atque placeat excepturi, doloremque ea debitis? Quos.",
            'category_id'=>$category1->id,
            'image'=>'posts/6.jpg',
            'user_id'=>$auther2->id
        
        ]);
        $post1->tags()->attach([$tag1->id,$tag2->id]);
        $post2->tags()->attach([$tag2->id,$tag3->id]);
        $post3->tags()->attach([$tag2->id,$tag3->id]);
        $post4->tags()->attach([$tag1->id,$tag2->id]);
        $post5->tags()->attach([$tag1->id,$tag3->id]);
        $post6->tags()->attach([$tag2->id,$tag3->id]);

    }
}
