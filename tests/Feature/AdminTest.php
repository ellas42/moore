<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminTest extends TestCase
{
    public function test_admin_dashboard_is_accessible(): void
    {
        $response = $this->get('/admin');

        $response->assertStatus(200);
    }
}
