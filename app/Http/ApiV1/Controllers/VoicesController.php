<?php

namespace App\Http\ApiV1\Controllers;

use Illuminate\Http\Request;
use App\Domain\Posts\Action\CreatedPostVoicesAction;
use App\Http\ApiV1\Requests\CreatePostVoiceRequest;
use App\Http\ApiV1\Resources\VoicesResource;
class VoicesController
{
    public function index(int $id) 
    {
        
    }

    public function store(CreatePostVoiceRequest $request , CreatedPostVoicesAction $action, int $id,) 
    {
        $voices = $action->execute($id,$request->collect());

        return New VoicesResource($voices);
    }

    public function destroyAll(int $id, Request $request) 
    {
        //
    }

    public function destroy(int $id, int $voice_id, Request $request) 
    {
        //
    }

    public function update(int $id, int $voice_id, Request $request) 
    {
        //
    }

    public function search(Request $request) 
    {
        //
    }
}
