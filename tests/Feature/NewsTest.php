<?php
    
    namespace Tests\Feature;
    
    use App\Models\News;
    use App\Models\Tag;
    use Arr;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Illuminate\Foundation\Testing\WithFaker;
    use Tests\TestCase;
    
    class NewsTest extends TestCase
    {
        use RefreshDatabase , WithFaker;
        
        public function setUp () : void
        {
            parent ::setUp ();
            $this -> setUpFaker ();
            
            
        }
        
        public function test_a_user_can_get_all_news_paginate_by_10 ()
        {
            News ::factory () -> count ( 30 ) -> create ();
            $paginationSize = 10;
            
            $this -> assertDatabaseCount ( 'news' , 30 );
            
            $response = $this -> get ( route ( 'news.index' ) );
            
            $response -> assertStatus ( 200 );
            
            $responseArray = json_decode ( $response -> getContent () , true );
            
            $this -> assertTrue ( count ( $responseArray[ 'data' ] ) == $paginationSize );
            
        }
        
        public function test_a_user_can_add_a_news_in_db ()
        {
            $newsRequestBodyArray = [
                'title' => $this -> faker -> sentence ( 6 , true ) ,
                'content' => $this -> faker -> paragraph ( 3 , true ) ,
                'is_published' => $this -> faker -> boolean ( 85 ) ,
            ];
            
            $this -> assertDatabaseMissing ( 'news' , $newsRequestBodyArray );
            
            $response = $this -> post ( route ( 'news.store' ) , $newsRequestBodyArray );
            
            $response -> assertStatus ( 201 );
            
            $this -> assertDatabaseHas ( 'news' , $newsRequestBodyArray );
            
        }
        
        public function test_a_user_can_add_a_news_in_db_with_existing_tags ()
        {
            $tags_array = Tag ::factory () -> count ( 2 ) -> create () -> toArray ();
            
            $newsRequestBodyArray = [
                'title' => $this -> faker -> sentence ( 6 , true ) ,
                'content' => $this -> faker -> paragraph ( 3 , true ) ,
                'is_published' => $this -> faker -> boolean ( 85 ) ,
                'tags' => [
                    [ "id" => $tags_array[ 0 ][ 'id' ] , "name" => $tags_array[ 0 ][ 'name' ] ] ,
                    [ "id" => $tags_array[ 1 ][ 'id' ] , "name" => $tags_array[ 1 ][ 'name' ] ] ,
                ],
            ];
            
            $this -> assertDatabaseMissing ( 'news' , $newsRequestBodyArray );
            
            $response = $this -> post ( route ( 'news.store' ) , $newsRequestBodyArray );
            $response -> assertStatus ( 201 );
            $news_created = json_decode ( $response -> getContent () , true );
            
            $this -> assertDatabaseHas ( 'news' , \Arr ::except ( $newsRequestBodyArray , 'tags' ) );
            $this -> assertDatabaseHas ( 'news_tag' , [ 'news_id' => $news_created[ 'id' ] , 'tag_id' => $tags_array[ 0 ][ 'id' ] ] );
            $this -> assertDatabaseHas ( 'news_tag' , [ 'news_id' => $news_created[ 'id' ] , 'tag_id' => $tags_array[ 1 ][ 'id' ] ] );
            
            
        }
        
        public function test_a_user_can_add_a_news_in_db_with_new_tags ()
        {
            
            $newsRequestBodyArray = [
                'title' => $this -> faker -> sentence ( 6 , true ) ,
                'content' => $this -> faker -> paragraph ( 3 , true ) ,
                'is_published' => $this -> faker -> boolean ( 85 ) ,
                'tags' => [
                    'test_tag_1' ,
                    'test_tag_2' ,
                ],
            ];
            
            $this -> assertDatabaseMissing ( 'news' , $newsRequestBodyArray );
            
            $response = $this -> post ( route ( 'news.store' ) , $newsRequestBodyArray );
            
            $response -> assertStatus ( 201 );
            
            $news_created = json_decode ( $response -> getContent () , true );
            
            $this -> assertDatabaseHas ( 'news' , \Arr ::except ( $newsRequestBodyArray , 'tags' ) );
            
            
            $this -> assertTrue ( (int) News ::withCount ( 'tags' ) -> first ( $news_created ) -> tags_count == 2 );
            
            
        }
        
        public function test_a_user_cannot_add_a_news_in_db_without_title ()
        {
            $newsRequestBodyArray = [
                'content' => $this -> faker -> paragraph ( 3 , true ) ,
                'is_published' => $this -> faker -> boolean ( 85 ) ,
            ];
            
            $this -> assertDatabaseMissing ( 'news' , $newsRequestBodyArray );
            
            $response = $this -> post ( route ( 'news.store' ) , $newsRequestBodyArray );
            
            $response -> assertStatus ( 422 );
            
            $response -> assertSeeText ( 'The title field is required.' );
            
            $this -> assertDatabaseMissing ( 'news' , $newsRequestBodyArray );
            
        }
        
        public function test_a_user_cannot_add_a_news_in_db_without_content ()
        {
            $newsRequestBodyArray = [
                'title' => $this -> faker -> sentence ( 6 , true ) ,
                'is_published' => $this -> faker -> boolean ( 85 ) ,
            ];
            $this -> assertDatabaseMissing ( 'news' , $newsRequestBodyArray );
            
            $response = $this -> post ( route ( 'news.store' ) , $newsRequestBodyArray );
            
            $response -> assertStatus ( 422 );
            $response -> assertSeeText ( 'The content field is required.' );
            $this -> assertDatabaseMissing ( 'news' , $newsRequestBodyArray );
            
        }
        
        public function test_a_user_cannot_add_a_news_in_db_without_is_published ()
        {
            $newsRequestBodyArray = [
                'title' => $this -> faker -> sentence ( 6 , true ) ,
                'content' => $this -> faker -> paragraph ( 3 , true ) ,
            ];
            $this -> assertDatabaseMissing ( 'news' , $newsRequestBodyArray );
            
            $response = $this -> post ( route ( 'news.store' ) , $newsRequestBodyArray );
            
            $response -> assertStatus ( 422 );
            $response -> assertSeeText ( 'The published field is required.' );
            $this -> assertDatabaseMissing ( 'news' , $newsRequestBodyArray );
            
        }
        
        public function test_a_user_can_update_a_news ()
        {
            $news = News ::factory () -> create ();
            $newsUpdateRequestBodyArray = [
                'title' => $this -> faker -> sentence ( 6 , true ) ,
                'content' => $this -> faker -> paragraph ( 3 , true ) ,
                'is_published' => $this -> faker -> boolean ( 85 ) ,
            ];
            
            $this -> assertDatabaseMissing ( 'news' , $newsUpdateRequestBodyArray );
            
            $response = $this -> put ( route ( 'news.update' , $news ) , $newsUpdateRequestBodyArray );
            $response -> assertStatus ( 204 );
            $this -> assertDatabaseHas ( 'news' , $newsUpdateRequestBodyArray  );
            
        }
        public function test_a_user_can_update_tasks_of_a_news_in_db ()
        {
            $news = News ::factory () -> create ();
            $tags_array = Tag ::factory () -> count ( 3 ) -> create () -> toArray ();
            $news->tags()->sync([$tags_array[ 0 ][ 'id' ],$tags_array[ 1][ 'id' ]]);
            $this -> assertTrue ( (int)$news->load('tags')->tags->count() == 2 );
            
            $newsUpdateRequestBodyArray = [
                'title' => $this -> faker -> sentence ( 6 , true ) ,
                'content' => $this -> faker -> paragraph ( 3 , true ) ,
                'is_published' => $this -> faker -> boolean ( 85 ) ,
                'tags' => [
                    [ "id" => $tags_array[ 0 ][ 'id' ] , "name" => $tags_array[ 0 ][ 'name' ] ] ,
                    [ "id" => $tags_array[ 2 ][ 'id' ] , "name" => $tags_array[ 2 ][ 'name' ] ] ,
                ],
            ];
            
            $this -> assertDatabaseMissing ( 'news' , $newsUpdateRequestBodyArray );
            
            $response = $this -> put ( route ( 'news.update' , $news ) , $newsUpdateRequestBodyArray );
           
            $response -> assertStatus ( 204 );
            
            $this -> assertDatabaseHas ( 'news' , Arr::except($newsUpdateRequestBodyArray,'tags')  );
            $this -> assertDatabaseHas ( 'news_tag' , [ 'news_id' => $news->id , 'tag_id' => $tags_array[ 0 ][ 'id' ] ] );
            $this -> assertDatabaseHas ( 'news_tag' , [ 'news_id' => $news->id , 'tag_id' => $tags_array[ 2 ][ 'id' ] ] );
            $this -> assertTrue ( (int)$news->load('tags')->tags->count() == 2 );
    
            
        }
        
        public function test_a_user_can_softdelete_a_news ()
        {
            $id = News ::factory () -> create () -> id;
            $this -> assertDatabaseHas ( 'news' , [ 'id' => $id ] );
            $response = $this -> delete ( route ( 'news.destroy' , $id ) );
            $response -> assertStatus ( 204 );
            $this -> assertSoftDeleted ( 'news' , [
                'id' => $id ,
            
            ] );
        }
        
        public function test_a_user_can_undo_a_delete_on_a_news ()
        {
            $deleted_date = now () -> subDay ();
            $id = News ::factory ( ['deleted_at'=> $deleted_date ]) -> create () -> id;
            $this->assertTrue ( News::withTrashed ()->count() == 1);
            $this -> assertDatabaseHas ( 'news' , [ 'id' => $id,'deleted_at'=> $deleted_date] );
            $response = $this -> get ( route ( 'news.undo-delete' , $id ) );
            $response -> assertStatus ( 204 );

            $this->assertTrue ( News::withoutTrashed ()->count() == 1);
            $this->assertTrue ( News::onlyTrashed ()->count() == 0);
        
        }
    }
