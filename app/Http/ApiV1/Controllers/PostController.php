<?php
namespace App\Http\ApiV1\Controllers;

use Illuminate\Http\Request;
use App\Http\ApiV1\Requests\CreatePostsRequest;
use App\Http\ApiV1\Resources\PostResource;
use App\Domain\Posts\Action\CreatedPostAction;
use App\Domain\Posts\Action\DeletedPostAction;
use App\Http\ApiV1\Queries\AllPostQueries;
use App\Http\ApiV1\Queries\GetPostQueries;
use App\Http\ApiV1\Support\Pagination\PageBuilderFactory;

class PostController
{
    public function index(Request $request)
    {
        $pagination = $request->all();
        $posts = (new AllPostQueries())->query();
        $posts = (new PageBuilderFactory())->fromQuery($posts);
        return $posts;
    }

    public function store(CreatePostsRequest $request, CreatedPostAction $action) : PostResource
    {
        $validated = $request->validated();
        $post = $action->execute($request->collect());
        return new PostResource($post);
    }

    public function show(int $id) 
    {
        $post = (new GetPostQueries())->query($id);
        return $post;
        
    }

    public function destroy(int $id,DeletedPostAction $action) 
    {
        $post = $action->execute($id);
        return $post;
    }

    public function update(int $id, Request $request) 
    {
        //
    }

    public function search(Request $request) 
    {
        //
    }
}
