<?php
namespace App\Http\ApiV1\Controllers;

use Illuminate\Http\Request;
use App\Http\ApiV1\Requests\CreatePostsRequest;
use App\Http\ApiV1\Requests\PatchPostRequest;
use App\Http\ApiV1\Requests\SearchPostsRequest;
use App\Http\ApiV1\Resources\PostResource;
use App\Http\ApiV1\Resources\PostAndVoicesResource;
use App\Http\ApiV1\Resources\SearchPagePostResource;
use App\Domain\Posts\Action\CreatedPostAction;
use App\Domain\Posts\Action\DeletedPostAction;
use App\Domain\Posts\Action\PatchPostAction;
use App\Http\ApiV1\Queries\AllPostQueries;
use App\Http\ApiV1\Queries\GetPostQueries;
use App\Http\ApiV1\Queries\SearchPostQueries;
use App\Http\ApiV1\Support\Resources\EmptyResource;
use App\Http\ApiV1\Support\Pagination\PageBuilderFactory;

class PostController
{
    public function index(Request $request)
    {
        $posts = (new AllPostQueries())->query();
        $page = (new PageBuilderFactory())->fromQuery($posts)->build();
        $append = ['meta' => ['pagination' => $page->pagination]];
        return PostResource::collection($page->items)->additional($append);
    }

    public function store(CreatePostsRequest $request, CreatedPostAction $action) : PostResource
    {
        $post = $action->execute($request->collect());
        return new PostResource($post);
    }

    public function show(int $id) 
    {
        $post = (new GetPostQueries())->query($id);
        return new PostResource($post);
        
    }

    public function destroy(int $id,DeletedPostAction $action) : EmptyResource
    {
        $action->execute($id);
        return new EmptyResource();
    }

    public function update(int $id, PatchPostRequest $request) : PostResource
    {
        $post = (new PatchPostAction())->execute($id,$request->collect());
        return new PostResource($post);
    }

    public function search(SearchPostsRequest $request,SearchPostQueries $query) 
    {
        $posts = $query->query($request);
        return new SearchPagePostResource($posts);
    }
}
