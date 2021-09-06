<?php
    
    namespace App\Http\Controllers;
    
    use App\Http\Requests\NewsRequest;
    use App\Models\News;
    use App\Repository\NewsRepository;
    use Response;
    
    class NewsController extends Controller
    {
        private NewsRepository $repository;
        
        public function __construct ( NewsRepository $repository )
        {
            $this -> repository = $repository;
        }
        
        public function index ()
        {
            $news =News::first()->tags;
            return Response ::json ( $this -> repository -> getFilteredAndPaginate ( 10 ) );
        }
        
        
        public function store ( NewsRequest $request )
        {
            
            return Response ::json ( $this -> repository -> storeNews ( $request -> validated () ) , 201 );
        }
        
        
        public function edit ( News $news )
        {
            return Response ::json ( $news->load('tags') );
        }
        
        public function update ( NewsRequest $request , News $news )
        {
            $this -> repository -> update ( $news , $request -> validated () );
            return Response ::json ( 'news successfully updated' , 204 );
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param $id
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function destroy ( News $news )
        {
            $news -> delete ();
            return Response ::json ( 'news successfully deleted' , 204 );
        }
      
        public function undoDelete ($id)
        {
            News::withTrashed ()->find ( $id) ->restore();
            
            return Response ::json ( 'news successfully updated' , 204 );
        }
    }
