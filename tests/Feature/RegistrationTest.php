<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test registration form is displayed successfully.
     */
    public function test_registration_form_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Registrasi Anggota');
        $response->assertSee('Nama Lengkap');
        $response->assertSee('Alamat Email');
        $response->assertSee('Nomor Telepon');
    }

    /**
     * Test user can register with valid details, auto-logged in and redirected.
     */
    public function test_user_can_register_with_valid_data(): void
    {
        $response = $this->post('/register', [
            'name'                  => 'John Doe',
            'email'                 => 'johndoe@example.com',
            'phone'                 => '08123456789',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
        ]);

        // Redirected to anggota dashboard
        $response->assertRedirect(route('anggota.dashboard'));

        // Check user exists in database with default role
        $this->assertDatabaseHas('users', [
            'name'  => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone' => '08123456789',
            'role'  => 'anggota',
        ]);

        // Check user is authenticated
        $this->assertTrue(auth()->check());
        $this->assertEquals('johndoe@example.com', auth()->user()->email);
    }

    /**
     * Test validation rules for registration.
     */
    public function test_registration_validation_rules(): void
    {
        // 1. All fields required
        $response = $this->post('/register', []);
        $response->assertSessionHasErrors(['name', 'email', 'phone', 'password']);

        // 2. Email unique
        User::factory()->create([
            'email' => 'existing@example.com',
        ]);

        $response = $this->post('/register', [
            'name'                  => 'Jane Doe',
            'email'                 => 'existing@example.com',
            'phone'                 => '08123456789',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email']);

        // 3. Password minimum 8 characters and confirmed
        $response = $this->post('/register', [
            'name'                  => 'Jane Doe',
            'email'                 => 'jane@example.com',
            'phone'                 => '08123456789',
            'password'              => 'short',
            'password_confirmation' => 'short',
        ]);

        $response->assertSessionHasErrors(['password']);

        $response = $this->post('/register', [
            'name'                  => 'Jane Doe',
            'email'                 => 'jane@example.com',
            'phone'                 => '08123456789',
            'password'              => 'password123',
            'password_confirmation' => 'different',
        ]);

        $response->assertSessionHasErrors(['password']);
    }
}
