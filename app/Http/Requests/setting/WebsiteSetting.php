<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class WebsiteSetting extends FormRequest
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
            'email_one' => 'required|email',
            'email_two' => 'nullable|email',
            'phone_one' => 'required|numeric',
            'phone_two' => 'nullable|numeric',
            'address_one' => 'required',
            'address_two' => 'nullable',
            'city' => 'nullable',
            'country' => 'nullable',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'about' => 'nullable',
        ];
    }
}
