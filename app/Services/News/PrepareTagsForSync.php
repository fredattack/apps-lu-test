<?php
    
    
    namespace App\Services\News;
    
    
    use App\Models\Tag;
    
    class PrepareTagsForSync
    {
    
        /**
         * @param array $a_tags
         *  if tag exist array (id, name) is passed by select  in request
         *  if new tag only name is passed by select in request.
         * @return array
         */
        public function handel ( array $a_tags ) : array
        {
            $syncable_tags_array = [];
            
            foreach ( $a_tags as $tag ) {
                if ( is_array ( $tag ) ) {
                    $syncable_tags_array[] = $tag[ 'id' ];
                } else {
                    $syncable_tags_array[] = Tag ::create ( [ 'name' => $tag ] )->id;
                }
                
            }
            return $syncable_tags_array;
            
        }
    }
