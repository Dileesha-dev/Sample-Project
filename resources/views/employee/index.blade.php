<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid" style="display: flex; flex-direction: row; justify-content: space-between;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Employees') }}
            </h2>
            <div>
                <a class="nav-item" href="{{ route('company.index') }}">Companies</a>
                <a class="nav-item" href="{{ route('employee.index') }}">Employees</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a class="btn btn-success btn-lg mb-4" href="{{ route('employee.create') }}">+ Add New</a>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200 p-6">
                    <div>
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Employee ID</th>
                                <th scope="col">Photo</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Company</th>
                                <th scope="col">Telephone</th>
                                <th scope="col">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{$employee->id}}</td>
                                        <td><image src="{{$employee->profile_photo_url}}" style="height: 100px; width: 100px" /></td>
                                        <td>{{$employee->first_name}}</td>
                                        <td>{{$employee->last_name}}</td>
                                        <td>{{$employee->email}}</td>
                                        <td>{{$employee->company->name}}</td>
                                        <td>{{$employee->phone}}</td>
                                        <td>
                                            <div class="flex" style="justify-content: space-evenly">
                                                <a class="btn btn-info text-white" href="{{ route('employee.edit', ['employee' => $employee->id]) }}">Edit</a>
                                                <form action="{{ route('employee.destroy', ['employee' => $employee->id]) }}" method="post">@csrf @method('delete')<button class="btn btn-danger">Delete</button></form>
                                            </div>
                                        </td>
                                    </tr>   
                                @endforeach
                            </tbody>
                          </table>
                    </div>
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
