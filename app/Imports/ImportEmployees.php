<?php
namespace App\Imports;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;

class ImportEmployees implements ToModel,WithHeadingRow,WithValidation
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
            // 'name' => 'unique:employees,name',
            // 'email' => 'unique:employees,email',
        ];
    }
    public function customValidationMessages()
    {
        return [
            // 'name.unique' => 'Employees Already Exist',
            // 'email.unique' => 'Email Already Exist',
        ];
    }
    public function model(array $row)
    {
        $user = new User([
            'name' => $row['name'],
            'password' => 'abcd123',
            'active' => '1',
            'email' => $row['email'],
        ]);
        
        $zbm = DB::table('employees')->where('employee_code', $row['zbm_emp_code'])->first();
        $abm = DB::table('employees')->where('employee_code', $row['abm_emp_code'])->first();
        $me = DB::table('employees')->where('employee_code', $row['mehq_emp_code'])->first();
        $data = DB::table('users')->where('name', $row['name'])->first();
        
        // if(!$zbm || !$abm || !$me || !$data) {
        //     echo "<pre>";
        //     echo "ZBM <br />"; print_r($zbm); echo "<hr/>";
        //     echo "ABM <br />"; print_r($abm); echo "<hr/>";
        //     echo "ME <br />"; print_r($me); echo "<hr/>";
        //     echo "user <br />"; print_r($data); echo "<hr/>";
        //     echo "Data <br />"; print_r($row);
        //     echo "</pre>";
        //     exit;
        // }

        $user->Employee()->create([
            'id' => isset($data->id) ? $data->id : NULL,
            'name' => $row['name'],
            'email' => $row['email'],
            'communication_email' => $row['communication_email'],
            'contact_no_1' => $row['contact_no_1'],
            'contact_no_2' => $row['contact_no_2'],
            'address' => $row['address'],
            'designation' => $row['designation'],
            'state_name' => $row['state_name'],
            'city' => $row['city'],
            'fieldforce_name' => $row['fieldforce_name'],
            'employee_code' => $row['employee_code'],
            'reporting_office_1' => $zbm->id ?? null,
            'reporting_office_2' => $abm->id ?? null,
            'reporting_office_3' => $me->id ?? null,
        ]);        

        return [$user, $user->syncRoles($row['designation'])];
    }
}
