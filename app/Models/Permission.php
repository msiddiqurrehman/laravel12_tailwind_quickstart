<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
