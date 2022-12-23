<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\CategoryPost;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_post()
    {
        $this->getjson('/api/posts')
            ->assertStatus(200);

    }
    /** @test */
    public function test_add_post()
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $response = $this->actingAs($user)->postJson(route('api.posts.store'), [
            'user_id' =>  $user->id,
            'category_id' => CategoryPost::factory()->create()->id,
            'titele' => "gh",
            'description' => "233",
            'slug' =>"4",
            'images' => [
                UploadedFile::fake()->image('01.png'),
            ],
        ])->assertSuccessful();
        $this->assertDatabaseCount('posts', 1);
      //  $response->assertStatus("Response is: " . $response->getContent());

    }

  /*  public function test_update_post()
    {
        $user = User::factory()->create();
        $Post = Post::factory(['titele' =>"123",'user_id'=>$user->id,'slug'=>'tt'])->create();

        $response =  $this->actingAs($user)
        ->putjson(route('api.posts.update',$Post->slug), [
          //  'category_id' => CategoryPost::factory()->create()->id,

            'titele' => "12",
            'description' => "233",
            'slug' =>"4",
        ]);
        $response->assertStatus("Response is: " . $response->getContent());

        $this->assertTrue($Post->fresh()->titele == "12");

      

        $response->assertStatus("Response is: " . $response->getContent());

    }*/


    

   
    public function delete_update_post()
    {
        $user = User::factory()->create();
        $Post = Post::factory(['titele' =>"123",'user_id'=>$user->id])->create();
        $this->actingAs($user)->delete('/api/posts/'.$Post->slug);
        $this->assertDatabaseCount('posts', 0);


    }

   


    public function test_index_post()
    {
        $this
        ->get('/api/posts')
        ->assertStatus(200);

    }


}