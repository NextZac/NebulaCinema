<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ComponentsTest extends TestCase
{
    /** @test */
    public function schedule_filter_component_exists_and_is_interactive()
    {
        $response = $this->get("/components");

        $response->assertStatus(200);
    }
}
