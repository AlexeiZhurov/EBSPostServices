<?php

namespace App\Http\ApiV1\Action;
use App\Model\Posts;
class CreatePostsAction{

    public function execute($request) : void
    {
        $table = New Posts;
        $table->title = $request->title;
        $table->preview = $request->preview;
        $table->text = $request->text;
        $table->tags = $request->tags;
        $table->user_id = $request->user_id;
        $table->save();
    }

} 