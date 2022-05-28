<?php

namespace App\Http\Requests\Resource;

use App\Models\Resource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreResourceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'resource_name' => 'required|max:255',
            'resource_type' => 'required',
            'year' => 'numeric|nullable',
            'resource_url' => 'required_if:resource_type,==,'.Resource::RESOURCE_TYPE_URL.'|nullable|url',
            'file_input' => 'required_if:resource_type,==,'.Resource::RESOURCE_TYPE_FILE.'|nullable|file|mimes:doc,docx,pdf,zip',
        ];
    }
}
