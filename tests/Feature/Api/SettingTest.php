<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laraeast\LaravelSettings\Facades\Settings;

class SettingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
  public function test_index()
  {
    $this->app->setLocale('en');

    Settings::locale('en')->set('name', 'App Name');

    $response = $this->getJson(route('api.settings.index'));
    
    $this->assertEquals($response->json('app.name'), 'App Name');

  }



}
