<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait Lockable
{
    /**
     * Determine if the model instance has been locked.
     *
     * @return bool
     */
    public function locked()
    {
        return ! ! $this->getAttribute($this->getLockedAtColumn());
    }

    /**
     * Determine if the model instance has been unlocked.
     *
     * @return bool
     */
    public function unlocked()
    {
        return ! $this->locked();
    }

    /**
     * Mark the model instance as locked.
     *
     * @return $this
     */
    public function markAsLocked()
    {
        $this->forceFill([$this->getLockedAtColumn() => now()])->save();

        return $this;
    }

    /**
     * Mark the model instance as unlocked.
     *
     * @return $this
     */
    public function markAsUnLocked()
    {
        $this->forceFill([$this->getLockedAtColumn() => null])->save();

        return $this;
    }

    /**
     * Scope the query to include only locked entities.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLocked(Builder $builder)
    {
        return $builder->whereNotNull($this->getLockedAtColumn());
    }

    /**
     * Scope the query to include only unlocked entities.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnlocked(Builder $builder)
    {
        return $builder->whereNull($this->getLockedAtColumn());
    }

    /**
     * Get the name of the "locked at" column.
     *
     * @return string
     */
    public function getLockedAtColumn()
    {
        return defined('static::LOCKED_AT') ? static::LOCKED_AT : 'locked_at';
    }

    /**
     * Get the fully qualified "locked at" column.
     *
     * @return string
     */
    public function getQualifiedLockedAtColumn()
    {
        return $this->qualifyColumn($this->getLockedAtColumn());
    }

    /**
     * Initialize the lockable trait for an instance.
     *
     * @return void
     */
    public function initializeLockable()
    {
        if (! isset($this->casts[$this->getLockedAtColumn()])) {
            $this->casts[$this->getLockedAtColumn()] = 'datetime';
        }
    }
}
