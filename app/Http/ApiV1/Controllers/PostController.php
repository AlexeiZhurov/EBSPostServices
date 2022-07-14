<?php

namespace App\Http\ApiV1\Controllers;

use App\Http\ApiV1\Requests\CreatePostsRequest;
use App\Http\ApiV1\Requests\PatchPostRequest;
use App\Http\ApiV1\Requests\SearchPostsRequest;
use App\Http\ApiV1\Resources\PostResource;
use App\Http\ApiV1\Resources\PostAndVoicesResource;
use App\Http\ApiV1\Resources\SearchPagePostResource;
use App\Domain\Posts\Action\CreatedPostAction;
use App\Domain\Posts\Action\DeletedPostAction;
use App\Domain\Posts\Action\PatchPostAction;
use App\Http\ApiV1\Queries\AllPostQuerie;
use App\Http\ApiV1\Queries\GetPostQuerie;
use App\Http\ApiV1\Queries\SearchPostQuerie;
use App\Http\ApiV1\Support\Resources\EmptyResource;
use App\Http\ApiV1\Support\Pagination\PageBuilderFactory;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController
{
    public function index() : AnonymousResourceCollection
    {
        $posts = (new AllPostQuerie())->get();
        $page = (new PageBuilderFactory())->fromQuery($posts)->build();
        $append = ['meta' => ['pagination' => $page->pagination]];
        return PostResource::collection($page->items)->additional($append);
    }

    public function store(CreatePostsRequest $request, CreatedPostAction $action): PostResource
    {
        $post = $action->execute($request->collect());
        return new PostResource($post);
    }

    public function show(SearchPostsRequest $request, int $id) : PostAndVoicesResource
    {
        $post = (new GetPostQuerie())->get($request, $id);
        return new PostAndVoicesResource($post);
    }

    public function destroy(DeletedPostAction $action, int $id): EmptyResource
    {
        $action->execute($id);
        return new EmptyResource();
    }

    public function update(PatchPostRequest $request, int $id): PostResource
    {
        $post = (new PatchPostAction())->execute($id, $request->collect());
        return new PostResource($post);
    }

    public function search(SearchPostsRequest $request, SearchPostQuerie $query) : SearchPagePostResource
    {
        $posts = $query->find($request);
        return new SearchPagePostResource($posts);
    }
}
