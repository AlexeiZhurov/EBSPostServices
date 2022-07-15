<?php
namespace App\Http\ApiV1\Queries;
use App\Domain\Posts\Models\Voice;
class SearchVoiceQuerie{
        
    public function get() : void
    {
        $query = Voice::query();
    }    
        
}