<?php

namespace App\Http\ApiV1\Controllers;

use Illuminate\Http\Request;
use App\Domain\Posts\Action\CreatedPostVoicesAction;
use App\Domain\Posts\Action\DeletedAllVoicesPostAction;
use App\Domain\Posts\Action\DeletedVoicePostAction;
use App\Domain\Posts\Action\PatchVoicePostAction;
use App\Http\ApiV1\Requests\CreatePostVoiceRequest;
use App\Http\ApiV1\Requests\PatchPostVoicesRequest;
use App\Http\ApiV1\Requests\SearchPostVoicesRequest;
use App\Http\ApiV1\Resources\VoicesResource;
use App\Http\ApiV1\Support\Resources\EmptyResource;
use App\Http\ApiV1\Queries\GetPostVoicesQuerie;
use App\Http\ApiV1\Queries\SearchVoiceQuerie;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VoicesController
{
    public function index(int $id): AnonymousResourceCollection
    {
        $voices = (new GetPostVoicesQuerie())->get($id);
        return VoicesResource::collection($voices);
    }

    public function store(CreatePostVoiceRequest $request, CreatedPostVoicesAction $action, int $id,): VoicesResource
    {
        $voices = $action->execute($id, $request->all());
        return new VoicesResource($voices);
    }

    public function destroyAll(DeletedAllVoicesPostAction $action, int $id): EmptyResource
    {
        $action->execute($id);
        return new EmptyResource();
    }

    public function destroy(DeletedVoicePostAction $action, int $id, int $voice_id): EmptyResource
    {
        $action->execute($id, $voice_id);
        return new EmptyResource();
    }

    public function update(PatchPostVoicesRequest $request, int $id, int $voice_id): VoicesResource
    {
        $voice = (new PatchVoicePostAction())->execute($id, $voice_id, $request->all());
        return new VoicesResource($voice);
    }

    public function search(SearchPostVoicesRequest $request, SearchVoiceQuerie $query): AnonymousResourceCollection
    {
        $page = $query->get($request);
        return VoicesResource::collectPage($page);
    }
}
