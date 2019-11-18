@extends('admin.layouts.master')

@section('content')

    {{--Manage Ministries--}}

    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Manage Ministries</h5>
       {!! Fam::getPanelOptions() !!}
        </div>

        <div class="card-body">
            Manage All Ministries Here
        </div>

        <table class="table datatable-basic">
            <thead>
            <tr>
                <th>#</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Code</th>
                <th>Verified</th>
                <th>HQ</th>
                <th>Location</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rcms->get() as $min)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><img style="max-width: 48px;" src="{{ $min->photo }}" alt="{{ $min->name }}"></td>
                    <td><a target="_blank" href="{{ $min->url }}">{{ $min->name }}</a></td>
                    <td>{{ $min->code }}</td>

                    {{--Verification Status--}}
                    <td>
                        <button data-url="{{ route('cj_verify_min', $min->id) }}" data-verified="{{ $min->verified }}" type="button" class="verify-btn btn {{ ($min->verified) ? 'btn-success' : 'btn-danger' }} btn-icon"> {!! ($min->verified) ? "<i class='icon-check'></i>" : "<i class='icon-x'></i>" !!} </button>
                    </td>

                    {{--HQ--}}
                    <td>
                        <button data-url="{{ route('cj_set_hq', $min->id) }}" data-hq="{{ $min->hq }}" type="button" class="hq-btn btn {{ ($min->hq) ? 'btn-primary' : 'btn-dark' }} btn-icon"> {!! ($min->hq) ? "<i class='icon-home'></i>" : "<i class='icon-x'></i>" !!} </button>
                    </td>

                    <td>{{ $min->state.' '.$min->country }}</td>

                    <td class="text-center">
                    <div class="list-icons">
                        <div class="dropdown">
                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ route('cj_edit_min', $min->id) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                <a href="#" data-url="{{ route('cj_delete_min', $min->id) }}" data-id="{{ $min->id }}" class="dropdown-item delete-item"><i class="icon-trash"></i> Delete</a>
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

@section('scripts')
    <script>

        /* Toggle Verification for Ministries */
        $('.verify-btn').on('click', function () {
            let url = $(this).data('url');
            let verified = $(this).data('verified');
            let verify_class = verified ? 'btn btn-danger btn-icon' : 'btn btn-success btn-icon';
            let newVerifiedStatus = verified ? 0 : 1;
            let newVerifiedText = verified ? "<i class='icon-x'></i>" : "<i class='icon-check'></i>";
            $(this).removeClass().addClass(verify_class).html(newVerifiedText).data('verified', newVerifiedStatus);
            $.get(url, function () {
                flashSuccess('Verification set successfully');
            });
        });

        /* Toggle HQ status for Ministries */
        $('.hq-btn').on('click', function () {
            let url = $(this).data('url');
            let hq = $(this).data('hq');
            let hq_class = hq ? 'btn btn-dark btn-icon' : 'btn btn-primary btn-icon';
            let newHQStatus = hq ? 0 : 1;
            let newHQText = hq ? "<i class='icon-x'></i>" : "<i class='icon-home'></i>";
            $(this).removeClass().addClass(hq_class).html(newHQText).data('hq', newHQStatus);
            $.get(url, function () {
                flashSuccess('Headquarters set successfully');
            });
        });

    </script>
@endsection
