<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
class RegistrationFeatureTest extends TestCase
{
    use RefreshDatabase;
    use InteractsWithDatabase;

    // still not working !!
    public function test_registration_form()
    {
        // specify the database connection
        config(['database.default' => 'regdb']);

        //$image = UploadedFile::fake()->image('photo.jpg');

        $controller = new UserController();
        $request = new Request([
            'fullname' => 'Ahmed Nabil',
            'username' => 'medo',
            'birthdate' => '2003-01-01',
            'phone' => '01145372314',
            'address' => 'maadi',
            'email' => 'ahmed@gmail.com',
            'password' => 'Ahmed123!',
            //'image' => $image,
        ]);
        $response = $controller->store($request);

        $this->assertDatabaseHas('regusers', ['username' => 'medo']);
        $this->assertTrue(session()->has('success'));
    }

    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
