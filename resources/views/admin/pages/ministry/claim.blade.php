@extends('admin.layouts.master')

@section('content')
    {{--Select Claims Ministry--}}
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-light">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Select Claims Ministry</h5>
                    {!! Fam::getPanelOptions() !!}
                </div>

                <div class="card-body">
                <div class="col-md-6 offset-3">
                    <form id="claim-select" action="{{ route('cj_claims') }}">
                        <div class="form-group">
                            <select data-placeholder="Select Ministry" class="form-control select-search" id="ministry-id">
                                <option value=""></option>
                                @foreach($claims->pluck('ministry') as $cm)
                                    <option {{ ($selected && $cm->id === $min->id) ? 'selected' : '' }} value="{{ $cm->id }}">{{ $cm->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Claims List of Selected Ministry --}}
    @if($selected)
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Manage Claims</h5>
                {!! Fam::getPanelOptions() !!}
            </div>

            <div class="card-body">
                Manage All Claims for <a target="_blank" href="{{ $min->url }}"><strong>{{ $min->name }}</strong></a>
            </div>

            <table class="table datatable-basic">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>File</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($claims->where('ministry_id', $min->id) as $cm)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $cm->user->name }}</td>
                        <td>{{ $cm->user->email }}</td>
                        <td>{{ $cm->user->phone }}</td>
                        <td>
                            <a title="Download File" target="_blank" href="{{ route('cj_claim_download_file', $cm->id) }}" class="btn btn-dark btn-icon"> <i class='icon-download4'></i> </a>
                            <a title="View File" target="_blank" href="{{ route('cj_claim_view_file', $cm->id) }}" class="btn btn-dark btn-icon"> <i class='icon-folder-open'></i> </a>
                        </td>

                        {{-- Claim Sttaus--}}
                        <td>
                            <form method="post" action="{{ route('cj_claim_approve', $cm->id) }}">@csrf @method('PUT')
                                <button type="submit" class="btn {{ ($cm->approved) ? 'btn-success' : 'btn-danger' }} btn-icon"> {!! ($cm->approved) ? "<i class='icon-check'></i>" : "<i class='icon-x'></i>" !!} </button>
                            </form>
                        </td>
                        <td>
                            <button data-url="{{ route('cj_claim_delete', $cm->id) }}" type="submit" class="delete-item btn btn-grey-dark btn-icon"> <i class="icon-trash"></i> </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif

@endsection

@section('scripts')
    <script>
        $('select#ministry-id').on('change', function () {
            location.href=$('form#claim-select').attr('action') + '/' + $(this).val();
        })
    </script>
    @endsection
