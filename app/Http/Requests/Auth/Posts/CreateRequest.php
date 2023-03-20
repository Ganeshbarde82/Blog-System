<?php

namespace App\Http\Requests\Auth\Posts;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'file' => ['required','image','mimes:jpg,png,jpeg'],    // or diminsions
            'title' =>['required','string','max:255'],          //custom rule pass y  // advance
            'description'=>['required','string','max:3000'],
            'status' =>['required','integer','max:255'],
            'category' =>['required','integer','max:255'],
            'tags' =>['required','array'],                    // check array
            'tags.*' =>['required','string','max:255'] 
        ];
    }
}
