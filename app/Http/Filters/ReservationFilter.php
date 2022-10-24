<?php

namespace App\Http\Filters;

class ReservationFilter extends BaseFilters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [
        'stauts',
        'provider',
        'customer',
        'id',
    ];

    /**
     * Filter the query by a given name.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function stauts($value)
    {
        if ($value) {
            return $this->builder->where('stauts', $value);
        }

        return $this->builder;
    }

    protected function id($value)
    {
        if ($value) {
            return $this->builder->where('id', $value);
        }

        return $this->builder;
    }

    protected function provider($value)
    {
        if ($value) {
            return $this->builder->whereHas('provider', function ($builder) use ($value) {
                $builder->where('name', 'like', "%$value%");
            });
        }

        return $this->builder;
    }


    protected function customer($value)
    {
        if ($value) {
            return $this->builder->whereHas('customer', function ($builder) use ($value) {
                $builder->where('name', 'like', "%$value%");
            });
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
