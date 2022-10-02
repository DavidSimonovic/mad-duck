<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 *
 */
class TodoList extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable =
        [
            'title',
            'description',
            'user_id',
        ];


    /**
     * @return HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * @param Builder     $query
     * @param object|null $data
     * @return void
     */
    public function scopeFilter(Builder $query, ?object $data)
    {
        if ($data) {
            switch ($data->type) {
                case 'date':
                    $query->where('created_at', 'like', '%' . $data->value . '%');
                    break;
                case 'title':
                    $query->where('title', 'like', '%' . $data->value . '%');
                    break;
                case 'today':
                    $query->where('created_at', 'like', Carbon::now()->toDateString() . '%');
                    break;
                default:
                    break;

            }
        }
    }
}
