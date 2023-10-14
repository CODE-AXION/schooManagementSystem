<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

            
        <x-input-error :messages="$errors" />

        <div class="m-4">
            <x-session-status></x-session-status>
        </div>

            <form role="form" method="post" action="{{route("admin.roles.update",$role->id)}}"  enctype="multipart/form-data">
                {{csrf_field()}}
                @method('PUT')
            <div class="mt-4">
                <label class=" " for="username">Role Name</label>

                <input type="text" name="name" class="block w-4/12  px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md  focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring"
                 placeholder="Enter Your Role Name ..." value="{{old('name', $role->name)}}"  />
            </div>

            <p class="text-dark"> <b>{{ __('Assign Permissions to role') }}</b> </p>


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



                <tbody>
                    @foreach($permissions as $key => $group)
                    <tr>
                        <td>
                            <b>{{ ucfirst($key) }}</b>
                        </td>
                        <td width="30%">
                            <label>
                                <input class="selectall" type="checkbox">
                                {{__('Select All') }}
                            </label>
                        </td>
                        <td>

                            @forelse($group as $permission)

                                <label style="width: 30%">
                                    <input {{ $role->permissions->contains('id',$permission->id) ? "checked" : "" }}  name="permissions[]" class="permissioncheckbox" type="checkbox" value="{{ $permission->id }}">
                                    {{$permission->name}} &nbsp;&nbsp;
                                </label>

                            @empty
                                {{ __("No permission in this group !") }}
                            @endforelse

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="block mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 ">Update Role</button>

            </form>



        </div>


        @push('scripts')
        <script src="{{asset('js/checkbox.js')}}"></script>


        @endpush

</x-app-layout>


