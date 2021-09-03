<?php
    
    
    namespace App\Repository;
    
    
    use App\Models\News;

    class NewsRepository
    {
        public function getFilteredAndPaginate (int $count  )
        {
            return News::latest()->paginate($count);
        }
        
        public function storeNews (array $validatedDatas  )
        {
            return News::create($validatedDatas);
        }
    
        public function update (News $news, array $validatedDatas )
        {
            return $news->update($validatedDatas);
        }
    }
