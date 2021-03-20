<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public User $user;

    public function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
    }

    public function asUser()
    {
        if (empty($this->user)) {
            $this->user = User::factory()->create();
        }
        return $this->actingAs($this->user);
    }
}
