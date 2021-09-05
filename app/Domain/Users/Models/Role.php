<?php

namespace App\Domain\Users\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Sushi\Sushi;

class Role extends Model
{
    use Sushi;

    protected $rows = [
        ['id' => 1, 'label' => 'IT Support'],
        ['id' => 2, 'label' => 'IT Level 2'],
        ['id' => 3, 'label' => 'IT Admin'],
    ];

    public function users():BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
