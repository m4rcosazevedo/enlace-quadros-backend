@extends("layouts.admin")

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-2">
                <h1 class="m-0">Dashboard</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <x-admin.dashboard-cardbox
                    count="{{ $productsActives }}"
                    color="success"
                    title="Produtos ativos"
                    icon="fa-shopping-bag"
                />
            </div>
            <div class="col-lg-3 col-6">
                <x-admin.dashboard-cardbox
                    count="{{ $products }}"
                    color="primary"
                    title="Produtos cadastrados"
                    icon="fa-shopping-bag"
                />
            </div>
            <div class="col-lg-3 col-6">
                <x-admin.dashboard-cardbox
                    count="{{ $newsletterActives }}"
                    color="warning"
                    title="Newsletters ativas"
                    icon="fa-mail-bulk"
                />
            </div>
            <div class="col-lg-3 col-6">
                <x-admin.dashboard-cardbox
                    count="{{ $newsletter }}"
                    color="danger"
                    title="Newsletter cadastradas"
                    icon="fa-mail-bulk"
                />
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-3 col-6">
                <x-admin.dashboard-cardbox
                    count="{{ $categories }}"
                    color="info"
                    title="Categorias"
                    icon="fa-tags"
                />
            </div>

            <div class="col-lg-9 col-12">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Produtos recentes</h3>
                            </div>
                            <div class="card-body">
                                <div class="products-list products-list-in-card">
                                    @foreach($lastProducts as $product)
                                        <div class="item">
                                            <div class="product-img">
                                                <img src="{{ url("storage/{$product->image}") }}" alt="{{ $product->name  }}" class="img-size-64">
                                            </div>
                                            <div class="product-info">
                                                <a class="product-title" href="{{ route('product.edit', $product->id) }}">
                                                    {{ $product->name }}
                                                </a>
                                                <span class="product-description">
                                                    @foreach($product->categories as $cat)
                                                        {{ $cat->name }}@if(!$loop->last), @endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Últimas newsletters</h3>
                            </div>
                            <div class="card-body">
                                <div class="products-list products-list-in-card">
                                    @foreach($lastNewsletters as $newsletter)
                                        <div class="item">
                                            <a class="product-title" href="{{ route('newsletter.edit', $newsletter->id) }}">
                                                {{ $newsletter->email }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>
@endsection
