<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait Soldable
{
    /**
     * Determine if the model instance has been sold.
     *
     * @return bool
     */
    public function sold()
    {
        return ! ! $this->getAttribute($this->getSoldAtColumn());
    }

    /**
     * Determine if the model instance has been not sold.
     *
     * @return bool
     */
    public function notSold()
    {
        return ! $this->sold();
    }

    /**
     * Mark the model instance as sold.
     *
     * @return $this
     */
    public function markAsSold()
    {
        $this->forceFill([$this->getSoldAtColumn() => now()])->save();

        return $this;
    }

    /**
     * Mark the model instance as not sold.
     *
     * @return $this
     */
    public function markAsNotSold()
    {
        $this->forceFill([$this->getSoldAtColumn() => null])->save();

        return $this;
    }

    /**
     * Scope the query to include only sold entities.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSold(Builder $builder)
    {
        return $builder->whereNotNull($this->getSoldAtColumn());
    }

    /**
     * Scope the query to include only not sold entities.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotSold(Builder $builder)
    {
        return $builder->whereNull($this->getSoldAtColumn());
    }

    /**
     * Get the name of the "sold at" column.
     *
     * @return string
     */
    public function getSoldAtColumn()
    {
        return defined('static::SOLD_AT') ? static::SOLD_AT : 'sold_at';
    }

    /**
     * Get the fully qualified "sold at" column.
     *
     * @return string
     */
    public function getQualifiedSoldAtColumn()
    {
        return $this->qualifyColumn($this->getSoldAtColumn());
    }

    /**
     * Initialize the lockable trait for an instance.
     *
     * @return void
     */
    public function initializeSoldable()
    {
        if (! isset($this->casts[$this->getSoldAtColumn()])) {
            $this->casts[$this->getSoldAtColumn()] = 'datetime';
        }
    }
}
