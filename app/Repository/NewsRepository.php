<?php
    
    
    namespace App\Repository;
    
    
    use App\Models\News;

    class NewsRepository
    {
        public function getFilteredNewsPaginate ( $count  )
        {
            return News::paginate($count);
        }
    }
