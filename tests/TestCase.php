<?php

namespace Tests;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public User $user;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function asUser()
    {
        if (empty($this->user)) {
            $this->user = User::factory()->create();
        }
        return Sanctum::actingAs($this->user, ['*']);
    }
}
