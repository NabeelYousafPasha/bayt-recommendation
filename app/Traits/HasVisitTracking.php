<?php

namespace App\Traits;


use App\Models\ModelVisit;
use App\Observers\ModelVisitObserver;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasVisitTracking
{

    /**
     * |--------------------------------------------------------------------------
     * | OBSERVERS
     * |--------------------------------------------------------------------------
     */

    /**
     * Register any events for your application.
     */
    public static function boot(): void
    {
        parent::boot();
        self::observe([
            ModelVisitObserver::class,
        ]);
    }

    /**
     * |--------------------------------------------------------------------------
     * | RELATIONSHIPS
     * |--------------------------------------------------------------------------
     */

    /**
     * @return MorphMany
     */
    public function visits(): MorphMany
    {
        return $this->morphMany(ModelVisit::class, 'visitable');
    }

    /**
     * @return int
     */
    public function visitsCount(): int
    {
        return $this->visits()->count();
    }

    public function visitsAvg()
    {
        return $this->visits()->avg('value');
    }
}
