<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'contact_no',
        'sec_contact_no',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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

    /**
     * Check if User is an administrator.
     *
     * @return boolean
     */
    public function isUserAdmin(): bool
    {
        return $this->user_type_id == 1;
    }

    /**
     * Check if User is a partner.
     *
     * @return boolean
     */
    public function isUserPartner(): bool
    {
        return $this->user_type_id == 2;
    }

    /**
     * Check if User is a customer.
     *
     * @return boolean
     */
    public function isUserCustomer(): bool
    {
        return $this->user_type_id == 3;
    }
}
