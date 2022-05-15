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
            <div class="mt-3 mb-5"><h1 class="text-xl">@isset ($employee) Edit @else Add New @endif  Employee</h1></div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200 p-6">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert">&times;</button>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                      </div>
                    @endif
                    @if (\Session::has('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="btn-close" data-bs-dismiss="alert">&times;</button>
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="@isset($employee) {{ route('employee.update', ['employee' => $employee->id]) }} @else {{ route('employee.store') }} @endisset"  enctype="multipart/form-data">
                        @csrf
                        @isset($employee)
                            @method('put')
                        @endisset
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="logo" class="form-label">Profile Photo</label>
                            </div>
                            <div class="col-sm-10 text-left">
                                <input type="file" name="profile_photo" id="profile_photo" class="form-control w-50">
                            </div>
                        </div>
                        @isset($employee)
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10 text-left">
                                <img src="@if ($employee->profile_photo_url) {{$employee->profile_photo_url}} @else https://www.freeiconspng.com/thumbs/no-image-icon/no-image-icon-32.png @endif" style="height: 100px; width: 100px" />
                            </div>
                        </div>
                        @endisset
                        <div class="row mt-4">
                            <div class="col-sm-2">
                                <label for="first_name" class="form-label">First Name</label>
                            </div>
                            <div class="col-sm-10 text-left">
                                <input type="text" class="form-control w-50" id="first_name" name="first_name" value="@isset($employee) {{$employee->first_name}} @endisset" />
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-2">
                                <label for="last_name" class="form-label">Last Name</label>
                            </div>
                            <div class="col-sm-10 text-left">
                                <input type="text" class="form-control w-50" id="last_name" name="last_name" value="@isset($employee) {{$employee->last_name}} @endisset" />
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-2">
                                <label for="email" class="form-label">Email</label>
                            </div>
                            <div class="col-sm-10 text-left">
                                <input type="email" class="form-control w-50" id="email" name="email" value="@isset($employee) {{$employee->email}} @endisset" />
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-2">
                                <label for="company" class="form-label">Company</label>
                            </div>
                            <div class="col-sm-10 text-left">
                                <select class="form-select w-50" id="company" name="company_id" aria-label="Default select example">
                                    @foreach ($companies as $company)
                                        <option value="{{$company->id}}" @isset($employee) @if ($employee->company_id == $company->id) selected @endif @endisset>{{$company->name}}</option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-2">
                                <label for="phone" class="form-label">Telephone</label>
                            </div>
                            <div class="col-sm-10 text-left">
                                <input type="text" class="form-control w-50" id="phone" name="phone" value="@isset($employee) {{$employee->phone}} @endisset" />
                            </div>
                        </div>
                        <hr class="mt-4 mb-4">
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary bg-primary btn-lg">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
