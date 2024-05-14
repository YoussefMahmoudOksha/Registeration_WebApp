<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // For Unit Testing Methods
    // protected $confirmPassword;

    public function isValidPhoneNumber()
    {
        return preg_match('/^(011|010|012|015)/', $this->phone) === 1;
    }
//  public function passwordMatches()
// {
//     return $this->password === $this->confirmPassword;
// }

public function isAdult($birthdate)
{
    $birthdate = new \DateTime($birthdate);
    $now = new \DateTime();
    $age = $now->diff($birthdate)->y;

    return $age >= 18;
}
public function isValidImageExtension($filename)
{
    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif','svg','webp','bmp'];

    return in_array($extension, $allowedExtensions);
}
}
