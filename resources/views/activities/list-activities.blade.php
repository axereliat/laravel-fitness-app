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
                    @foreach($activities as $activity)
                        <div class="flex justify-between mb-4 border-b-2">
                            <div>{{ $activity->name }}</div>

                            <div class="flex space-x-3 items-center mb-2">
                                <x-secondary-button class="bg-blue-500 text-white">
                                    <a href="{{ route('daily-activity.edit', $activity->id) }}">
                                        Edit
                                    </a>
                                </x-secondary-button>
                                <form method="post" onsubmit="confirm('Are you sure?')"
                                      action="{{ route('daily-activity.destroy', $activity->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <x-secondary-button type="submit"
                                    class="bg-red-500 text-white">Delete</x-secondary-button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
