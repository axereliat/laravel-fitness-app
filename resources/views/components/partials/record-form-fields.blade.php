<label for="daily_activity_id">Activity type</label>
<select name="daily_activity_id" id="daily_activity_id">
    <option value="">Choose</option>
    @foreach($activities as $activity)
        <option value="{{ $activity->id }}"
                @if(!empty($record) && $record->daily_activity_id === $activity->id) selected="selected" @endif>
            {{ $activity->name }}
        </option>
    @endforeach
</select>
<x-input-error :messages="$errors->get('daily_activity_id')" class="mt-2" />
<div class="mt-4">
    <x-input-label for="sets" :value="__('Sets')" />
    <x-text-input id="sets" class="block mt-1 w-full"
                  type="number" name="sets" :value="old('sets') ?? $record->sets ?? ''" required />
    <x-input-error :messages="$errors->get('sets')" class="mt-2" />
</div>
<div class="mt-4">
    <x-input-label for="reps" :value="__('Reps')" />
    <x-text-input id="reps" class="block mt-1 w-full"
                  type="number" name="reps" :value="old('reps') ?? $record->reps ?? ''" required />
    <x-input-error :messages="$errors->get('reps')" class="mt-2" />
</div>
<br/>
