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
use App\Domain\Posts\Action\UpdateTotalRatingAction;

class VoicesController
{
    public function index(GetPostVoicesQuerie $query, int $id)
    {
        $voices = $query->get($id);
        return VoicesResource::collection($voices);
    }

    public function store(CreatePostVoiceRequest $request, CreatedPostVoicesAction $action, int $id): VoicesResource
    {
        $voices = $action->execute($id, $request->all());
        return new VoicesResource($voices);
    }

    public function destroyAll(DeletedAllVoicesPostAction $action, int $id): EmptyResource
    {
        $action->execute($id);
        return new EmptyResource();
    }

    public function destroy(DeletedVoicePostAction $action, int $id, int $voiceId): EmptyResource
    {
        $action->execute($id, $voiceId);
        return new EmptyResource();
    }

    public function update(PatchVoicePostAction $action, PatchPostVoicesRequest $request, int $id, int $voiceId): VoicesResource
    {
        $voice = $action->execute($id, $voiceId, $request->all());
        return new VoicesResource($voice);
    }

    public function search(SearchPostVoicesRequest $request, SearchVoiceQuerie $query): AnonymousResourceCollection
    {
        $page = $query->get($request);
        return VoicesResource::collectPage($page);
    }
}
