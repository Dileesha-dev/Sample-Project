<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid" style="display: flex; flex-direction: row; justify-content: space-between;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Profile') }}
            </h2>
            <div>
                <a class="nav-item" href="{{ route('company.index') }}">Companies</a>
                <a class="nav-item">Employees</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                    <form method="POST" action="{{ route('profile.update', ['user' => auth()->user()->id]) }}">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="name" class="form-label">Full Name</label>
                            </div>
                            <div class="col-sm-10 text-left">
                                <input type="text" class="form-control w-50" id="nameInput" name="name" value="{{ auth()->user()->name }}" />
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-2">
                                <label for="email" class="form-label">Email address</label>
                            </div>
                            <div class="col-sm-10 text-left">
                                <input type="text" class="form-control w-50" id="email" name="email" aria-describedby="emailHelp" value="{{ auth()->user()->email }}" />
                            </div>
                        </div>
                        <hr class="mt-4 mb-4">
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary bg-primary btn-lg">Update Profile</button>
                            </div>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
