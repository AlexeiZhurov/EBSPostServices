<?php
namespace App\Http\ApiV1\Controllers;

use Illuminate\Http\Request;
use App\Http\ApiV1\Requests\CreatePostsRequest;
use App\Http\ApiV1\Resources\PostResource;
use App\Http\ApiV1\Resources\ErrorResource;
use App\Http\ApiV1\Support\Resources\EmptyResource;
use App\Domain\Posts\Action\CreatedPostAction;
use App\Domain\Posts\Action\DeletedPostAction;
use App\Http\ApiV1\Queries\allPostQueries;
use App\Http\ApiV1\Queries\getPostQueries;

class PostController
{
    public function index(Request $request)
    {
        $page = $request->get('page');
        $posts = (new allPostQueries())->query($page);
        return PostResource::collectPage($posts);
    }

    public function store(CreatePostsRequest $request, CreatedPostAction $action) : PostResource
    {
        $validated = $request->validated();
        $post = $action->execute($request->collect());
        return new PostResource($post);
    }

    public function show(int $id) 
    {
        $post = (new getPostQueries())->query($id);
        if($post == null) {
            return (new ErrorResource)->toResponse(['code' => 404, 'message'=>'Запись не найдена']);
        }
            return new PostResource($post);
        
    }

    public function destroy(int $id,DeletedPostAction $action) 
    {
        $post = $action->execute($id);
        if($post == null) {
            return (new ErrorResource)->toResponse(['code' => 404, 'message'=>'Запись не найдена']);
        }
        return new EmptyResource();
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
