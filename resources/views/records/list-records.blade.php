<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Records List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <x-success-message/>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form>
                        <label for="activity">Choose activity</label>
                        <select name="activity" id="activity">
                            <option value="0">
                                All
                            </option>
                            @foreach($activities as $activity)
                                <option value="{{ $activity->id }}"
                                    {{ +request()->query->get('activity') === +$activity->id ? 'selected' : '' }}>
                                    {{ $activity->name }}
                                </option>
                            @endforeach
                        </select>
                        <input type="text" name="startDate" class="flatpicker"
                               value="{{ request()->query->get('startDate') }}" placeholder="start date"/>
                        <input type="text" name="endDate" class="flatpicker"
                               value="{{ request()->query->get('endDate') }}" placeholder="end date"/>

                        <x-primary-button type="submit">Filter</x-primary-button>
                    </form>
                    <br/>
                    @foreach($records as $record)
                        <div class="flex justify-between mb-4 border-b-2">
                            <div>
                                <h3>{{ $record->daily_activity_name }}</h3>
                                <p>SETS: {{ $record->sets }}</p>
                                <p>REPS: {{ $record->reps }}</p>
                                <small>{{ $record->created_at }}</small>
                            </div>
                            <div class="flex items-center space-x-3">
                                <x-secondary-button class="bg-blue-500 text-white">
                                    <a href="{{ route('records.edit', $record->id) }}">
                                        Edit
                                    </a>
                                </x-secondary-button>
                                <form method="post" onsubmit="confirm('Are you sure?')"
                                      action="{{ route('records.destroy', $record->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <x-secondary-button type="submit" class="bg-red-500 text-white">Delete</x-secondary-button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                    @if($records->count() > 0)
                        {{ $records->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $(function() {
        $(".flatpicker").flatpickr();
    })
</script>
