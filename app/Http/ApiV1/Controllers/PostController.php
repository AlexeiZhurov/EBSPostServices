<?php
namespace App\Http\ApiV1\Controllers;

use Illuminate\Http\Request;
use App\Http\ApiV1\Requests\CreatePostsRequest;
use App\Http\ApiV1\Requests\PatchPostRequest;
use App\Http\ApiV1\Resources\PostResource;
use App\Http\ApiV1\Resources\PostAndVoicesResource;
use App\Domain\Posts\Action\CreatedPostAction;
use App\Domain\Posts\Action\DeletedPostAction;
use App\Domain\Posts\Action\PatchPostAction;
use App\Http\ApiV1\Queries\AllPostQueries;
use App\Http\ApiV1\Queries\GetPostQueries;
use App\Http\ApiV1\Support\Resources\EmptyResource;
use App\Http\ApiV1\Support\Pagination\PageBuilderFactory;

class PostController
{
    public function index(Request $request)
    {
        $posts = (new AllPostQueries())->query();
        $page = (new PageBuilderFactory())->fromQuery($posts)->build();
        return (new PostResource($posts))->collectPage($page);
    }

    public function store(CreatePostsRequest $request, CreatedPostAction $action) : PostResource
    {
        $post = $action->execute($request->collect());
        return new PostResource($post);
    }

    public function show(Request $request,int $id)
    {
        $post = (new GetPostQueries())->query($id);
        return PostAndVoicesResource::collection($post);
        
    }

    public function destroy(int $id,DeletedPostAction $action) : EmptyResource
    {
        $post = $action->execute($id);
        return new EmptyResource($post);
    }

    public function update(int $id, PatchPostRequest $request) : PostResource
    {
        $post = (new PatchPostAction())->execute($id,$request->collect());
        return new PostResource($post);
    }

    public function search(Request $request) 
    {
        //
    }
}
