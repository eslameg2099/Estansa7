<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;
use Spatie\MediaLibrary\MediaCollections\File;
use App\Traits\HasMediaTrait;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use ChristianKuri\LaravelFavorite\Models\Favorite;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;
    use HasUploader;
    use HasMediaTrait;
    use Favoriteable;

    protected $fillable = [
        'id',
        'titele',
        'description',
        'stauts',
        'deleted_at',
        'user_id',
        'category_id',
        'view',
        'slug',
       
    ];

    public function scopeActive($query)
    {
        return $query->where('stauts','1');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(CategoryPost::class, 'category_id');
    }


    public function incrementReadCount() {
        $this->view++;
        return $this->save();
    }


    public function checkfavorited($user_id)
    {
       $favorited= Favorite::where('user_id',$user_id)->where('favoriteable_id',$this->id)->first();
       if($favorited != Null) {return true;} else return false;
    }
    
}

