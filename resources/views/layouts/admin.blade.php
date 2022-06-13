@extends('adminlte::page')

@section('css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
@endsection

@section('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    @if(!empty($breadcrumb))
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb bg-transparent">
                                @foreach($breadcrumb as $item)
                                    @if($loop->last)
                                        <li class="breadcrumb-item active" aria-current="page">{!! strip_tags(\Illuminate\Support\Str::markdown($item['label'], ['html_input' => 'strip' ])) !!}</li>
                                    @else
                                        <li class="breadcrumb-item" aria-current="page">
                                            <a href="{{ route($item['route']) }}">
                                                {!! strip_tags(\Illuminate\Support\Str::markdown($item['label'], [ 'html_input' => 'strip' ])) !!}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ol>
                        </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        @if(!empty($title))
            <div class="card-header">
                <h3 class="card-title">{!! \Illuminate\Support\Str::markdown($title) !!}</h3>
            </div>
        @endif

        <div class="card-body">
            <div class="row">
                <div class="col-12 text-center">
                    @include('flash::message')
                </div>
            </div>

            @yield('main')

        </div>
    </div>
@endsection
