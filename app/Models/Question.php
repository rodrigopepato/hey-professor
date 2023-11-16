<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    /**
     * @return HasMany<Vote>
     */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function likes(): CastsAttribute
    {
        return new CastsAttribute(get: fn () => $this->votes()->sum('like'));
    }

    public function unlikes(): CastsAttribute
    {
        return new CastsAttribute(get: fn () => $this->votes()->sum('unlike'));
    }
}
