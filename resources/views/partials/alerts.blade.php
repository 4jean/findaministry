@if($errors->any())
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="alert alert-danger text-center">
                <ul>
                    @foreach($errors->all() as $er)
                        <li>{{ $er }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

@if (session('flash_info'))
    {!! Fam::showAlert('info', session('flash_info')) !!}
@endif

@if (session('flash_success'))
    {!!  Fam::showAlert('success', session('flash_success'))  !!}
@endif

@if (session('flash_warning'))
    {!! Fam::showAlert('warning', session('flash_warning')) !!}
@endif

@if (session('flash_danger'))
    {!! Fam::showAlert('danger', session('flash_danger')) !!}
@endif