<?php

namespace App\Domain\Assets\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Sushi\Sushi;

class AssetType extends Model
{
    use Sushi;

    protected $rows = [
        ['id' => 1, 'label' => 'IIS'],
        ['id' => 2, 'label' => 'IIR'],
    ];

    public function assets(): BelongsToMany
    {
        return $this->belongsToMany(Asset::class);
    }
}
