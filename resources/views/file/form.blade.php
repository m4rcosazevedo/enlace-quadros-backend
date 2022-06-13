@php($title = !empty($file) ? $file->description : 'Novo Arquivo')

@extends("layouts.admin", [
    "title" => $title,
    "breadcrumb" => [
        [ "label" => "Arquivos", "route" => "product.index" ],
        [ "label" => $title ]
    ]
])

@section('main')
    <x-form.model route="file" :model="$file ?? null" enctype="multipart/form-data"/>


        <div class="form-group row">
            {!! Form::label(null, 'Imagem *', ["class" => "col-sm-2 col-form-label"]) !!}
            <div class="col-md-9">
                @if( isset($file) && $file->filename)
                    <div>
                        <img class="img-fluid w-25 img-bordered" src="{{ $file->urlLarge }}" alt="{{ $file->description }}">
                    </div>
                @endif
                {!! Form::file('filename') !!}
            </div>
        </div>

        <div class="form-group row">
            {!! Form::label('description', 'Descrição *', ["class" => "col-sm-2 col-form-label"]) !!}
            <div class="col-md-9">
                <x-form.textarea name="description" :model="$file ?? null" />
            </div>
        </div>

        <x-form.errors />

        <div class="form-group row mb-0">
            <div class="col-md-9 offset-md-2">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Salvar
                </button>

                <a class="btn btn-warning ml-2" href="{{ route('file.index') }}">
                    <i class="fa fa-undo"></i> Voltar à listagem
                </a>
            </div>
        </div>

    <x-form.endModel />

    @if(!empty($file))
        <div class="text-right">
            <form action="{{ route('file.destroy',$file->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash"></i> Deletar
                </button>
            </form>
        </div>
    @endif
@endsection
