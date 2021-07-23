<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
            <br>
            Hi, <b>{{ Auth::user()->name }}</b>!
            <div class="text-center text-green-500 p-4 "><b>Total users: {{ count($users) }}</b></div>
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
    </div>
    </div>
</x-app-layout>
