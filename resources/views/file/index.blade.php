@extends("layouts.admin", [
    "title" => "Listagem de Images",
    "breadcrumb" => [
        [ "label" => "Images" ]
    ]
])

@section('main')

    <div class="row">
        <div class="col-md-6">
            <x-admin.index-form-search route="file.index" />
        </div>

        <div class="col-md-6 text-right">
            <a href="{{ route("file.create") }}" class="btn btn-info">
                <i class="fa fa-plus"></i> Nova Imagem
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Imagem</th>
                <th>Descrição</th>
                <th class="text-right">Ações</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($files as $file)
                <tr>
                    <td>{{ $file->id }}</td>
                    <td>
                        @if($file->filename)
                            <img src="{{ $file->url }}" class="img-size-64" alt="{{ $file->urlThumbnail }}" />
                        @endif
                    </td>
                    <td>{{ $file->description }}</td>
                    <td class="text-right">
                        <a class="btn btn-success btn-sm" href="{{ route('file.edit', $file->id) }}">
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

        {!! $files->links() !!}

    </div>
@endsection
