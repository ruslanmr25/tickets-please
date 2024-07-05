<?php

namespace App\Http\Filters\V1;


class TicketFilter extends QueryFilter
{

    protected $sortable = [
        'id' => 'id',
        'title' => 'title',
        'createdAt' => 'created_at'
    ];

    public function status($value)
    {
        $value = explode(',', $value);

        return $this->builder->whereIn('status', $value);
    }


    public function title($value)
    {

        $value = str_replace('*', '%', $value);
        return $this->builder->where('title', 'like', $value);
    }


    public function createdAt($value)
    {
        $value = explode(',', $value);

        if (count($value) > 1) {
            return $this->builder->whereBetween('created_at', $value);
        }

        return $this->builder->whereDate('created_at', $value);
    }
}
