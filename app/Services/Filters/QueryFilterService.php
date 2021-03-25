<?php


namespace App\Services\Filters;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Carbon\Carbon;

abstract class QueryFilterService
{
    protected $builder;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;
        foreach ($this->filters() as $filter => $value)
        {
            if(method_exists($this, $filter))
            {
                $this->$filter($value);
            }
        }
        return $this->builder;
    }

    public function date($value)
    {
        if($value == '') $value = 'today';
        if($value == 'today')
        {
            $today = Carbon::now()->format('Y-m-d');
            return $this->builder->where('created_at', 'LIKE', '%'.$today.'%');
        }
        if($value == 'week')
        {
            $dayStart = Carbon::now()->startOfWeek()->format('Y-m-d 00:00:00');
            $dayEnd = Carbon::now()->endOfWeek()->format('Y-m-d 00:00:00');
            return $this->builder->where('created_at', '>=', $dayStart)->where('created_at', '<=', $dayEnd);
        }
        if($value == 'month')
        {
            $dayStart = Carbon::now()->startOfMonth()->format('Y-m-d 00:00:00');
            $dayEnd = Carbon::now()->endOfMonth()->format('Y-m-d 00:00:00');
            return $this->builder->where('created_at', '>=', $dayStart)->where('created_at', '<=', $dayEnd);
        }
        $dates = explode(',', $value);
        if(count($dates) == 2)
        {
            $rules = [
                0 => 'date|required',
                1 => 'date|required'
            ];
            $validator = Validator::make($dates, $rules);
            if (!$validator->fails())
            {
                $dayStart = Carbon::parse($dates[0])->format('Y-m-d 00:00:00');
                $dayEnd = Carbon::parse($dates[1])->format('Y-m-d 00:00:00');
                return $this->builder->where('created_at', '>=', $dayStart)->where('created_at', '<=', $dayEnd);
            }
        }
        $today = Carbon::now()->format('Y-m-d');
        return $this->builder->where('created_at', 'LIKE', '%'.$today.'%');
    }

    public function filters()
    {
        return $this->request->all();
    }
}
