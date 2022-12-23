<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\CategoryPost;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryPostTest extends TestCase
{
    /** @test */
    use RefreshDatabase;

    /** @test */
    public function it_can_list_all_categories()
    {
        $this->actingAsAdmin();

        CategoryPost::create([
            'name' => 'dffd',
            'description' =>'fr',
        ]);
            $this->getJson(route('api.categorypost.index'))
            ->assertSuccessful();

    }


    public function it_can_display_the_category_details()
    {
        $this->actingAsAdmin();

        $category =   CategoryPost::create([
            'name' => 'dffd',
            'description' =>'fr',
        ]);
        $response = $this->getJson(route('api.categorypost.show', $category))
        ->assertSuccessful();
        $this->assertEquals($response->json('data.name'), 'dffd');


    }
}