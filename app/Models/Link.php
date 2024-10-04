<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'description',
        'added_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'added_at' => 'datetime',
    ];

    public function addedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value ?? $this->created_at),
            set: fn ($value) => $value
        );
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'link_tags');
    }
}
