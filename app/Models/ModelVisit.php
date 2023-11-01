<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelVisit extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'visitable_type',
        'visitable_id',
        'user_id',
        'value',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    /**
     * @param $model
     *
     * @return void
     */
    protected function incrementVisit($model, int $userId): void
    {
        $this->logVisit($model, $userId, 'increment');
    }

    /**
     * @param $model
     *
     * @return void
     */
    protected function decrementVisit($model, int $userId): void
    {
        $this->logVisit($model, $userId, 'decrement');
    }

    /**
     * @param $model
     * @param int $userId
     * @param string $type
     *
     * @return void
     */
    protected function logVisit($model, int $userId, string $type): void
    {
        $modelVisit = ModelVisit::where([
            'user_id' => $userId,
            'visitable_type' => get_class($model),
            'visitable_id' => $model->getKey()
        ])
            ->first();

        if (is_null($modelVisit)) {

            $modelVisit = ModelVisit::create([
                'user_id' => $userId,
                'visitable_type' => get_class($model),
                'visitable_id' => $model->getKey(),

                'value' => 0,
            ]);
        }

        if ($type === 'increment') {
            $modelVisit->increment('value');
        }

        if ($type === 'decrement') {
            $modelVisit->decrement('value');
        }
    }
}
