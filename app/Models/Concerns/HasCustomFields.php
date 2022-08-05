<?php

namespace App\Models\Concerns;

use App\Models\CustomField;
use Illuminate\Database\Eloquent\SoftDeletes;

trait HasCustomFields
{
    /**
     * Get all the custom fields that associated the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function customFields(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(CustomField::class, 'model');
    }

    /**
     * Boot the trait to the model.
     *
     * @return void
     */
    public static function bootHasCustomFields()
    {
        static::deleting(function (self $model) {
            if (in_array(SoftDeletes::class, class_uses_recursive($model))) {
                if (! $model->forceDeleting) {
                    return;
                }
            }

            $model->customFields()->cursor()->each(fn (CustomField $customField) => $customField->delete());
        });
    }
}
