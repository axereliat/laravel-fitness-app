<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Record') }}
        </h2>
    </x-slot>

    <x-success-message/>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{ route('records.update', $record) }}">
                        @csrf
                        @method('PUT')
                        @include('components.partials.record-form-fields')
                        <x-secondary-button>
                            <a href="{{ route('records.index') }}">
                                Cancel
                            </a>
                        </x-secondary-button>
                        <x-primary-button>Edit</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
