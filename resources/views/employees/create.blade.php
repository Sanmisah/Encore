<x-layout.default>  
<div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('employees.index') }}" class="text-primary hover:underline">Employees</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Add</span>
        </li>
    </ul>
    <div class="pt-5" x-data="data">        
        <form class="space-y-5" action="{{ route('employees.store') }}" method="POST">
            @csrf
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Add Employees</h5>
                </div>
                <div class="grid grid-cols-4 gap-4 mb-4">              
                    <x-text-input name="name" value="{{ old('name') }}" :label="__('Employee Name')" :require="true" :messages="$errors->get('name')"/> 
                    <x-combo-input name="email" type="email" :email="true" value="{{ old('email') }}" :label="__('Email')" :messages="$errors->get('email')"/>
                    <x-text-input name="contact_no_1" value="{{ old('contact_no_1') }}" :label="__('Contact No 1')" :messages="$errors->get('contact_no_1')"/> 
                    <x-text-input name="contact_no_2" value="{{ old('contact_no_2') }}" :label="__('Contact No 2')" :messages="$errors->get('contact_no_2')"/> 
                </div>     
                <div class="grid grid-cols-1 gap-4 mb-4"> 
                    <x-text-input name="address" value="{{ old('address') }}" :label="__('Address')" :messages="$errors->get('address')"/> 
                </div> 
                <div class="grid grid-cols-4 gap-4 mb-4"> 
                    <div>
                        <label>Designation :<span style="color: red">*</span></label>
                        <select class="form-input" name="designation" x-model="designation" @change="designationChange()">
                            <option>Select Designation</option>
                            <option value="RBM/ZBM">RBM / ZBM</option>
                            <option value="ABM">ABM</option>
                            <option value="MEHQ">ME HQ</option>
                            <option value="Operator">Operator</option>
                        </select> 
                        <x-input-error :messages="$errors->get('designation')" class="mt-2" /> 
                    </div>
                    <x-text-input name="dob" type="date" value="{{ old('dob') }}" id="dob" :label="__('DOB')" :messages="$errors->get('dob')"/>
                    <x-text-input name="state_name" value="{{ old('state_name') }}" :label="__('State name')" :messages="$errors->get('state_name')"/> 
                    <x-text-input name="city" value="{{ old('city') }}" :label="__('City')" :messages="$errors->get('city')"/>
                </div>
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <x-text-input name="fieldforce_name" value="{{ old('fieldforce_name') }}" :label="__('Fieldforce Name')" :messages="$errors->get('fieldforce_name')"/>   
                    <x-text-input name="employee_code" value="{{ old('employee_code') }}" :label="__('Employee Code')" :messages="$errors->get('employee_code')" />  
                </div>   
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div x-show="rbmopen">
                        <label>Reporting Office 1 :</label>
                        <select class="form-input" name="reporting_office_1" x-model="rbm" @change="reportOffice()">
                            <option>Select Office-1</option>
                            @foreach ($employees as $employee)
                                @if($employee->designation == 'RBM/ZBM')
                                <option value="{{$employee->id}}">{{$employee->name}}</option>
                                @endif
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('reporting_office_1')" class="mt-2" /> 
                    </div>
                    <div x-show="abmopen">
                        <label>Reporting Office 2 :</label>
                        <select class="form-input" name="reporting_office_2" @change="reportOfficeME()" x-model="abml">
                            <option>Select Office-2</option>
                            <template x-for="list in abm" :key="list.id">
                                <option :value="list.id" x-text="list.name"></option>
                            </template>
                        </select> 
                        <x-input-error :messages="$errors->get('reporting_office_2')" class="mt-2" />
                    </div>  
                    <div x-show="meopen">
                        <label>Reporting Office 3 :</label>
                        <select class="form-input" name="reporting_office_3">
                            <option>Select Office-3</option>
                            <template x-for="me in mehq" :key="me.id">
                                <option :value="me.id" x-text="me.name"></option>
                            </template>
                        </select> 
                        <x-input-error :messages="$errors->get('reporting_office_3')" class="mt-2" />
                    </div>
                </div>         
                <div class="flex justify-end mt-4">
                    <x-success-button>
                        {{ __('Submit') }}
                    </x-success-button>
                    &nbsp;&nbsp;
                    <x-cancel-button :link="route('employees.index')">
                        {{ __('Cancel') }}
                    </x-cancel-button>
                </div>       
            </div> 
        </form> 
    </div>
</div> 
<script>
document.addEventListener("alpine:init", () => {
    Alpine.data('data', () => ({      
        init() {
            this.rbmopen = true;
            this.abmopen = true;
            this.meopen = true;
            flatpickr(document.getElementById('dob'), {
                dateFormat: 'd/m/Y',
            });
        },

        rbm: '',
        abm: '',
        async reportOffice() {               
            this.abm = await (await fetch('/employees/'+ this.rbm, {
                method: 'GET',
                headers: {
                    'Content-type': 'application/json;',
                },
            })).json();
            console.log(this.abm); 
        },      
         
        mehq: '',
        abml:'',
        async reportOfficeME() {
            this.mehq = await (await fetch('/employees/getReportingOfficer3/'+ this.abml, {
                method: 'GET',
                headers: {
                    'Content-type': 'application/json;',
                },
            })).json();
            console.log(this.mehq);
        },

        designation: '',
        designationChange(){
            if (this.designation == 'RBM/ZBM') {
                this.rbmopen = false;
                this.abmopen = false;
                this.meopen = false;
            } else if (this.designation == 'ABM') {
                this.rbmopen = true;
                this.abmopen = false;
                this.meopen = false;
            } else if (this.designation == 'MEHQ') {
                this.rbmopen = true;
                this.abmopen = true;
                this.meopen = false;
            } else {
                this.rbmopen = true;
                this.abmopen = true;
                this.meopen = true;
            }
        }
    }));
});
</script>
</x-layout.default>
