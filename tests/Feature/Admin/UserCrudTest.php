<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserCrudTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->user = User::factory()->create([
            'role' => 'user',
        ]);
    }

    public function test_admin_can_access_users_index(): void
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.users.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.users.index');
    }

    public function test_non_admin_cannot_access_users_index(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('admin.users.index'));

        $response->assertForbidden();
    }

    public function test_admin_can_create_user_with_role_user_and_password_confirmation(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('admin.users.store'), [
                'name' => 'New User',
                'email' => 'newuser@vora.ai',
                'password' => 'password123',
                'password_confirmation' => 'password123',
            ]);

        $response->assertRedirect(route('admin.users.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'name' => 'New User',
            'email' => 'newuser@vora.ai',
            'role' => 'user', // Forced role to user
        ]);
    }

    public function test_admin_cannot_create_user_without_password_confirmation(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('admin.users.store'), [
                'name' => 'New User',
                'email' => 'newuser@vora.ai',
                'password' => 'password123',
                'password_confirmation' => 'different',
            ]);

        $response->assertSessionHasErrors(['password']);
    }

    public function test_admin_cannot_create_user_with_invalid_name(): void
    {
        // Name with number
        $response = $this->actingAs($this->admin)
            ->post(route('admin.users.store'), [
                'name' => 'John Doe 123',
                'email' => 'valid@vora.ai',
                'password' => 'password123',
                'password_confirmation' => 'password123',
            ]);
        $response->assertSessionHasErrors(['name']);

        // Name with special characters
        $response = $this->actingAs($this->admin)
            ->post(route('admin.users.store'), [
                'name' => 'John @ Doe',
                'email' => 'valid2@vora.ai',
                'password' => 'password123',
                'password_confirmation' => 'password123',
            ]);
        $response->assertSessionHasErrors(['name']);
    }

    public function test_admin_cannot_create_user_with_invalid_email(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('admin.users.store'), [
                'name' => 'Valid Name',
                'email' => 'invalid-email',
                'password' => 'password123',
                'password_confirmation' => 'password123',
            ]);
        $response->assertSessionHasErrors(['email']);
    }

    public function test_admin_cannot_create_user_with_duplicate_email(): void
    {
        $existing = User::factory()->create([
            'email' => 'existing@vora.ai',
        ]);

        $response = $this->actingAs($this->admin)
            ->post(route('admin.users.store'), [
                'name' => 'Valid Name',
                'email' => 'existing@vora.ai',
                'password' => 'password123',
                'password_confirmation' => 'password123',
            ]);
        $response->assertSessionHasErrors(['email']);
    }

    public function test_admin_cannot_create_user_with_short_password(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('admin.users.store'), [
                'name' => 'Valid Name',
                'email' => 'valid@vora.ai',
                'password' => '1234567',
                'password_confirmation' => '1234567',
            ]);
        $response->assertSessionHasErrors(['password']);
    }

    public function test_admin_can_update_user_and_force_role_user(): void
    {
        $userToEdit = User::factory()->create([
            'name' => 'Old Name',
            'email' => 'oldemail@vora.ai',
            'role' => 'admin', // Start as admin to test role forcing
        ]);

        $response = $this->actingAs($this->admin)
            ->put(route('admin.users.update', $userToEdit), [
                'name' => 'Updated Name',
                'email' => 'updatedemail@vora.ai',
            ]);

        $response->assertRedirect(route('admin.users.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'id' => $userToEdit->id,
            'name' => 'Updated Name',
            'email' => 'updatedemail@vora.ai',
            'role' => 'user', // Role must be forced to user
        ]);
    }

    public function test_admin_can_update_user_password_with_confirmation(): void
    {
        $userToEdit = User::factory()->create();

        $response = $this->actingAs($this->admin)
            ->put(route('admin.users.update', $userToEdit), [
                'name' => 'John Doe',
                'email' => $userToEdit->email,
                'password' => 'newpassword123',
                'password_confirmation' => 'newpassword123',
            ]);

        $response->assertRedirect(route('admin.users.index'));
        $response->assertSessionHas('success');
    }

    public function test_admin_cannot_update_user_password_with_mismatched_confirmation(): void
    {
        $userToEdit = User::factory()->create();

        $response = $this->actingAs($this->admin)
            ->put(route('admin.users.update', $userToEdit), [
                'name' => 'John Doe',
                'email' => $userToEdit->email,
                'password' => 'newpassword123',
                'password_confirmation' => 'mismatched',
            ]);

        $response->assertSessionHasErrors(['password']);
    }

    public function test_admin_cannot_delete_self(): void
    {
        $response = $this->actingAs($this->admin)
            ->delete(route('admin.users.destroy', $this->admin));

        $response->assertRedirect(route('admin.users.index'));
        $response->assertSessionHas('error');

        $this->assertDatabaseHas('users', [
            'id' => $this->admin->id,
        ]);
    }

    public function test_admin_can_delete_other_users(): void
    {
        $userToDelete = User::factory()->create();

        $response = $this->actingAs($this->admin)
            ->delete(route('admin.users.destroy', $userToDelete));

        $response->assertRedirect(route('admin.users.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('users', [
            'id' => $userToDelete->id,
        ]);
    }
}
