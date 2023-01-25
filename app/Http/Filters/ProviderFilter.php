<?php

namespace App\Http\Filters;
use Illuminate\Support\Str;

class ProviderFilter extends BaseFilters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [
        'category_id',
        'unit_price',
        'experience',
        'rate',
        'name',
    ];

    /**
     * Filter the query by a given name.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function categoryId($value)
    {
     
        if ($value) {
            return $this->builder->whereHas('categories', function ($builder) use ($value) {
                $builder->where('category_provider_id', $value);
            });
        }

        return $this->builder;
    }

    


    protected function experience($value)
    {
        if ($value) {
            return $this->builder->where('experience', $value);
        }

        return $this->builder;
    }

    protected function name($value)
    {
        if ($value) {
            return $this->builder->where('name', 'like', "%$value%");
        }

        return $this->builder;
    }

    protected function rate($value)
    {
        if ($value) {
            return $this->builder->where('rate', $value);
        }

        return $this->builder;
    }


    protected function unitPrice($value)
    {
        if ($value) {
            if (Str::contains($value, ',')) {
                $from = (int) explode(',', $value)[0];
                $to = (int) explode(',', $value)[1];
                
                $this->builder->whereBetween('unit_price', [$from, $to]);
            } else {
                $this->builder->where('unit_price', $value);
            }
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
