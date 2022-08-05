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


class Provider extends User 
{
    use HasFactory;
    use HasParent;
    use SoftDeletes;
    use HasUploader;
    use InteractsWithMedia;
    use HasMediaTrait;

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

 
}
