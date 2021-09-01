<?php
    
    namespace App\Http\Controllers;
    
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
           return Response::json($this->repository->getFilteredNewsPaginate ( 10));
        }
        
       
        
        /**
         * Store a newly created resource in storage.
         *
         * @param Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store ( Request $request )
        {
            //
        }
        
      
        /**
         * Show the form for editing the specified resource.
         *
         * @param $id
         *
         * @return \Illuminate\Http\Response
         */
        public function edit ( $id )
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
        public function update ( Request $request , $id )
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
