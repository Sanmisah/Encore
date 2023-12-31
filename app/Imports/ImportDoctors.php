<?php
namespace App\Imports;
use App\Models\Doctor;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;

class ImportDoctors implements ToModel,WithHeadingRow,WithValidation
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function rules(): array
    {
        return [
            'doctor_name' => 'unique:doctors,doctor_name',
            'hospital_name' => 'unique:doctors,hospital_name',
            'contact_no_1' => 'unique:doctors,contact_no_1',
            'email' => 'unique:doctors,email',
        ];
    }
    public function customValidationMessages()
    {
        return [
            'doctor_name.unique' => 'Doctor name Already Exist',
            'hospital_name.unique' => 'Hospital name Already Exist',
            'contact_no_1.unique' => 'Contact No Already Exist',
            'email.unique' => 'Email Code Already Exist',
        ];
    }
    public function model(array $row)
    {
        return new Doctor([
            'doctor_name' => $row['doctor_name'],
            'doctor_address' => $row['doctor_address'],
            'hospital_name' => $row['hospital_name'],
            'hospital_address' => $row['hospital_address'],
            'contact_no_1' => $row['contact_no_1'],
            'contact_no_2' => $row['contact_no_2'],
            'email' => $row['email'],
            'state' => $row['state'],
            'city' => $row['city'],
            'speciality' => $row['speciality'],
            'designation' => $row['designation'],
            'hq' => $row['hq'],
            'type' => $row['type'],
            'mpl_no' => $row['mpl_no'],
            'territory_id' => $row['territory_id'],
            'category_id' => $row['category_id'],
            'qualification_id' => $row['qualification_id'],
            'reporting_office_1' => $row['reporting_office_1'],
            'reporting_office_2' => $row['reporting_office_2'],
            'reporting_office_3' => $row['reporting_office_3'],
        ]);

    }
}
