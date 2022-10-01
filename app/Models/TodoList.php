<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TodoList extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'title',
            'user_id',
        ];



    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function scopeFilter(Builder $query, ?object $data)
    {
        if ($data)
        {
            switch($data->type)
            {
                case 'date':
                    $query->where('created_at','like', '%' . $data->value . '%');
                    break;
                case 'title':
                    $query->where('title','like', '%' .$data->value. '%');
                    break;
                case 'today':
                    $query->where('created_at','like', Carbon::now()->toDateString() .'%');
                    break;
                default:
                    break;

            }
        }
    }
}
