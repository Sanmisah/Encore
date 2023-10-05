<?php

namespace App\Http\Requests;
use App\Models\Employee;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',  
            'email' => 'required|unique:employees,email,'.$this->employee->id,
            'contact_no_1' => 'required|numeric|min:10',
            'contact_no_2' => 'required|numeric|min:10',
            'address' => 'required',
            'designation' => 'required',
            'state_name' => 'required',
            'city' => 'required',
            'fieldforce_name' => 'required',
            'dob' => 'required',
            // 'reporting_office_1' => 'required',
            // 'reporting_office_2' => 'required',
            // 'reporting_office_3' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Activity is required',
            'email.unique' => 'Already exist email',
            'contact_no_1.required' => 'Contact no is required',
            'contact_no_2.required' => 'Contact no is required',
            'dob.required' => 'Please add birth date',
            'state_name.required' => 'State is required',
            'designation.required' => 'Select Designation',
        ];
    }
}
