<?php

namespace App\Http\Requests;

use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $comment = $this->route('comment');

        return Auth::check() && Auth::user()->id === $comment->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'text' => 'required|string|max:255',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->post_id = $this->route('post')->id;
    }
    protected function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $comment = $this->route('comment');
            if ($comment->post_id !== $this->post_id) {
                $validator->errors()->add('post_id', 'The comment does not belong to this post.');
            }
        });
    }
}
