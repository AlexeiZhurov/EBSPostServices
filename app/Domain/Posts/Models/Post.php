<?php

namespace App\Domain\Posts\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;


class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title','preview','text','tags','user_id'];

}