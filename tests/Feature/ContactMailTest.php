<?php

namespace Tests\Feature;

use App\Models\ContactMail;
use App\Models\ContactMobile;
use App\Models\Contacts;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactMailTest extends TestCase
{
    use RefreshDatabase;
    private $contact_mails;
    private $contact;
    public function setup(): void
    {
        parent::setUp();
        $this->contact = Contacts::factory()->create();
        $this->contact_mails = ContactMail::factory()->create();
    }
    public function test_fetch_all_contacts_mail(): void
    {
        $response = $this->getJson(route("mails.index", $this->contact->id));
        $this->assertEquals(1, count($response->json()));
    }
    public function test_fetch_single_contact_mail(): void
    {
        $response = $this->getJson(
            route(
                "mails.show",
                [
                    'contact' => $this->contact->id,
                    'mail' => $this->contact_mails->id
                ]
            )
        );
        $this->assertEquals(1, count($response->json()));
    }
    public function test_store_new_contact_mail(): void
    {
        Contacts::factory()->make();
        $contact_mail = ContactMail::factory()->make();
        $this->postJson(
            route(
                "mails.store",
                ['contact' => $this->contact->id]
            ),
            [
                'contact_id' => $contact_mail->contact_id,
                'mail' => $contact_mail->mail,
            ]
        )->json();
        $this->assertDatabaseHas("contact_mails", ['mail' => $contact_mail->mail]);
    }
    public function test_while_storing_new_contact_mobile_mail_is_required(): void
    {
        $this->postJson(
            route(
                "mails.store",
                ['contact' => $this->contact->id]
            )
        )
            ->assertJsonValidationErrors(['mail'])
            ->json();
    }
    public function test_while_storing_new_contact_mobile_mail_is_unique(): void
    {
        $this->contact_mails = ContactMail::factory()->create(['mail' => "mohammed@example.com"]);
        $response = $this->postJson(
            route(
                "mails.store",
                ['contact' => $this->contact->id]
            ),
            [
                'mail' => "mohammed@example.com"
            ]
        )
            ->assertJsonValidationErrors(['mail'])
            ->json();
    }
    public function test_while_storing_new_contact_mobile_email_is_email(): void
    {
        $response = $this->postJson(
            route(
                "mails.store",
                ['contact' => $this->contact->id]
            ),
            [
                'mail' => 'mohammed_email'
            ]
        )
            ->assertJsonValidationErrors(['mail'])
            ->json();
    }
    public function test_delete_contact_mail()
    {
        $this->deleteJson(
            route(
                "mails.destroy",
                [
                    'contact' => $this->contact->id,
                ]
            ),
            [
                'id' => $this->contact_mails->id
            ]
        );
        $this->assertDatabaseMissing("contact_mails", ["id" => $this->contact_mails->id]);
    }
    public function test_update_contact_mobile()
    {
        $this->putJson(
            route(
                "mails.update",
                [
                    'contact' => $this->contact->id,
                ]
            ),
            [
                'id' => $this->contact_mails->id,
                'mail' => 'mohammed@ex.com'
            ]
        )
            ->assertOk();
        $this->assertDatabaseHas('contact_mails', [
            'id' => $this->contact_mails->id,
            'mail' => 'mohammed@ex.com'
        ]);
    }
}
