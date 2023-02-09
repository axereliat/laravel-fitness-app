<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Record') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post">
                        <label for="activities">Activity type</label>
                        <select name="activities" id="activities"></select>
                        <x-text-input name="sets" placeholder="sets"></x-text-input>
                        <x-text-input name="reps" placeholder="Reps"></x-text-input>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
