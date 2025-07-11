<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmpDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'designation_id',
        'referrer_name',
        'referrer_contact',
        'identity_document_path',
        'education_document_path',
        'resume_path',
    ];

    /**
     * Get the user of this employee detail.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the designation related to this employee detail.
     */
    public function designation(): BelongsTo
    {
        return $this->belongsTo(Designation::class);
    }
}
