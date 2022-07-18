<?php
namespace App\Domain\Posts\Action;
use App\Domain\Posts\Models\Post;
class UpdateTotalRatingAction{
        
    public function execute($post_id) : int
    {
        $post = Post::findOrFail($post_id);
        $dis_voices = $post->voice()->where('voices','-1')->count();
        $pos_voices = $post->voice()->where('voices','1')->count();;
        $total_rating = $pos_voices - $dis_voices;
        $post->rating = $total_rating;

        $post->save();
        return $total_rating;
    }    
        
}