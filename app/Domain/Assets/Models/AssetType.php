<?php

namespace App\Domain\Assets\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AssetType extends Model
{
    use HasFactory;

    public function assets(): BelongsToMany
    {
        return $this->belongsToMany(Asset::class);
    }
}
