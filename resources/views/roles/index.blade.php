<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <div class="m-4">
            <x-session-status></x-session-status>
        </div>

        <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Role Name</th>
                <th>Permissions</th>
                <th>Actions</th>
                
              </tr>
            </thead>
            <tbody>

              @foreach ($roles as $role)

              <tr>
                  <td>{{$loop->iteration}}</td>
                  <td> {{$role->name}} </td>
                  <td>
                    <div class="flex items-center flex-wrap">
                        @foreach ($role->permissions as $permission)
  
                    
                        <span class="bg-blue-200 text-blue-600 rounded-full mx-2 px-1 py-0.5 text-sm">
                            {{ucwords(str_replace('.', ' ', $permission->name))}}
                        </span>
  
                        @endforeach
                    </div>
                  </td>
                  <td>
                    <div class="flex items-center gap-6 justify-center">
                      
                      <div>
                        <a href="{{route('admin.roles.edit',$role->id)}}">
                            <svg xmlns="http://www.w3.org/2000/svg"  fill=" currentColor" class="w-3 h-3 mx-auto scale-150 fill-indigo-700 bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                        </a>
                      </div>

                      <div>
                        <svg  data-type="Role" data-name="Role" data-url="{{route('admin.roles.delete',$role->id)}}"  xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="w-3 h-3 cursor-pointer delete mx-auto fill-red-700 scale-150 bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                        </svg>
                      </div>
                    </div>
                  </td>

             
            
              </tr>

              @endforeach

            </tbody>
          </table>

    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>


    <script type="module">

    let table = new DataTable('#dataTableExample', {});



    </script>
</x-app-layout>



