<?php

namespace Tests\Feature;

use App\Models\Contacts;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;
    private $contact;
    public function setup(): void
    {
        parent::setUp();
        $this->contact = Contacts::factory()->create();
    }
    public function test_all_contact(): void
    {
        $response = $this->getJson(route("contacts.index"));
        $this->assertEquals(1, count($response->json()));
    }
    public function test_single_contact(): void
    {
        $response = $this->getJson(route("contacts.show", $this->contact->id));
        $this->assertEquals(1, count($response->json()));
    }
    public function test_store_new_contact(): void
    {
        $contact = Contacts::factory()->make();
        $this->postJson(route("contacts.store"), [
            'name' => $contact->name,
            'image' => $contact->image
        ])->json();
        $this->assertDatabaseHas("contacts", ['name' => $contact->name]);
    }
    public function test_while_storing_new_contact_name_is_required(): void
    {
        $this->postJson(route("contacts.store"))
            ->assertJsonValidationErrors(['name'])
            ->json();
    }
    public function test_while_storing_new_contact_name_min_is_3(): void
    {
        $this->postJson(route("contacts.store", ['name' => 'mo']))
            ->assertJsonValidationErrors(['name'])
            ->json();
    }
    public function test_while_storing_new_contact_name_max_is_100(): void
    {
        $this->postJson(
            route(
                "contacts.store",
                [
                    'name' => "
                            Lorem Ipsum is simply dummy
                            Lorem Ipsum is simply dummy
                            text of the printing and typesetting industryLorem
                            Ipsum has been the industrys standard dummy text ever since the
                            when an unknown printer took a galley of type and scrambled it to make a type
                            specimen book
                            It has survived not only five centuries
                            but also the leap into electronic typesetting
                            remaining essentially unchanged
                            It was popularised in the with the release of Letraset sheets containing Lorem Ipsum passages
                            and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum
                            "
                ]
            )
        )
            ->assertJsonValidationErrors(['name'])
            ->json();
    }
    public function test_while_storing_new_contact_name_is_string(): void
    {
        $this->postJson(route("contacts.store", ['name' =>  123, 'image' => 'image_src']))
            ->assertJsonValidationErrors(['name'])
            ->json();
    }
    public function test_delete_contact()
    {
        $this->deleteJson(route("contacts.desrtoy"), ["id" => $this->contact->id]);
        $this->assertDatabaseMissing("contacts", ["id" => $this->contact->id]);
    }
    public function test_update_contact()
    {
        $this->putJson(
            route("contacts.update"),
            [
                'id' => $this->contact->id,
                'name' => 'update name'
            ]
        );
        $this->assertDatabaseHas('contacts', [
            'id' => $this->contact->id,
            "name" => "update name"
        ]);
    }
}
