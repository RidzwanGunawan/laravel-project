@extends('layouts.app')

@section('title', 'Index user')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List User</h1>
        <a href="{{route ('users.create') }}">Tambah User</a>
    </div>
    <hr />
<!-- Untuk Message Success -->
    @if(Session::has('success'))
    <div class="alert alert-succees" role="alert">
        {{Session::get('success')}}
    </div>
    @endif

    <table class="table table-hover" >
        <thead class="table-dark">
            <tr>
                <th class="text-white">nomor</th>
                <th class="text-white">nama</th>
                <th class="text-white">email</th>
                <th class="text-white">level</th>
                @if (auth()->user()->level == 'Admin')
                <th class="text-white">Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>+
            @if($user->count() > 0)
                @foreach($user as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $rs->name }}</td>
                        <td class="align-middle">{{ $rs->email }}</td>
                        <td class="align-middle">{{ $rs->level }}</td>
                        
                        <td class="align-middle">
                            @if (auth()->user()->level == 'Admin')
                            <div class="btn-group">
                                <a href="{{ route('users.show', $rs->id) }}" type="button" class="btn btn-primary">Show</a>
                                <a href="{{ route('users.edit', $rs->id) }}" type="button" class="btn btn-secondary">Edit</a>
                                <form action="{{ route('users.destroy', $rs->id) }}" method="POST" type="button" class="btn btn-danger" onsubmit="return confirm('Delete?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger text-white">Delete</button>
                                </form>
                            </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="5">User Not Found</td>
                </tr>
            @endif
        </tbody>
    </table>

@endsection