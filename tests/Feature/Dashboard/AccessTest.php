<?php

namespace Tests\Feature\Dashboard;

use Tests\TestCase;
use App\Models\Admin;

class AccessTest extends TestCase
{
    public function test_dashboard_authorization()
    {
        $this->actingAsAdmin();

        Admin::factory()->create(['name' => 'Ahmed']);

        $response = $this->get(route('dashboard.admins.index'));

        $response->assertSuccessful();

        $response->assertSee('Ahmed');
    }
}
