    <x-app-layout>
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Dashboard') }}
                <br>
                Hi, <b>{{ Auth::user()->name }}</b>!
                <div class="p-4 text-center text-green-500 "><b>Total users: {{ count($users) }}</b></div>
            </h2>
        </x-slot>

        <div class="py-12">
      <div class="container">
            <div class="row">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Nr</th>
          <th scope="col">Nume</th>
          <th scope="col">Email</th>
          <th scope="col">Data</th>
        </tr>
      </thead>
      <tbody>

        @php($i=1)
        @foreach ($users as $user)
            <tr>
            <th scope="row">{{ $i++ }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at->diffForHumans() }}</td>
            </tr>
        @endforeach

      </tbody>
    </table>
            </div>
                    <div class="row">
                        <!-- Search Widget -->
        <div class="my-4 card">
            <h5 class="card-header">Search</h5>
            <form class="card-body" action="/search" method="GET" role="search">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for..." name="q">
                    <span class="input-group-btn">
                <button class="btn btn-secondary" type="submit">Go!</button>
              </span>
                </div>
            </form>
        </div>
                      </div>
            
        </div>
        </div>
    </x-app-layout>
