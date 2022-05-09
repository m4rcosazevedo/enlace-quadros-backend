@extends("layouts.admin", [
    "title" => "Listagem de Produtos",
    "breadcrumb" => [
        [ "label" => "Produtos" ]
    ]
])

@section('main')

    <div class="row">
        <div class="col-md-6">
            <x-admin.index-form-search route="product.index" />
        </div>

        <div class="col-md-6 text-right">
            <a href="{{ route("product.create") }}" class="btn btn-info">
                <i class="fa fa-plus"></i> Novo Produto
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Imagem</th>
                <th>Nome</th>
                <th>Categorias</th>
                <th>Em destaque</th>
                <th>Ativo</th>
                <th class="text-right">Ações</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        @if($product->image)
                            <img src="{{ url('storage/' . $product->image) }}" class="img-size-64" />
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>
                        @foreach($product->categories as $cat)
                            {{ $cat->name }}
                            @if(!$loop->last), @endif
                        @endforeach
                    </td>
                    <td><x-active active="{{ $product->featured }}" /></td>
                    <td><x-active active="{{ $product->active }}" /></td>
                    <td class="text-right">
                        <a class="btn btn-success btn-sm" href="{{ route('product.edit', $product->id) }}">
                            <i class="fa fa-edit"></i> Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        <div class="alert alert-danger text-center">
                            <i class="fa fa-exclamation-triangle"></i>
                            Oops... nenhum registro encontrado!
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {!! $products->links() !!}

    </div>
@endsection
