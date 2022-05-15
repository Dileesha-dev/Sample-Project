<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid" style="display: flex; flex-direction: row; justify-content: space-between;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{$company->name }}
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
                    <div class="card">
                        <div class="row">
                            <div class="col-sm-2">
                                @if ($company->logo_url)
                                    <img class="card-img-top" src="{{$company->logo_url}}" alt="Image failed to load" style="max-height: 150px" width="150px">
                                @else
                                    <img class="card-img-top" src="https://caminofires.co.za/wp-content/uploads/2019/10/unavailable-image.jpg" alt="Image failed to load" style="max-height: 160px" width="230px">
                                @endif
                            </div>
                            <div class="col-sm-10">
                                <div class="card-body text-left">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <p class="card-text my-1">Name: {{$company->name}}</p>
                                            <p class="card-text my-1">email: {{$company->email}}</p>
                                            <p class="card-text my-1">telephone: {{$company->telephone}}</p>
                                            <p class="card-text my-1">website: <a href="{{$company->website}}" style="color:  #0000EE">{{$company->website}}</a></p>
                                        </div>
                                        <div class="col-sm-2 text-center">
                                            <a class="btn btn-info text-white m-3" href="{{ route('company.edit', ['id' => $company->id]) }}">Edit</a>
                                            <form action="{{ route('company.delete', ['id' => $company->id]) }}" method="post">@csrf @method('delete')<button class="btn btn-danger">Delete</button></form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="display: flex; flex-wrap: wrap; justify-content: space-around">
                            @foreach ($company->covers as $cover)
                                <img src="{{$cover->cover_url}}" style="max-height: 300px; margin-top: 20px" />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
