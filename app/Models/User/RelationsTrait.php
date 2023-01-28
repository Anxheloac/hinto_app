<?php

namespace App\Models\User;

use App\Models\Post\Post;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait RelationsTrait
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
