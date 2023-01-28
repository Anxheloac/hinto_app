<?php

namespace App\Services;

use App\Models\User\User;

/**
 * This interface need to be implemented
 * by third parties classes/API that we use to get data
 */
interface DataApiInterface
{
    public function getUsers(): array;

    public function getPosts(): array;

    public function getPostsByUser(int $userId): array;
}
