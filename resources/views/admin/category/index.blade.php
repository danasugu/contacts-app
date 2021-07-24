<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
            <br>
            Hi, <b>{{ Auth::user()->name }}</b>!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="card-header">
                        All categories
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nr</th>
                                    <th scope="col">Categorie</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i=1)
                                @foreach($categories as $category)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td> {{ $category->category_name }} </td>
                                        <td> {{ $category->user_id }} </td>
                                        
                                        <td>
                                            @if($category->created_at == NULL) //solved error if NULL column
                                            <span class="text-danger">No data available</span>
                                                @else
                                            {{ $category->created_at->diffForHumans() }} 
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach    
                            </tbody>
                        </table>
                    </div>


                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add Categories</div>
                        <div class="card-body">
                            <form action="{{ route('store.category') }}" method="POST">
                              @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Category Name</label>
                                    <input type="text" name="category_name" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text">
                                      @error('category_name')     
                                      <span class="text-danger">{{ $message }}</span>                                   
                                      @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Category</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
