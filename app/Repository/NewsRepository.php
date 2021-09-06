<?php
    
    namespace App\Repository;
    
    
    use App\Models\News;
    use App\Services\News\PrepareTagsForSync;
    
    class NewsRepository
    {
        
        
        private PrepareTagsForSync $prepare_tags_service;
        
        public function __construct ( PrepareTagsForSync $prepare_tags_service )
        {
            $this -> prepare_tags_service = $prepare_tags_service;
        }
        
        public function getFilteredAndPaginate ( int $count )
        {
            return News :: with ( [ 'tags' ] )
                -> when ( request () -> has ( 'searchTerms' ) , function ( $q ) {
                    return $q -> where ( 'title' , 'like' , '%' . request ( "searchTerms" ) . '%' )
                        -> orWhere ( 'content' , 'like' , '%' . request ( "searchTerms" ) . '%' );
                } ) -> latest () -> paginate ( $count );
        }
        
        public function storeNews ( array $validatedDatas )
        {
            
            $news = News ::create ( \Arr ::except ( $validatedDatas , 'tags' ) );
            
            
            $this -> syncTasks ( $news , $validatedDatas );
            
            return $news;
        }
        
        public function update ( News $news , array $validatedDatas )
        {
            $news -> update ( $validatedDatas );
            
            $this -> syncTasks ( $news , $validatedDatas);
            
            return $news;
        }
        
        protected function syncTasks ( News $news , array $validatedDatas ) : void
        {
            if ( isset( $validatedDatas[ 'tags' ] ) ) {
                $news -> tags () -> sync ( $this -> prepare_tags_service -> handel ( $validatedDatas[ 'tags' ]  ) );
            }else{
                $news -> tags () -> detach();
            }
            
            
        }
    }
