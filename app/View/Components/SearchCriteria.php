<?php

namespace App\View\Components;

use App\Models\DailyActivity;
use Illuminate\View\Component;

class SearchCriteria extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $showSearchCriteria = true;

        if (request()->query->count() === 0 || (request()->query->count() === 1 && request()->query('page'))) {
            $showSearchCriteria = false;
        }

        $activityName = DailyActivity::where('id', request()->query('activity'))->value('name');

        return view('components.search-criteria', [
            'showSearchCriteria' => $showSearchCriteria,
            'activityName' => $activityName
        ]);
    }
}
