<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content.title' => ['required', 'string', 'max:255'],
            'content.description' => ['required', 'string', 'max:1000'],
            'content.phone' => ['nullable', 'string', 'max:50'],
            'content.email' => ['nullable', 'email', 'max:255'],
            'content.address' => ['nullable', 'string', 'max:1000'],
            'content.working_hours' => ['nullable', 'string', 'max:255'],
            'content.map_embed_url' => ['nullable', 'url', 'max:2000'],
            'content.map_link' => ['nullable', 'url', 'max:2000'],
            'content.form_title' => ['required', 'string', 'max:255'],
            'content.form_description' => ['required', 'string', 'max:1000'],
            'contact_notification_email' => ['required', 'email', 'max:255'],
            'quote_notification_email' => ['required', 'email', 'max:255'],
        ];
    }
}
