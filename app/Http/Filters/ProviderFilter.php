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
            return $this->builder->where('category_id', $value);
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
                $from = explode(',', $value)[0];
                $to = explode(',', $value)[1];
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
