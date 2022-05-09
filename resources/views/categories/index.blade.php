@extends("layouts.admin", [
    "title" => "Listagem de Categorias",
    "breadcrumb" => [
        [ "label" => "Categorias" ]
    ]
])

@section('main')

    <div class="row">
        <div class="col-md-6">
            <x-admin.index-form-search route="category.index" />
        </div>

        <div class="col-md-6 text-right">
            <a href="{{ route("category.create") }}" class="btn btn-info">
                <i class="fa fa-plus"></i> Nova Categoria
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Categoria Pai</th>
                <th>Ordem</th>
                <th class="text-right">Ações</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->parent?->name }}</td>
                    <td>{{ $category->position }}</td>
                    <td class="text-right">
                        <a class="btn btn-success btn-sm" href="{{ route('category.edit', $category->id) }}">
                            <i class="fa fa-edit"></i> Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        <div class="alert alert-danger text-center">
                            <i class="fa fa-exclamation-triangle"></i>
                            Oops... nenhum registro encontrado!
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {!! $categories->links() !!}

    </div>
@endsection
