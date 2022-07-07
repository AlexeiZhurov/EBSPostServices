<?php
namespace App\Http\ApiV1\Controllers;

use Illuminate\Http\Request;
use App\Http\ApiV1\Requests\CreatePostsRequest;
use App\Http\ApiV1\Resources\PostResource;
use App\Domain\Posts\Action\CreatedPostsAction;
use App\Http\ApiV1\Queries\allPostQueries;

class PostController
{
    public function index(Request $request)
    {
        $page = $request->get('page');
        $posts = (new allPostQueries())->query($page);
        return PostResource::collectPage($posts);
    }

    public function store(CreatePostsRequest $request, CreatedPostsAction $action) : PostResource
    {
        $validated = $request->validated();
        $post = $action->execute($request->collect());
        return new PostResource($post);
    }

    public function show(int $id) 
    {
        //
    }

    public function destroy(int $id, Request $request) 
    {
        //
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
