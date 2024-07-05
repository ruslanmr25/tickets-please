<?php

namespace App\Http\Filters\V1;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{

    protected $sortable = [];

    protected $builder;

    protected $request;


    public function __construct(Request $request)
    {

        $this->request = $request;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;



        foreach ($this->request->all() as $key => $value) {
            if (method_exists($this, $key)) {
                $this->$key($value);
            }
        }





        return $builder;
    }


    public function filter($arr)
    {
        foreach ($arr as $key => $value) {
            if (method_exists($this, $key)) {
                $this->$key($value);
            }
        }
    }
    public function include($value)
    {
        return $this->builder->with($value);
    }

    public function sort($value)
    {
        $direction = "ASC";


        if (strpos($value, '-') === 0) {

            $direction = "DESC";
            $value = substr($value, 1);
        }
        if (!array_key_exists($value, $this->sortable)) {

            return $this->builder;
        }


        return $this->builder->orderBy($value, $direction);
    }
}
