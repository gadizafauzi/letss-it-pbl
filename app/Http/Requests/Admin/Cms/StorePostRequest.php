<?php

namespace App\Http\Requests\Admin\Cms;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'         => 'required|string|max:255',
            'slug'          => 'nullable|string|max:300|unique:cms_posts,slug',
            'category_id'   => 'required|exists:cms_post_categories,id',
            'featured_image'=> 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'excerpt'       => 'nullable|string|max:500',
            'body'          => 'required|string',
            'status'        => 'required|in:draft,published',
            'publish_date'  => 'nullable|date',
            'is_active'     => 'boolean',
        ];
    }
}
