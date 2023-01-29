<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\TestCase;

class DataServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_users_success()
    {
        Http::fake([
            ''
        ]);
    }
}
