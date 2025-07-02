<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'status',
        'type',
        'created_by',
    ];

    /**
     * UserType status labels.
     *
     * @var list<string>
     */
    private $statusLabels = [
        0 => 'Inactive',
        1 => 'Active',
    ];

    /**
     * Get the status label of the UserType.
     */
    public function getStatusLabel($statusCode): String
    {
        return $this->statusLabels[$statusCode];
    }

    /**
     * Get the user who created the User Type.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
