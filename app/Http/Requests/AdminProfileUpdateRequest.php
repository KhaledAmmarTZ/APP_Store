<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the admin is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::guard('admin')->check(); 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, 
     */
    public function rules(): array
    {
        $adminId = Auth::guard('admin')->id(); 

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(Admin::class)->ignore($adminId),
            ],
            'date_of_birth' => ['nullable', 'date'],
            'phoneNumber' => ['nullable', 'string', 'max:15'],
            'place' => ['nullable', 'string', 'max:255'],
            'admin_nid' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique(Admin::class, 'admin_nid')->ignore($adminId),
            ],
            'admin_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }
}
