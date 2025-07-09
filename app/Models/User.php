<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'user_type_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'contact_no',
        'sec_contact_no',
        'password',
        'image_path',
        'address',
        'city',
        'district',
        'state_id',
        'country_id',
        'status',
        'created_by'
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
     * User status labels.
     *
     * @var list<string>
     */
    private $statusLabels = [
        0 => 'Inactive',
        1 => 'Active',
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
     * Get the status label of the user.
     */
    public function getStatusLabel($statusCode): String
    {
        return $this->statusLabels[$statusCode];
    }

    /**
     * Check if User is a staff member (or administrator).
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

    /**
     * Get the employee details associated with the user.
     */
    public function empDetail(): HasOne
    {
        return $this->hasOne(EmpDetail::class);
    }

    /**
     * Get the user who created this user.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the type of the user.
     */
    public function userType(): BelongsTo
    {
        return $this->belongsTo(UserType::class);
    }

    /**
     * The roles that belong to the user.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
