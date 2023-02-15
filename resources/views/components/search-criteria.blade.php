@if ($showSearchCriteria)
    <div class="flex mt-2 space-x-3">
        @if (!empty($activityName)) <div>Activity: {{ $activityName }}</div> @endif
            @if (!empty(request()->query->get('startDate'))) <div>Start date: {{ request()->query->get('startDate') }}</div> @endif
            @if (!empty(request()->query->get('endDate'))) <div>End date: {{ request()->query->get('endDate') }}</div> @endif
    </div>
@endif
