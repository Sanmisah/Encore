<x-layout.default>  
<div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('doctors.index') }}" class="text-primary hover:underline">Doctor</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Add</span>
        </li>
    </ul>
    <div class="pt-5" x-data="data">        
        <form class="space-y-5" action="{{ route('doctors.store') }}" method="POST">
            @csrf
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Add Doctor</h5>
                </div>
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4"> 
                    <x-text-input name="doctor_name" value="{{ old('doctor_name') }}" :label="__('Doctor Name')" :require="true" :messages="$errors->get('doctor_name')"/>  
                    <x-text-input name="hospital_name" value="{{ old('hospital_name') }}" :label="__('Hospital Name')" :require="true" :messages="$errors->get('hospital_name')"/> 
                </div>   
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">  
                    <x-combo-input name="email" :email="true" value="{{ old('email') }}" :require="true" :label="__('Email')" :messages="$errors->get('email')"/>  
                    <x-text-input name="contact_no_1" value="{{ old('contact_no_1') }}" :label="__('Contact No 1')" :messages="$errors->get('contact_no_1')" :require="true"/>  
                    <x-text-input name="contact_no_2" value="{{ old('contact_no_2') }}" :label="__('Contact No 2')" :messages="$errors->get('contact_no_2')"/>   
                </div>  
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                    <x-text-input name="dob" value="{{ old('dob') }}" id="dob" :label="__('DOB')" :messages="$errors->get('dob')"/>
                    <x-text-input name="dow" value="{{ old('dow') }}" id="dow" :label="__('DOW')" :messages="$errors->get('dow')"/>
                    <div>
                        <label>States:<span style="color: red">*</span></label>
                        <select class="form-input" name="state">
                            <option value="">Select states</option>
                            <template x-for="state in states" :key="state.code">
                                <option :value="state.name" x-text="state.name"></option>
                            </template>
                        </select> 
                        <x-input-error :messages="$errors->get('state')" class="mt-2" />
                    </div> 
                    <x-text-input name="city" value="{{ old('city') }}" :label="__('City')" :messages="$errors->get('city')" :require="true"/>  
                </div>
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                    <!-- <div>
                        <label>Employee:<span style="color: red">*</span></label>
                        <select class="form-input" id="employee_id" name="employee_id">
                            <option>Select employee</option>                            
                            @foreach ($employees as $id => $employee)
                                    <option value="{{$id}}">{{$employee}}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                    </div> -->
                    <div>
                        <label>Territory:<span style="color: red">*</span></label>
                        <select class="form-input" id="territory_id" name="territory_id">
                            <!-- <option>Select Territory</option>                             -->
                            @foreach ($territories as $id => $territory)
                                    <option value="{{$id}}">{{$territory}}</option>
                            @endforeach
                        </select> 
                    </div>
                    <div>
                        <label>Category:<span style="color: red">*</span></label>
                        <select class="form-input" id="category_id" name="category_id">
                            <!-- <option>Select Category</option>                             -->
                            @foreach ($categories as $id => $category)
                                    <option value="{{$id}}">{{$category}}</option>
                            @endforeach
                        </select> 
                    </div>
                    <div>
                        <label>Type:<span style="color: red">*</span></label>
                        <select class="form-input" id="type" name="type">
                            <!-- <option>Select Type</option>  -->
                            <option value="ex">EX</option>
                            <option value="hq">HQ</option>
                        </select> 
                    </div>
                    <div>
                        <label>Qualification:<span style="color: red">*</span></label>
                        <select class="form-input" id="qualification_id" name="qualification_id">
                            <!-- <option>Select Qualification</option>                             -->
                            @foreach ($qualifications as $id => $qualification)
                                    <option value="{{$id}}">{{$qualification}}</option>
                            @endforeach
                        </select> 
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">                     
                    <x-text-input name="speciality" value="{{ old('speciality') }}" :label="__('Speciality')" :messages="$errors->get('speciality')" :require="true"/>       
                    <x-text-input name="class" value="{{ old('class') }}" :label="__(' Class')" :messages="$errors->get('class')"/>  
                    <x-text-input name="mpl_no" value="{{ old('mpl_no') }}" :label="__(' MPL No')" :messages="$errors->get('mpl_no')" :require="true"/>     
                </div>
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">       
                    <x-text-input name="designation" value="{{ old('designation') }}" :label="__('Designation')" :messages="$errors->get('designation')" :require="true"/>  
                    <x-text-input name="hq" value="{{ old('hq') }}" :label="__('HQ')" :messages="$errors->get('hq')"/>  
                </div> 
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                    <div>
                        <label>Zonal Manager :</label>
                        <select class="form-input" name="reporting_office_1" id="office_1" x-model="rbm" @change="reportOffice()">
                            <!-- <option value="">Select Office-1</option> -->
                            @foreach ($employees as $id => $employee)
                                <option value="{{$id}}">{{$employee}}</option>
                            @endforeach
                        </select> 
                        <x-input-error :messages="$errors->get('reporting_office_1')" class="mt-2" /> 
                    </div>
                    <div>
                        <label>Area Manager :</label>
                        <select class="form-input" name="reporting_office_2" @change="reportOfficeME()" x-model="abml">
                            <option value="">Select Area Manager</option>
                            <template x-for="list in abm" :key="list.id">
                                <option :value="list.id" x-text="list.name"></option>
                            </template>
                        </select> 
                        <x-input-error :messages="$errors->get('reporting_office_2')" class="mt-2" />
                    </div>  
                    <div>
                        <label>Marketing Executive :</label>
                        <select class="form-input" name="reporting_office_3">
                            <option value="">Select Martkeing Executive</option>
                            <template x-for="me in mehq" :key="me.id">
                                <option :value="me.id" x-text="me.name"></option>
                            </template>
                        </select> 
                        <x-input-error :messages="$errors->get('reporting_office_3')" class="mt-2" />
                    </div>
                </div> 
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-1"> 
                    <x-text-input name="doctor_address" value="{{ old('doctor_address') }}" :label="__('Doctor Address')" :messages="$errors->get('doctor_address')"/> 
                </div> 
                <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-1">
                    <x-text-input name="hospital_address" value="{{ old('hospital_address') }}" :label="__('Hospital Address')" :messages="$errors->get('hospital_address')"/>  
                </div> 
                <div class="flex justify-end mt-4">
                    <x-success-button>
                        {{ __('Submit') }}
                    </x-success-button>
                    &nbsp;&nbsp;
                    <x-cancel-button :link="route('doctors.index')">
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
        states: '',    
        init() {
            flatpickr(document.getElementById('dob'), {
                dateFormat: 'd/m/Y',
            });

            flatpickr(document.getElementById('dow'), {
                dateFormat: 'd/m/Y',
            });

            var options = {
                searchable: true
            };
            NiceSelect.bind(document.getElementById("territory_id"), options);
            NiceSelect.bind(document.getElementById("category_id"), options);
            NiceSelect.bind(document.getElementById("qualification_id"), options);
            NiceSelect.bind(document.getElementById("type"), options);
            NiceSelect.bind(document.getElementById("office_1"), options);

            this.states = [
                { code: 'AN', name: 'Andaman and Nicobar Islands' },
                { code: 'AP', name: 'Andhra Pradesh' },
                { code: 'AR', name: 'Arunachal Pradesh' },
                { code: 'AS', name: 'Assam' },
                { code: 'BR', name: 'Bihar' },
                { code: 'CG', name: 'Chandigarh' },
                { code: 'CH', name: 'Chhattisgarh' },
                
                { code: 'DN', name: 'Dadra and Nagar Haveli' },
                { code: 'DD', name: 'Daman and Diu' },
                { code: 'DL', name: 'Delhi' },
                { code: 'GA', name: 'Goa' },
                { code: 'GJ', name: 'Gujarat' },
                { code: 'HR', name: 'Haryana' },
                { code: 'HP', name: 'Himachal Pradesh' },

                { code: 'JK', name: 'Jammu and Kashmir' },
                { code: 'JH', name: 'Jharkhand' },
                { code: 'KA', name: 'Karnataka' },
                { code: 'KL', name: 'Kerala' },
                { code: 'LA', name: 'Ladakh' },
                { code: 'LD', name: 'Lakshadweep' },
                { code: 'MP', name: 'Madhya Pradesh' },
                
                { code: 'MH', name: 'Maharashtra' },
                { code: 'MN', name: 'Manipur' },
                { code: 'ML', name: 'Meghalaya' },
                { code: 'MZ', name: 'Mizoram' },
                { code: 'NL', name: 'Nagaland' },
                { code: 'OR', name: 'Odisha' },
                { code: 'PY', name: 'Puducherry' },
                
                { code: 'PB', name: 'Punjab' },
                { code: 'RJ', name: 'Rajasthan' },
                { code: 'SK', name: 'Sikkim' },
                { code: 'TN', name: 'Tamil Nadu' },
                { code: 'TS', name: 'Telangana' },
                { code: 'TR', name: 'Tripura' },
                { code: 'UP', name: 'Uttar Pradesh' },
                { code: 'UK', name: 'Uttarakhand' },
                { code: 'WB', name: 'West Bengal' },
            ];
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
    }));
});
</script>
</x-layout.default>
