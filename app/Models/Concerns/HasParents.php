<?php

namespace App\Models\Concerns;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

trait HasParents
{
    /**
     * The parent of the entity.
     *
     * @var
     */
    protected static $parent;

    /**
     * The old parent of the entity.
     *
     * @var
     */
    protected static $oldParent;

    /**
     * The parents of the deleted entity.
     *
     * @var []
     */
    protected static $deleteParents;

    /**
     * Get the parents categories.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getModelWithParents()
    {
        $parents = $this->newQuery()
            ->with('translations')
            ->whereIn('id', $this->parents)
            ->get();

        $collection = Collection::make();

        foreach ($this->parents as $parent) {
            $collection->push(
                $parents->where('id', $parent)->first()
            );
        }

        return $collection;
    }

    /**
     * Get all children of the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childrenRelation()
    {
        return $this->hasMany(static::class, 'parent_id');
    }

    /**
     * Get the parents categories.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->getModelWithParents()->implode('name', ' - ');
    }

    public static function bootHasParents()
    {
        static::created(function (self $model) {
            $model->touchParents();
        });

        static::saving(function (self $model) {
            if ($oldParent = self::find($model->getOriginal('parent_id'))) {
                static::$oldParent = $oldParent;
            }
            if ($parent = self::find($model->getAttribute('parent_id'))) {
                static::$parent = $parent;
            }
        });

        static::saved(function (self $model) {
            if ($parent = static::$parent) {
                $parent->touchParents();
            }
            if ($oldParent = static::$oldParent) {
                $oldParent->touchParents();
            }
            $model->touchParents();
        });

        static::deleting(function (self $model) {
            $parents = collect($model->parents);

            $parents->pull(0);

            static::$deleteParents = self::whereIn('id', $parents->toArray())->get();

            $model->childrenRelation()->delete();
        });

        static::deleted(function () {
            if (static::$deleteParents instanceof Collection) {
                static::$deleteParents->each(function ($parent) {
                    $parent->touchParents();
                });
            }
        });
    }

    /**
     * Denormalization entity parents.
     *
     * @return void
     */
    public function touchParents()
    {
        static::withoutEvents(function () {
            $parents = Collection::make([]);

            $parent = $this;

            do {
                $parents->add($parent->id);

                $parent = $parent->parent;
            } while ($parent);

            $this->forceFill([
                'parents' => $parents->reverse()->values()->toArray(),
            ])->save();
        });
    }

    /**
     * The root of the model.
     *
     * @return $this
     */
    public function root()
    {
        if ($this->id == Arr::first($this->parents)) {
            return $this;
        }

        return $this->newQuery()->whereId(Arr::first($this->parents))->first();
    }

    /**
     * Get The parent of the category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id')->withTrashed();
    }

    /**
     * Get all children.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * Scope the query to include only parents categories.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeParentsOnly(Builder $builder)
    {
        return $builder->doesntHave('parent');
    }

    /**
     * Scope the query to include only parents categories.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLeafsOnly(Builder $builder)
    {
        return $builder->doesntHave('children');
    }
}
