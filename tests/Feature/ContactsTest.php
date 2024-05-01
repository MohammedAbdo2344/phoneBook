<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_fetch_all_contacts(): void
    {
        $response = $this->getJson(route("contacts.index"));
        $this->assertEquals(0, count($response->json()));
    }
}
