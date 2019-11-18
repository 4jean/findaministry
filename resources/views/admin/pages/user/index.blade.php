@extends('admin.layouts.master')

@section('content')

    {{--Manage Users--}}

    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Manage Users</h5>
            {!! Fam::getPanelOptions() !!}
        </div>

        <div class="card-body">
            Manage All Users Here
        </div>

        <table class="table datatable-basic">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Verified</th>
                <th>Created</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>

            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>

                    {{-- Email Verification Status--}}
                    <td>
                        <button type="button" class="btn {{ ($user->email_verified_at) ? 'btn-success' : 'btn-danger' }} btn-icon"> {!! ($user->email_verified_at) ? "<i class='icon-check'></i>" : "<i class='icon-x'></i>" !!} </button>
                    </td>
                    <td>{{ $user->created_at->diffForHumans() }}</td>

                    <td class="text-center">
                        <div class="list-icons">
                            <div class="dropdown">
                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="#" data-url="{{ route('cj_delete_user', $user->id) }}" data-id="{{ $user->id }}" class="dropdown-item delete-item"><i class="icon-trash"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>

@endsection
