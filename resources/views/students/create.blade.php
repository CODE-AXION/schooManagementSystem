<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

            
        <x-input-error :messages="$errors" />

        <div class="m-4">
            <x-session-status></x-session-status>
        </div>


        <x-bladewind::card>

            <form method="get" class="signup-form">
        
                <h1 class="my-2 text-2xl font-light text-blue-900/80">Create Student</h1>
                {{-- <p class="mt-3 mb-6 text-blue-900/80 text-sm">
                    This is a sign up form example to demonstrate how to validate forms using .
                </p> --}}

         
       
                <div class="flex gap-4">
                    <x-bladewind::input
                    name="first_name"
                    required="true"
                    label="First Name"
                    error_message="You will need to enter your First name" />
        
                    <x-bladewind::input
                    name="last_name"
                    required="true"
                    label="Last Name" />
    
                </div>

                
                <div class="flex gap-4">
                    <x-bladewind::input
                    name="email"
                    required="true"
                    label="Email"
                    error_message="You will need to enter your Email" />
  
    
                </div>

                <div class="flex gap-4 w-full">
                    <x-bladewind::select class="w-full" name="gender" placeholder="Select Gender" data="manual">
                        <x-bladewind::select-item label="Male" value="male" />
                        <x-bladewind::select-item label="Female" value="female" />
                        <x-bladewind::select-item label="Prefer not to say" value="other" />
                    </x-bladewind::select>

                
                    <x-bladewind::select class="w-full" name="city" placeholder="Select City" data="manual">
                        <x-bladewind::select-item label="Vadodara" value="male" />
                        <x-bladewind::select-item label="Ahmedabad" value="female" />
                        <x-bladewind::select-item label="Anand" value="other" />
                    </x-bladewind::select>
                </div>

                <div class="flex gap-4">
                    <x-bladewind::input
                    name="nationality"
                    required="true"
                    label="Nationality" />
        
                    <x-bladewind::input name="mobile"
                    label="Mobile             "
                    placeholder="000.0000.000"
                    show_placeholder_always="true" />
    
                </div>

                <div class="flex gap-4">
                     
                    <x-bladewind::textarea
                    required="true"
                    name="bio"
                    error_message="Yoh! write something nice about yourself"
                    show_error_inline="true"
                    label="Address 1"></x-bladewind::textarea>
            
                        
                    <x-bladewind::textarea
                    required="true"
                    name="bio"
                    error_message="Yoh! write something nice about yourself"
                    show_error_inline="true"
                    label="Address 2"></x-bladewind::textarea>
        
                </div>
        
        
        
                <x-bladewind::textarea
                    required="true"
                    name="bio"
                    error_message="Yoh! write something nice about yourself"
                    show_error_inline="true"
                    label="Describe yourself"></x-bladewind::textarea>
        
              
                <div class="flex gap-4">
                 
                    <x-bladewind::input name="mobile"
                    label="Zip"
                    placeholder="00000"
                    show_placeholder_always="true" />
    
                    

                </div>
    
        
            </form>
        
        </x-bladewind::card>



        </div>


        @push('scripts')
        <script src="{{asset('checkbox.js')}}"></script>
        @endpush

</x-app-layout>


