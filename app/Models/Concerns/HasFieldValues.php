<?php

namespace App\Models\Concerns;

use App\Models\FieldValue;
use Illuminate\Database\Eloquent\SoftDeletes;

trait HasFieldValues
{
    /**
     * Get all the field values that associated the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function fieldValues(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(FieldValue::class, 'model');
    }

    /**
     * Boot the trait to the model.
     *
     * @return void
     */
    public static function bootHasFieldValues()
    {
        static::deleting(function (self $model) {
            if (in_array(SoftDeletes::class, class_uses_recursive($model))) {
                if (! $model->forceDeleting) {
                    return;
                }
            }

            $model->fieldValues()->cursor()->each(fn (FieldValue $customField) => $customField->delete());
        });
    }
}
