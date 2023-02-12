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
                        <x-primary-button type="submit">Filter</x-primary-button>
                    </form>
                    <br/>
                    @foreach($records as $record)
                        <div>
                            <h3>{{ $record->daily_activity_name }}</h3>
                            <p>SETS: {{ $record->sets }}</p>
                            <p>REPS: {{ $record->reps }}</p>
                            <x-secondary-button>
                                <a href="{{ route('records.edit', $record->id) }}">
                                    Edit
                                </a>
                            </x-secondary-button>
                            <form method="post" onsubmit="confirm('Are you sure?')"
                                  action="{{ route('records.destroy', $record->id) }}">
                                @csrf
                                @method('DELETE')
                                <x-secondary-button type="submit">Delete</x-secondary-button>
                            </form>
                        </div>
                        <br/>
                        <hr/>
                        <br/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
