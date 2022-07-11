<?php

namespace App\Domain\Posts\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title','preview','text','tags','user_id'];
    //Получение отрицательных оценок
    public function voices_dis()
    {
        return $this->hasMany(Voice::class)->selectRaw('count(*) as count')->where('voices','-1')->groupBy('post_id');
    }
    //Получение количества положительных оценок 
    public function voices_pos(){
        return $this->hasMany(Voice::class)->selectRaw('count(*) as count')->where('voices','1')->groupBy('post_id');
    }
}
