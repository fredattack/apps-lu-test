<?php
    namespace App\Repository;
    
    
    use App\Models\Tag;

    class TagsRepository
    {
        public function all (  )
        {
            return Tag::all(  );
        }
        
    }
