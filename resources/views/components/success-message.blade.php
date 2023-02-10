@if(session()->has('success'))
    <div class="mb-4">
        <div class="bg-green-700 text-white py-4 text-center">
            {{ session('success') }}
        </div>
    </div>
@endif
