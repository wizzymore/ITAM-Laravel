<?php

namespace App\Domain\Employees\Models;

use App\Domain\Assets\Models\Asset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    public function getName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function assets(): HasMany
    {
        return $this->hasMany(Asset::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
