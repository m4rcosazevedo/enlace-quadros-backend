@extends("layouts.admin", [
    "title" => "Listagem de Newsletters",
    "breadcrumb" => [
        [ "label" => "Newsletters" ]
    ]
])

@section('main')

    <div class="row">
        <div class="col-md-6">
            <x-admin.index-form-search route="newsletter.index" />
        </div>

        <div class="col-md-6 text-right">
            <a href="{{ route("newsletter.create") }}" class="btn btn-info">
                <i class="fa fa-plus"></i> Nova Newsletter
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ativo</th>
                <th>Data Criação</th>
                <th class="text-right">Ações</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($newsletters as $newsletter)
                <tr>
                    <td>{{ $newsletter->id }}</td>
                    <td>{{ $newsletter->name }}</td>
                    <td>{{ $newsletter->email }}</td>
                    <td><x-active active="{{ $newsletter->active }}" /></td>
                    <td>{{ $newsletter->created }}</td>
                    <td class="text-right">
                        <a class="btn btn-success btn-sm" href="{{ route('newsletter.edit', $newsletter->id) }}">
                            <i class="fa fa-edit"></i> Editar
                        </a>
                    </td>
                </tr>
            @empty
                <x-admin.no-records colspan="6" />
            @endforelse
            </tbody>
        </table>

        {!! $newsletters->links() !!}

    </div>
@endsection
