@php($title = !empty($slider) ? $slider->title : 'Novo Slide')

@extends("layouts.admin", [
    "title" => $title,
    "breadcrumb" => [
        [ "label" => "Sliders", "route" => "slider.index" ],
        [ "label" => $title ]
    ]
])

@section('main')
    <x-form.model route="slider" :model="$slider ?? null" enctype="multipart/form-data"/>

        <div class="form-group row">
            <div class="col-md-9 offset-md-2">
                {!! Form::checkbox('active', 1, old('active', !isset($slider) || !!$slider->active )) !!}
                {!! Form::label('active', 'Ativo') !!}
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Título *</label>
            <div class="col-md-9">
                <x-form.input name="title" placeholder="Título" autofocus :model="$slider ?? null" />
            </div>
        </div>

        <div class="form-group row">
            {!! Form::label(null, 'Imagem *', ["class" => "col-sm-2 col-form-label"]) !!}
            <div class="col-md-9">
                @if( isset($slider) && $slider->image)
                    <div>
                        <img class="img-fluid w-25 img-bordered" src="{{ $slider->urlLarge }}" alt="{{ $slider->title }}">
                    </div>
                @endif
                {!! Form::file('image') !!}
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Url</label>
            <div class="col-md-9">
                <x-form.input name="url" placeholder="Url do slide" :model="$slider ?? null" />
            </div>
        </div>

            <div class="form-group row">
            <label class="col-sm-2 col-form-label">Data de início</label>
            <div class="col-md-9">
                <x-form.input type="datetime-local" name="start_at" placeholder="Data de início" :model="$slider ?? null" />
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Data final</label>
            <div class="col-md-9">
                <x-form.input type="datetime-local" name="end_at" placeholder="Data final" :model="$slider ?? null" />
            </div>
        </div>

        <div class="form-group row">
            {!! Form::label('description', 'Descrição', ["class" => "col-sm-2 col-form-label"]) !!}
            <div class="col-md-9">
                <x-form.textarea name="description" :model="$slider ?? null" />
            </div>
        </div>


        <x-form.errors />

        <div class="form-group row mb-0">
            <div class="col-md-9 offset-md-2">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Salvar
                </button>

                <a class="btn btn-warning ml-2" href="{{ route('slider.index') }}">
                    <i class="fa fa-undo"></i> Voltar à listagem
                </a>
            </div>
        </div>

    <x-form.endModel />

    @if(!empty($slider))
        <div class="text-right">
            <form action="{{ route('slider.destroy',$slider->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash"></i> Deletar
                </button>
            </form>
        </div>
    @endif
@endsection
