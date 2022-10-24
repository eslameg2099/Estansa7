<?php

namespace App\Http\Filters;

class PostFilter extends BaseFilters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [
        'name',
        'category_id',
        'user_id',
        'slug',
        'id',
        'sort',
    ];

    /**
     * Filter the query by a given name.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function name($value)
    {
        if ($value) {
            return $this->builder->where('name', 'like', "%$value%");
        }
        return $this->builder;
    }

    protected function slug($value)
    {
        if ($value) {
            return $this->builder->where('slug', 'like', "%$value%");
        }
        return $this->builder;
    }

    protected function categoryId($value)
    {
        if ($value) {
            return $this->builder->where('category_id',$value);
        }
        return $this->builder;
    }


    protected function userId($value)
    {
        if ($value) {
            return $this->builder->where('user_id',$value);
        }
        return $this->builder;
    }


    protected function sort($value)
    {
        switch ($value) {
            case 'old':
                $this->builder->oldest('created_at');
                break;
          
            case 'new':
                $this->builder->latest('created_at');
                break;
          
        }

        return $this->builder;
    }

    /**
     * Filter the query to include users by type.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
   
    /**
     * Sorting results by the given id.
     *
     * @param $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function selectedId($value)
    {
        if ($value) {
            $this->builder->sortingByIds($value);
        }

        return $this->builder;
    }
}