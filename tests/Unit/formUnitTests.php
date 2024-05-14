<?php

namespace Tests\Unit;

use Tests\TestCase;
// use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithRoutes;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;

class formUnitTests extends TestCase
{
    use WithoutMiddleware;
    use WithFaker;

    public function test_registeration_form_accessible()
    {
        $response = $this->post('/addUser');
        $response->assertStatus(302); // check if the page is redirected

        // Follow the redirect
        $response->assertRedirect();

        $this->get($response->getTargetUrl())
             ->assertStatus(200);
    }


    //================================================================================================
    public function test_phone_number_starts_with_valid_prefixes()
    {
        $user = new User();

        $validPhoneNumbers = [
            '01112345678',
            '01012345678',
            '01212345678',
            '01512345678'
        ];

        foreach ($validPhoneNumbers as $phoneNumber) {
            $user->phone = $phoneNumber;
            $this->assertTrue($user->isValidPhoneNumber());
        }

        $user->phone = '01612345678'; // Invalid
        $this->assertFalse($user->isValidPhoneNumber());
    }
//================================================================================================
// public function test_password_matches()
// {
//     $user = new User();

//     $password = 'Ahmed123!';
//     $user->password = $password;
//     $user->confirmPassword = $password;

//     // match
//     $this->assertTrue($user->passwordMatches());

//     // different confirm password
//     $user->confirmPassword = 'differentpassword';

//     // passwords don't match
//     $this->assertFalse($user->passwordMatches());
// }
//================================================================================================
public function test_user_age_18_or_more()
{
    $user = new User();

    $birthdate = '2003-01-01';
    $isAdult = $user->isAdult($birthdate);

    $this->assertTrue($isAdult);
}
public function test_user_is_non_adult()
{
    $user = new User();

    $birthdate = '2010-01-01';
    $isAdult = $user->isAdult($birthdate);

    $this->assertFalse($isAdult);
}
//================================================================================================
public function test_image_extension_allowed()
    {
        $user = new User();

        $filename = 'image.jpg';
        $isValidExtension = $user->isValidImageExtension($filename);

        $this->assertTrue($isValidExtension);
    }
    public function test_image_extension_not_allowed()
    {
        $user = new User();

        $filename = 'document.pdf';
        $isValidExtension = $user->isValidImageExtension($filename);

        $this->assertFalse($isValidExtension);
    }

//================================================================================================



// unit upon phone start numbers
// unit on password match -> error
// unit on date + 18
// unit on image extension

    public function test_example(): void
    {
        $this->assertTrue(true);
    }
}
