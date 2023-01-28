<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory,
        AccessorTrait,
        MutatorTrait,
        RelationsTrait,
        ScopesTrait,
        MethodTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'user_id'
    ];
}
