@extends('layouts.front.master')

@section('bc', Breadcrumbs::render('my_ministries') )

@section('content')
    <div class="container">
        <div class="row">
           {{-- <!-- sidebar -->--}}
            <div class="col-md-3 col-sm-2">
        @include('pages.user.menu')
            </div>
            <div class="col-md-9 col-sm-10">
                <section id="my-properties">
                    <header><h1>{{ $page_title }}</h1></header>
                    <div class="my-properties">
                        <div class="table-responsive">
                            <table class="table dt">

                                <thead>
                                <tr>
                                    <th>Ministry</th>
                                    <th>Name/Code</th>
                                    <th>Verification</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($ministries as $min)
                                    <tr>
                                        <td class="image">

                                            <a href="{{ $min->url }}"><img alt="{{ $min->name }}" src="{{ $min->photo }}" style=""></a>
                                        </td>

                                        <td>
                                            <div class="inner">
                                                <a href="{{ $min->url }}"><h2>{{ Str::limit($min->name, 30) }}
                                                      @if($min->verified)
                                                        <i title="Verified Ministry" style="color: {{ Fam::getColour('verified') }}" class="fa fa-check-circle"></i>
                                                          @endif
                                                        @if($min->hq)
                                                            <i title="Headquarters" style="color: #2b669a" class="fa fa-home"></i>
                                                            @endif
                                                    </h2></a>
                                                <figure>{{ Str::limit($min->address, 60) }}</figure>
                                                <div class="tag price">{{ $min->code }}</div>
                                            </div>
                                        </td>
                                        {{--Verify--}}
                                        <td>
                                            @if($min->verified)
                                            @if($min->page)
                                                {{--If Ministry Has A Page --}}
                                                    <i style="color: #00b208" class="fa fa-check"></i> {{ $min->page }}

                                                @else
                                                    <a class="btn btn-success" title="Verified Ministry, Create A Unique Page Name" target="_blank" href="{{ route('edit_ministry', Fam::hash($min->id)) }}"><i style="color: #fff" class="fa fa-check"></i> Choose A Page Name</a>
                                                @endif

                                                {{--Ministry Not Verified--}}
                                                @else
                                                <a target="_blank" href="{{ route('claim_ministry', Fam::hash($min->id)) }}" class="btn btn-warning">Click to Verify</a>
                                                @endif
                                        </td>
                                        {{--Actions--}}

                                        <td>
                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle" type="button"
                                                        id="dropdownMenu1" data-toggle="dropdown">
                                                    Action <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                                    <li role="presentation"><a role="menuitem" target="_blank" tabindex="-1" href="{{ $min->url }}"><i class="fa fa-eye"></i> View Ministry</a>
                                                    </li>

                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('edit_ministry', Fam::hash($min->id)) }}"><i class="fa fa-pencil"></i> Edit</a>
                                                    </li>

                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                                                    @if(!$min->verified)
                                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="fa fa-file"></i> Verify Ministry</a></li>
                                                        @endif

                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </section>


       </div>
            </div>

    </div>

    @endsection
