<?php

namespace Tests\Feature;

use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetNewsTest extends TestCase
{
    use RefreshDatabase;
    public function setUp () : void
    {
        parent ::setUp ();
        News::factory()->count(30)->create();
    }
    
    public function test_a_user_can_get_all_news_paginate_by_10()
    {
        $paginationSize = 10;
        
        $this->withoutExceptionHandling ();
        $this->assertDatabaseCount ( 'news' , 30);
        
        $response = $this->get(route('news.index'));
        
        $response->assertStatus(200);
      
        $responseArray = json_decode($response->getContent(),true);
     
        $this->assertTrue ( count($responseArray['data']) == $paginationSize);
      
        
        
    }
}
