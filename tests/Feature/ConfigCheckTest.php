<?php

namespace Arthmelikyan\Laramidjourney\Tests\Feature;

use Arthmelikyan\Laramidjourney\Tests\TestCase;

class ConfigCheckTest extends TestCase
{
    public function test_that_config_file_is_loaded()
    {
        $this->assertIsArray(config('laramidjourney'));
    }

    public function test_that_api_token_is_set()
    {
        $this->assertNotNull(config('laramidjourney.midjourney_api_token'));
    }
}