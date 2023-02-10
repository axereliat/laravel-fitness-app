<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecordPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'daily_activity_id' => 'required|exists:daily_activities,id',
            'sets' => 'required|numeric|min:1|max:30',
            'reps' => 'required|numeric|min:1|max:50'
        ];
    }
}
