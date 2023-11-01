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

    public function rateOnce(int $userId, int $value, string $comment = null)
    {
        $rating = ModelRating::query()
            ->where('rateable_type', '=', $this->getMorphClass())
            ->where('rateable_id', '=', $this->id)
            ->where('user_id', '=', $userId)
            ->first();

        if ($rating) {
            $rating->value = $value;
            $rating->comment = $comment;

            $rating = $rating->save();

        } else {
            $rating = $this->rate($value, $comment);
        }

        return $rating;
    }

    /**
     * @param int $userId
     * @param int $value
     * @param string|null $comment
     *
     * @return false|\Illuminate\Database\Eloquent\Model
     */
    public function rate(int $userId, int $value, string $comment = null): \Illuminate\Database\Eloquent\Model|bool
    {
        $rating = new ModelRating();

        $rating->user_id = $userId;
        $rating->value = $value;
        $rating->comment = $comment;

        return $this->ratings()->save($rating);
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
