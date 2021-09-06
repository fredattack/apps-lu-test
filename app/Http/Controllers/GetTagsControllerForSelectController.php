<?php
    
    namespace App\Http\Controllers;
    
    use App\Models\Tag;
    use App\Repository\TagsRepository;

    class GetTagsControllerForSelectController extends Controller
    {
        public function __invoke (TagsRepository $tags_repository)
        {
            return $tags_repository->all()->map(function(Tag $tag) { return [ 'name' => $tag -> name , 'id' => $tag -> id ];});
        }
    }
