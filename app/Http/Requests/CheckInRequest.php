<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckInRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'checkin_category_ids' => 'array|nullable|exists:check_in_categories,id'
        ];
    }

    /**
     * @return bool
     */
    public function hasCheckInCategoryIds(): bool
    {
        return filled($this->input('checkin_category_ids'));
    }

    /**
     * @return bool
     */
    public function hasUserId(): bool
    {
        return filled($this->input('user_id'));
    }
}
