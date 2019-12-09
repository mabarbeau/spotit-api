<?php

namespace App\Http\Requests;

class StoreSpot extends Request
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
            'slug' => "required|max:255|unique:spots,id,:id",
            'title' => 'required',
            'description' => 'required',
            'address' => 'required',
            'locality' => 'required',
            'region' => 'required',
            'postcode'=> '',
            'country' => 'required',
        ];
    }
}
