<?php

namespace Tests\Unit\Controllers;

use App\Models\Submitter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\GuestbookEntry;


class GuestbookControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexRoute()
    {
        $response = $this->get('/guestbook');
        $response->assertStatus(200); 
    }


    public function testCreateEntry()
    {

        $submitter = Submitter::factory()->create();
   
        $response = $this->post('/guestbook/sign', [
            'title' => 'Test Entry',
            'content' => 'Test content',
            'name' => $submitter->display_name,
            'real_name' => $submitter->real_name,
            'email' => $submitter->email,
        ]);

        $response->assertRedirect();
    }

    public function testDeleteEntry()
    {
        $entry = GuestbookEntry::factory()->create();
  
        $response = $this->delete('/guestbook/' . $entry->id);

        $response->assertStatus(200);
    }

}
