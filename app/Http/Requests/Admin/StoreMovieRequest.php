<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Assuming authorization is handled by controller middleware
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'titleEng' => 'nullable|string|max:255',
            'description' => 'required|string',
            'release_date' => 'required|date',
            'duration' => 'required|integer|min:1', // Assuming duration in minutes
            'age_rating' => 'nullable|string|max:50',
            'director' => 'nullable|string|max:255',
            'cast' => 'nullable|string',
            'trailerUrl' => 'nullable|url|max:500',
            'categories' => 'nullable|array',
            'categories.*' => 'integer|exists:category,id', // Validate each category ID
            'poster_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Example for poster
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'categories.*.exists' => 'The selected category is invalid.',
            'poster_image.image' => 'The uploaded file must be an image.',
            'poster_image.mimes' => 'The poster must be a file of type: jpeg, png, jpg, gif, webp.',
        ];
    }
}
