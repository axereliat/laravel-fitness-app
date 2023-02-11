<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List Activities') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <ul class="p-2 py-4">
                        @foreach($activities as $activity)
                            <li>{{ $activity->name }}</li>

                            <x-secondary-button>
                                <a href="{{ route('daily-activity.edit', $activity->id) }}">
                                    Edit
                                </a>
                            </x-secondary-button>
                            <form method="post" onsubmit="confirm('Are you sure?')"
                                  action="{{ route('daily-activity.destroy', $activity->id) }}">
                                @csrf
                                @method('DELETE')
                                <x-secondary-button type="submit">Delete</x-secondary-button>
                            </form>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
