<?php

namespace Tests\Feature;

use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetNewsTest extends TestCase
{
    use RefreshDatabase,WithFaker;
    
    public function setUp () : void
    {
        parent ::setUp ();
        $this->setUpFaker();
        News::factory()->count(30)->create();
    }
    
    public function test_a_user_can_get_all_news_paginate_by_10()
    {
        
        $paginationSize = 10;
        
        $this->assertDatabaseCount ( 'news' , 30);
        
        $response = $this->get(route('news.index'));
        
        $response->assertStatus(200);
      
        $responseArray = json_decode($response->getContent(),true);
     
        $this->assertTrue ( count($responseArray['data']) == $paginationSize);
        
    }
    
    public function test_a_user_can_add_a_news_in_db (  )
    {
        $newsRequestBodyArray = [
            'title' => $this -> faker -> sentence ( 6 , true ) ,
            'content' => $this -> faker -> paragraph ( 3 , true ) ,
            'is_published' => $this -> faker -> boolean ( 85 ) ,
        ];
        $this->assertDatabaseMissing ( 'news' , $newsRequestBodyArray);
        
        $response = $this->post( route( 'news.store'), $newsRequestBodyArray );
    
        $response->assertStatus(201);
        
        $this->assertDatabaseHas ( 'news' , $newsRequestBodyArray);
        
    }
    
    public function test_a_user_cannot_add_a_news_in_db_without_title (  )
    {
        $newsRequestBodyArray = [
            'content' => $this -> faker -> paragraph ( 3 , true ) ,
            'is_published' => $this -> faker -> boolean ( 85 ) ,
        ];
        $this->assertDatabaseMissing ( 'news' , $newsRequestBodyArray);
        
        $response = $this->post( route( 'news.store'), $newsRequestBodyArray );
        
        $response->assertStatus(422);
        $response->assertSeeText  ( 'The title field is required.');
        
        $this->assertDatabaseMissing  ( 'news' , $newsRequestBodyArray);
        
    }
    
    public function test_a_user_cannot_add_a_news_in_db_without_content (  )
    {
        $newsRequestBodyArray = [
            'title' => $this -> faker -> sentence ( 6 , true ) ,
            'is_published' => $this -> faker -> boolean ( 85 ) ,
        ];
        $this->assertDatabaseMissing ( 'news' , $newsRequestBodyArray);
        
        $response = $this->post( route( 'news.store'), $newsRequestBodyArray );
        
        $response->assertStatus(422);
        $response->assertSeeText  ( 'The content field is required.');
        
        $this->assertDatabaseMissing  ( 'news' , $newsRequestBodyArray);
        
    }
    
    public function test_a_user_cannot_add_a_news_in_db_without_is_published (  )
    {
        $newsRequestBodyArray = [
            'title' => $this -> faker -> sentence ( 6 , true ) ,
            'content' => $this -> faker -> paragraph ( 3 , true ) ,
        ];
        $this->assertDatabaseMissing ( 'news' , $newsRequestBodyArray);
        
        $response = $this->post( route( 'news.store'), $newsRequestBodyArray );
        
        $response->assertStatus(422);
        $response->assertSeeText  ( 'The published field is required.');
        
        $this->assertDatabaseMissing  ( 'news' , $newsRequestBodyArray);
        
    }
   
}
