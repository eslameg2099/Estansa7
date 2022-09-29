<?php

namespace App\Models;
use App\Http\Filters\CategoryProviderFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;
use App\Http\Filters\Filterable;


class CategoryProvider extends Model implements HasMedia
{  
    use HasFactory;
    use InteractsWithMedia;
    use Filterable;
    use SoftDeletes;
    use HasUploader;



    protected $filter = CategoryProviderFilter::class;

    protected $fillable = [
        'id',
        'name',
        'description',
        'stauts',
        'deleted_at',
        'slug',
    ];

    public function scopeActive($query)
    {
        return $query->where('stauts','1');
    }
    
}
