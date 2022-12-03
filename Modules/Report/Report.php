<?php

namespace Modules\Report;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

abstract class Report
{
    protected $filters = ['from', 'to', 'status', 'group'];
    protected $groups = ['years', 'months', 'weeks', 'days'];
    protected $date = 'created_at';

    abstract protected function view();

    abstract protected function query();

    protected function data()
    {
        return [];
    }

    public function render($request)
    {
        $report = $this->report($request)
            ->simplePaginate(20)
            ->appends($request->query());

        return view($this->view())
            ->with(array_merge(compact('report'), $this->data()));
    }

    public function report($request)
    {
        $this->query = $this->query();

        foreach ($this->filters($request) as $name => $value) {
            $this->{$name}($value);
        }

        return $this->query;
    }

    private function filters($request)
    {
        return array_filter($request->query(), function ($value, $name) {
            return ! is_null($value) && in_array($name, $this->filters);
        }, ARRAY_FILTER_USE_BOTH);
    }

    private function from($date)
    {
        $this->query->whereDate($this->date, '>=', Carbon::parse($date));
    }

    private function to($date)
    {
        $this->query->whereDate($this->date, '<=', Carbon::parse($date));
    }

    private function status($status)
    {
        $this->query->where('orders.status', $status);
    }

    private function group($group)
    {
        if (in_array($group, $this->groups)) {
            $this->{"groupBy{$group}"}();
        }
    }

    private function groupByYears()
    {
        $this->groupAndOrderBy('YEAR');
    }

    private function groupByMonths()
    {
        $this->groupAndOrderBy('YEAR')
            ->groupAndOrderBy('MONTH');
    }

    private function groupByWeeks()
    {
        $this->groupAndOrderBy('YEAR')
            ->groupAndOrderBy('MONTH')
            ->groupAndOrderBy('WEEK');
    }

    private function groupByDays()
    {
        $this->groupAndOrderBy('YEAR')
            ->groupAndOrderBy('MONTH')
            ->groupAndOrderBy('WEEK')
            ->groupAndOrderBy('DAY');
    }

    private function groupAndOrderBy($part)
    {
        $this->query->selectRaw("EXTRACT({$part} FROM {$this->date}) as {$part}")
            ->groupBy(DB::raw("EXTRACT({$part} FROM {$this->date})"))
            ->orderbyDesc($part);

        return $this;
    }
}
