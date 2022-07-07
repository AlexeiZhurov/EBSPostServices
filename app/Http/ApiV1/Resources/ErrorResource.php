<?php
namespace App\Http\ApiV1\Resources;
 
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

class ErrorResource implements Responsable
{
    public function toResponse($error): Response
    {
        return response()->json(['errors' => [['code' =>$error['code'],'message' => $error['message']]]]);
    }
   
}