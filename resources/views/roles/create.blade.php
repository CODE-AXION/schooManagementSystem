<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

            
        <x-input-error :messages="$errors" />

        <div class="m-4">
            <x-session-status></x-session-status>
        </div>


            <form role="form" method="post" action="{{route('admin.roles.store')}}"  enctype="multipart/form-data">
                {{csrf_field()}}

            <div class="mt-4">
                <label class=" " for="username">Role Name</label>

                <input type="text" name="name" class="block w-4/12  px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md  focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring"
                 placeholder="Enter Your Role Name ..." value="{{old('name')}}"  />
            </div>

            <p class="text-dark my-5"> <b>{{ __('Assign Permissions to role') }}</b> </p>


            <table class="permissionTable table">
                <th>
                    {{__('Section')}}
                </th>

                <th>
                    <label>
                        <input class="grand_selectall" type="checkbox">
                        {{__('Select All') }}
                    </label>
                </th>

                <th>
                    {{__("Available permissions")}}
                </th>



                <tbody >
                @foreach($permissions as $key => $group)
                    <tr class="border-t border-b">
                        <td>
                            <div class="text-sm">
                                <b>{{ ucfirst($key) }}</b>
                            </div>
                        </td>
                        <td width="30%">
                            <label class="text-sm ml-8">
                                <input class="selectall rounded" type="checkbox">
                                {{__('Select All') }}
                            </label>
                        </td>
                        <td class="grid grid-cols-4">

                            @forelse($group as $permission)

                            <div class="flex items-center gap-1 my-2 p-1 mx-1 border rounded">
                                
                                <input name="permissions[]" class="permissioncheckbox rounded block" type="checkbox" value="{{ $permission->id }}">
                                <label class="text-slate-900 text-sm gap-4 flex items-center block">
                                    {{ucwords(str_replace('.', ' ', $permission->name))}}
                                     &nbsp;&nbsp;
                                </label>
                            </div>


                            @empty
                                {{ __("No permission in this group !") }}
                            @endforelse

                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>

            <button type="submit" class="block mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 ">Create Role</button>

            </form>



        </div>


        @push('scripts')
        <script src="{{asset('checkbox.js')}}"></script>


        @endpush

</x-app-layout>


