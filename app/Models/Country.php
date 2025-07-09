<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Country extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'iso3',
        'iso2',
        'status',
        'created_by'
    ];

    /**
     * Status labels.
     *
     * @var list<string>
     */
    private $statusLabels = [
        0 => 'Inactive',
        1 => 'Active',
    ];

    /**
     * Get the status label of the country.
     */
    public function getStatusLabel($statusCode): String
    {
        return $this->statusLabels[$statusCode];
    }

    /**
     * Get the states of the country.
     */
    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }

    /**
     * Get the user who created the country.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
