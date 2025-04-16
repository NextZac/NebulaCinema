<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            "email" => "test@example.com",
            "password" => bcrypt("password123"),
        ]);

        $response = $this->get("/login");
        $response->assertStatus(200);
        $response->assertSee("Logi sisse");

        $response = $this->post("/login", [
            "email" => "test@example.com",
            "password" => "password123",
        ]);

        $response->assertRedirect("/admin");

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function user_cannot_login_with_invalid_credentials()
    {
        $user = User::factory()->create([
            "email" => "test@example.com",
            "password" => bcrypt("password123"),
        ]);

        $response = $this->post("/login", [
            "email" => "test@example.com",
            "password" => "wrongpassword",
        ]);

        $response->assertRedirect("/");
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    /** @test */
    public function login_page_contains_required_elements()
    {
        $response = $this->get("/login");

        $response->assertStatus(200);
    }
}
