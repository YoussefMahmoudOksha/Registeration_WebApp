<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\DB;

class RegistrationFeatureTest extends TestCase
{
    use RefreshDatabase;
    use InteractsWithDatabase;
    use WithoutMiddleware;



    public function test_registration_form()
    {
        $controller = new UserController();
        $request = new Request([
            'fullname' => 'Ahmed Nabil',
            'username' => 'medo',
            'birthdate' => '2003-01-01',
            'phone' => '01145372314',
            'address' => 'maadi',
            'email' => 'ahmed@gmail.com',
            'password' => 'Ahmed123!',
            'image' => '171577661014 (2).jpg',
        ]);
        $response = $controller->store($request);

        $this->assertDatabaseHas('regusers', ['username' => 'medo']);
        $this->assertTrue(session()->has('success'));
    }


    public function test_registration_form_submission()
    {
        $response = $this->post('/addUser', [
            'fullname' => 'Ahmed Nabil',
            'username' => 'medo',
            'birthdate' => '2003-01-01',
            'phone' => '01145372314',
            'address' => 'maadi',
            'email' => 'ahmed@gmail.com',
            'password' => 'Ahmed123!',
            'image' => '171577661014 (2).jpg',
        ]);
        $response->assertRedirect();
        $this->get($response->getTargetUrl())
             ->assertStatus(200);
    }
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
