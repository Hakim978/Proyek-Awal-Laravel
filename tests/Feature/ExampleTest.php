<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_guest_request_to_dashboard_redirects_to_login(): void
    {
        $response = $this->get('/');

        $response->assertRedirect(route('login'));
        $this->get(route('login'))->assertOk()->assertSee('Masuk ke akun inventaris Anda.');
    }
}
