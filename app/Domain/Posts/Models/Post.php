<?php

namespace App\Domain\Posts\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/*Table posts
    id
    title
    preview
    tags
    text
    user_id
    rating
    created_at
    updated_at
    deleted_at
*/
class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'preview', 'text', 'tags', 'user_id'];


    public function voices()
    {
        return $this->hasMany(Voice::class);
    }
}
