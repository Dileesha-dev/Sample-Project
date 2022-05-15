<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid" style="display: flex; flex-direction: row; justify-content: space-between;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Companies') }}
            </h2>
            <div>
                <a class="nav-item" href="{{ route('company.index') }}">Companies</a>
                <a class="nav-item">Employees</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a class="btn btn-success btn-lg mb-4" href="{{ route('company.create') }}">+ Add New</a>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200 p-6">
                    <div>
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Company ID</th>
                                <th scope="col">Logo</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Telephone</th>
                                <th scope="col">Website</th>
                                <th scope="col">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                    <tr>
                                        <td>{{$company->id}}</td>
                                        <td><image src="{{$company->logo_url}}" style="height: 100px; width: 100px" /></td>
                                        <td><a style="cursor: pointer; color:#0000EE" href="{{ route('company.show', ['company' => $company->id]) }}">{{$company->name}}</a></td>
                                        <td>{{$company->email}}</td>
                                        <td>{{$company->telephone}}</td>
                                        <td>{{$company->website}}</td>
                                        <td>
                                            <div class="flex" style="justify-content: space-evenly">
                                                <a class="btn btn-info text-white" href="{{ route('company.edit', ['company' => $company->id]) }}">Edit</a>
                                                <form action="{{ route('company.delete', ['company' => $company->id]) }}" method="post">@csrf @method('delete')<button class="btn btn-danger">Delete</button></form>
                                            </div>
                                        </td>
                                    </tr>   
                                @endforeach
                            </tbody>
                          </table>
                    </div>
                    {{ $companies->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
