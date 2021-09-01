<?php
    
    namespace App\Http\Controllers;
    
    use App\Http\Requests\NewsRequest;
    use App\Models\News;
    use App\Repository\NewsRepository;
    use Illuminate\Http\Request;
    use Response;

    class NewsController extends Controller
    {
        private NewsRepository $repository;
    
        public function __construct ( NewsRepository $repository) {
            $this -> repository = $repository;
        }
    
        public function index ()
        {
           return Response::json($this->repository->getFilteredAndPaginate ( 10));
        }
        
        
        public function store ( NewsRequest $request )
        {
            return Response::json($this->repository->storeNews ( $request->validated ()),201);
        }
        
      
        /**
         * Show the form for editing the specified resource.
         *
         * @param $id
         *
         * @return \Illuminate\Http\Response
         */
        public function edit ( News $news )
        {
            //
        }
        
        /**
         * Update the specified resource in storage.
         *
         * @param Request $request
         * @param         $id
         *
         * @return \Illuminate\Http\Response
         */
        public function update ( NewsRequest $request , News $news )
        {
            //
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param $id
         *
         * @return \Illuminate\Http\Response
         */
        public function destroy ( $id )
        {
            //
        }
    }
