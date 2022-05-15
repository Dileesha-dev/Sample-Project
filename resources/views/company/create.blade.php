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
            <div class="mt-3 mb-5"><h1 class="text-xl">@isset ($company) Edit @else Add New @endif  Company</h1></div>
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
                    <form method="POST" action="@isset($company) {{ route('company.update', ['id' => $company->id]) }} @else {{ route('company.store') }} @endisset"  enctype="multipart/form-data">
                        @csrf
                        @isset($company)
                            @method('put')
                        @endisset
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="logo" class="form-label">Logo</label>
                            </div>
                            <div class="col-sm-10 text-left">
                                <input type="file" name="logo" id="logo" class="form-control w-50">
                            </div>
                        </div>
                        @isset($company)
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10 text-left">
                                <img src="@if ($company->logo_url) {{$company->logo_url}} @else https://www.freeiconspng.com/thumbs/no-image-icon/no-image-icon-32.png @endif" style="height: 100px; width: 100px" />
                            </div>
                        </div>
                        @endisset
                        <div class="row mt-4">
                            <div class="col-sm-2">
                                <label for="name" class="form-label">Name</label>
                            </div>
                            <div class="col-sm-10 text-left">
                                <input type="text" class="form-control w-50" id="name" name="name" value="@isset($company) {{$company->name}} @endisset" />
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-2">
                                <label for="email" class="form-label">Email</label>
                            </div>
                            <div class="col-sm-10 text-left">
                                <input type="email" class="form-control w-50" id="email" name="email" value="@isset($company) {{$company->email}} @endisset" />
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-2">
                                <label for="telephone" class="form-label">Telephone</label>
                            </div>
                            <div class="col-sm-10 text-left">
                                <input type="text" class="form-control w-50" id="telephone" name="telephone" value="@isset($company) {{$company->telephone}} @endisset" />
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-2">
                                <label for="website" class="form-label">Website</label>
                            </div>
                            <div class="col-sm-10 text-left">
                                <input type="text" class="form-control w-50" id="website" name="website" value="@isset($company) {{$company->website}} @endisset" />
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-2">
                                <label for="covers" class="form-label">Covers</label>
                            </div>
                            <div class="col-sm-10 text-left">
                                <input type="file" name="covers[]" id="covers" class="form-control w-50" multiple>
                            </div>
                        </div>
                        @isset($company)
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10 p-5" style="display: flex; flex-direction: row; flex-wrap: wrap; justify-content: space-evenly">
                                @foreach ($company->covers as $cover)
                                    <div class="text-center" style="position: relative;">
                                        <img src="@if ($cover->cover_url) {{$cover->cover_url}} @endif" style="max-height: 100px; opacity: 0.5" />
                                        <form action="{{ route('company.coverRemove', ['id' => $company->id, 'coverId' => $cover->id]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="mt-2" style="cursor: pointer; position: absolute; top: 45%; left: 50%; transform: translate(-50%, -50%)">remove</button> 
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endisset
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
