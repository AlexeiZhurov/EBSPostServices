<?php

namespace App\Domain\Posts\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voice extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['voices', 'user_id', 'post_id'];
}
