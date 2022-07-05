<?php

namespace App\Http\ApiV1\Controllers;

use Illuminate\Http\Request;//нужно будет стереть

use App\Http\ApiV1\Requests\CreatePostsRequest;
use App\Http\ApiV1\Resources\CreatePostsResource;
use App\Http\ApiV1\Action\CreatePostsAction;
class PostController
{
    public function index() 
    {
        //
    }

    public function store(CreatePostsRequest $request) : CreatePostsResource
    {
        $validated = $request->validated();
        $create = New CreatePostsAction();
        $create->execute($request);
        return new CreatePostsResource($validated);
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
