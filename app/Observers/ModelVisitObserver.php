<?php

namespace App\Observers;

use App\Models\ModelVisit;
use Illuminate\Database\Eloquent\Model;

class ModelVisitObserver
{
    /**
     * Handle the Article "created" event.
     */
    public function created(Model $model): void
    {
        ModelVisit::incrementVisit($model, $model->user_id);
    }

    /**
     * Handle the Article "deleted" event.
     */
    public function deleted(Model $model): void
    {
        ModelVisit::decrementVisit($model, $model->user_id);
    }

    /**
     * Handle the Article "restored" event.
     */
    public function restored(Model $model): void
    {
        ModelVisit::incrementVisit($model, $model->user_id);
    }

    /**
     * Handle the Article "force deleted" event.
     */
    public function forceDeleted(Model $model): void
    {
        ModelVisit::decrementVisit($model, $model->user_id);
    }

}
