@extends('adminlte::page')

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
                                        <li class="breadcrumb-item active" aria-current="page">{{ $item['label'] }}</li>
                                    @else
                                        <li class="breadcrumb-item" aria-current="page">
                                            <a href="{{ route($item['route']) }}">
                                                {{ $item['label'] }}
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
                <h3 class="card-title">{{ $title }}</h3>
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
