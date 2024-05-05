<?php

namespace Tests\Feature;

use App\Models\ContactMobile;
use App\Models\Contacts;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactMobileTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    private $contact_mobile;
    private $contact;
    public function setup(): void
    {
        parent::setUp();
        $this->contact = Contacts::factory()->create();
        $this->contact_mobile = ContactMobile::factory()->create();
    }
    public function test_fetch_all_contact_mobile(): void
    {
        $response = $this->getJson(route("mobiles.index", $this->contact->id));
        $this->assertEquals(1, count($response->json()));
    }
    public function test_fetch_single_contact_mobile(): void
    {
        $response = $this->getJson(
            route(
                "mobiles.show",
                [
                    'contact' => $this->contact->id,
                    'mobile' => $this->contact_mobile->id
                ]
            )
        );
        $this->assertEquals(1, count($response->json()));
    }
    public function test_store_new_contact_mobile(): void
    {
        $contact = Contacts::factory()->make();
        $contact_mobile = ContactMobile::factory()->make();
        // dd($contact_mobile);
        $this->postJson(
            route(
                "mobiles.store",
                ['contact' => $this->contact->id]
            ),
            [
                'contact_id' => $contact_mobile->contact_id,
                'number' => $contact_mobile->number,
            ]
        )->json();
        $this->assertDatabaseHas("contact_mobiles", ['number' => $contact_mobile->number]);
    }
    public function test_while_storing_new_contact_mobile_number_is_required(): void
    {
        $response = $this->postJson(
            route(
                "mobiles.store",
                ['contact' => $this->contact->id]
            )
        )
            ->assertJsonValidationErrors(['number'])
            ->json();
        // dd($response);
    }
    public function test_while_storing_new_contact_mobile_number_is_digit_11(): void
    {
        $response = $this->postJson(
            route(
                "mobiles.store",
                ['contact' => $this->contact->id]
            ),
            [
                'number' => '123456'
            ]
        )
            ->assertJsonValidationErrors(['number'])
            ->json();
        // dd($response);
    }
    public function test_while_storing_new_contact_mobile_number_is_unique(): void
    {
        $this->contact_mobile = ContactMobile::factory()->create(['number' => "01017074419"]);
        // dd($this->contact_mobile);
        $response = $this->postJson(
            route(
                "mobiles.store",
                ['contact' => $this->contact->id]
            ),
            [
                'number' => '01017074419'
            ]
        )
        ->assertJsonValidationErrors(['number'])

            ->json();
        // dd($response);
    }
    public function test_delete_contact_mobile()
    {
        // dd($this->contact);
        $this->deleteJson(
            route(
                "mobiles.destroy",
                [
                    'contact' => $this->contact->id,
                    'mobile' => $this->contact_mobile->id
                ]
            )
        );
        $this->assertDatabaseMissing("contact_mobiles", ["id" => $this->contact_mobile->id]);
    }
    public function test_update_contact_mobile()
    {
        $this->patchJson(
            route(
                "mobiles.update",
                [
                    'contact' => $this->contact->id,
                    'mobile' => $this->contact_mobile->id
                ]
            ),
            ['number' => '01017074416']
        )
            ->assertOk();
        $this->assertDatabaseHas('contact_mobiles', [
            'id' => $this->contact_mobile->id,
            'number' => '01017074416'
        ]);
    }
}
