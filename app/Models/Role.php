<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'status',
        'title',
        'created_by',
    ];

    /**
     * Role status labels.
     *
     * @var list<string>
     */
    private $statusLabels = [
        0 => 'Inactive',
        1 => 'Active',
    ];

    /**
     * Get the status label of the role.
     */
    public function getStatusLabel($statusCode): String
    {
        return $this->statusLabels[$statusCode];
    }

    /**
     * Get the user who created the role.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the permissions of the role.
     */
    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class);
    }
}
