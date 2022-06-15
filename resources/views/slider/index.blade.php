@extends("layouts.admin", [
    "title" => "Listagem de Sliders",
    "breadcrumb" => [
        [ "label" => "Sliders" ]
    ]
])

@section('main')

    <div class="row">
        <div class="col-md-6">
            <x-admin.index-form-search route="slider.index" />
        </div>

        <div class="col-md-6 text-right">
            <a href="{{ route("slider.create") }}" class="btn btn-info">
                <i class="fa fa-plus"></i> Novo Slide
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Imagem</th>
                <th>Url</th>
                <th>Data Início</th>
                <th>Data Fim</th>
                <th>Ativo</th>
                <th class="text-right">Ações</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($sliders as $slider)
                <tr>
                    <td>{{ $slider->id }}</td>
                    <td>{{ $slider->title }}</td>
                    <td>
                        @if($slider->image)
                            <img src="{{ $slider->urlThumbnail }}" class="img-size-64" alt="{{ $slider->title  }}" />
                        @endif
                    </td>
                    <td>{{ $slider->url }}</td>
                    <td>{{ $slider->start_at_text }}</td>
                    <td>{{ $slider->end_at_text }}</td>
                    <td><x-active active="{{ $slider->active }}" /></td>
                    <td class="text-right">
                        <a class="btn btn-success btn-sm" href="{{ route('slider.edit', $slider->id) }}">
                            <i class="fa fa-edit"></i> Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">
                        <div class="alert alert-danger text-center">
                            <i class="fa fa-exclamation-triangle"></i>
                            Oops... nenhum registro encontrado!
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {!! $sliders->links() !!}

    </div>
@endsection
