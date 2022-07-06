<?php

namespace App\Http\ApiV1\Controllers;

use Illuminate\Http\Request;

use App\Http\ApiV1\Requests\CreatePostsRequest;
use App\Http\ApiV1\Resources\PostsResource;
use App\Http\ApiV1\Action\CreatePostsAction;
use App\Http\ApiV1\Queries\allPostQueries;
use App\Http\ApiV1\Resources\allPostResource;

class PostController
{
    public function index(Request $request) 
    {
        $page = $request->get('page');
        $posts = (new allPostQueries())->query($page);
        return PostsResource::collectPage($posts);
    }

    public function store(CreatePostsRequest $request, CreatePostsAction $action) : PostsResource
    {
        $validated = $request->validated();
        $create = $action->execute($request->collect());
        return new PostsResource($create);
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
