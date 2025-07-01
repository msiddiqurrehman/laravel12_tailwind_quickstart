<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'role_id',
        'module_id',
        'can_create',
        'can_delete',
        'can_edit',
        'can_view',
        'created_by',
    ];

    /**
     * Get the user who created the permission.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the role of the permission.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the module of the permission.
     */
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }
}
