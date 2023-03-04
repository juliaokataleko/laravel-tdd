<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createUser();
        $this->admin = $this->createUser(level:1);
    }

    public function test_unauthenticated_users_cannot_access_users()
    {
        $response = $this->get('/users');
        $response->assertRedirect('/login');
    }

    public function test_non_admin_users_cannot_access_users()
    {
        $response = $this->actingAs($this->user)->get('/users');
        $response->assertStatus(403);
    }

    public function test_admin_users_can_access_users()
    {
        $response = $this->actingAs($this->admin)->get('/users');
        $response->assertStatus(200);
    }

    // public function test_users_page_contains_empty_table()
    // {
    //     $response = $this->actingAs($this->admin)->get('/users');
    //     $response->assertStatus(200);
    //     $response->assertSee('No users found');
    // }

    public function test_users_page_contains_non_empty_table()
    {
        $users = User::factory(100)->create();

        $response = $this->actingAs($this->admin)->get('/users');
        $response->assertStatus(200);
        $response->assertDontSee('No users found');
    }

    public function createUser(int $level = 3): User
    {
        return User::factory()->create(['level' => $level]);
    }

}
