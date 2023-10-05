<x-layout.default>
<div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="{{ route('users.index') }}" class="text-primary hover:underline">Users</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Add</span>
        </li>
    </ul>
    <div class="pt-5">        
        <form class="space-y-5" action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Add User</h5>
                </div>
                <div class="grid grid-cols-3 gap-4">               
                    <div>
                        <x-text-input name="name" value="{{ old('name') }}" :label="__('Name')" :require="true" :messages="$errors->get('name')"/>                             
                    </div>
                    <div>
                        <x-text-input name="email" value="{{ old('email') }}" :require="true" :label="__('Email')" :messages="$errors->get('email')"/>
                    </div>
                    <div>
                        <x-text-input name="password" value="{{ old('password') }}" :require="true" :label="__('Password')" :messages="$errors->get('password')"/>
                    </div>    
                    <div>
                        <label>Role:</label>
                        <select class="form-input" name="role">
                            <option selected disabled>Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{$role->id}}" 
                                    {{old('role') ? ((old('role') == $role->id) ? 'selected' : '') : '' }}>
                                    {{$role->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>               
                    <div>
                        <label>Active:</label>
                        <select class="form-input" name="active">
                            <option selected disabled>Select Status</option>
                            <option value='true'>Active</option>
                            <option value='false'>Deactive</option>                           
                        </select>
                    </div> 
                </div>
                <div class="flex justify-end mt-4">
                    <x-success-button>
                        {{ __('Submit') }}
                    </x-success-button>
                    &nbsp;&nbsp;
                    <x-cancel-button :link="route('users.index')">
                        {{ __('Cancel') }}
                    </x-cancel-button>
                </div>
            </div>
        </form> 
    </div>
</div> 
</x-layout.default>