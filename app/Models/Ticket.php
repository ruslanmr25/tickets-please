<?php

namespace App\Models;

use App\Http\Filters\V1\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'status'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function scopeFilter(Builder $builder, QueryFilter $ticketFilter)
    {
        $ticketFilter->apply($builder);
    }
}
