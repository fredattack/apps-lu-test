<?php
    
    
    namespace App\Repository;
    
    
    use App\Models\News;

    class NewsRepository
    {
        public function getFilteredAndPaginate (int $count  )
        {
            return News::paginate($count);
        }
        
        public function storeNews (array $validatedDatas  )
        {
            return News::create($validatedDatas);
        }
    }
