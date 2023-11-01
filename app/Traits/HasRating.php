<?php

namespace App\Traits;

use App\Models\ModelRating;
use App\Observers\ModelVisitObserver;

trait HasRating
{
    public function ratings()
    {
        return $this->morphMany(ModelRating::class, 'rateable');
    }

    public function ratingsAvg()
    {
        return $this->ratings()->avg('value');
    }

    public function ratingsCount()
    {
        return $this->ratings()->count();
    }
}
