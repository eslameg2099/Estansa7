<?php

namespace App\Models;

use Parental\HasParent;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Http\Resources\providerResource;
use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Concerns\HasMediaTrait;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use ChristianKuri\LaravelFavorite\Models\Favorite;

use App\Http\Filters\Filterable;
use App\Http\Filters\ProviderFilter;

class Provider extends User 
{
    use HasFactory;
    use HasParent;
    use SoftDeletes;
    use HasUploader;
    use InteractsWithMedia;
    use HasMediaTrait;
    use Favoriteable;
    use Filterable;

    protected $filter = ProviderFilter::class;

    /**
     * The model filter name.
     *
     * @var string
     */

    /**
     * Get the class name for polymorphic relations.
     *
     * @return string
     */
    public function getMorphClass()
    {
        return User::class;
    }

    /**
     * Get the default foreign key name for the model.
     *
     * @return string
     */
    public function getForeignKey()
    {
        return 'user_id';
    }


    public function getResource()
    {
        return new providerResource($this);
    }


    public function reviews()
    {
        return $this->hasMany(Review::class,'provider_id');
    }


    public function checkreview()
    {
        if($this->reviews->count() > 0)
        {
          return $this->reviews->sum('rate')  / $this->reviews->count();
        }
        else
        return 0;
    }


    public function experienceyears()
    {
        switch($this->experience) {
            case('0'):
            return "سنة";
                break;
            case('1'):
            return "اكتر من سنتان";
                break;
                case('2'):  
            return "اكتر من 3 سنوات";
                 break;
                 case('3'):   
            return "اكتر من 5 سنوات";
                 break;
        }
    }


    public function checkfavorited($user_id)
    {
       $favorited= Favorite::where('user_id',$user_id)->where('favoriteable_id',$this->id)->first();
       if($favorited != Null) {return true;} else return false;
    }

 
}
