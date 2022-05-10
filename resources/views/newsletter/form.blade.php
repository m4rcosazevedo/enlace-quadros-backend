@php($title = !empty($newsletter) ? $newsletter->name : 'Nova Newsletter')

@extends("layouts.admin", [
    "title" => $title,
    "breadcrumb" => [
        [ "label" => "Newsletters", "route" => "newsletter.index" ],
        [ "label" => $title ]
    ]
])

@section('main')
    <x-form.model route="newsletter" :model="$newsletter ?? null" />

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nome *</label>
            <div class="col-md-9">
                <x-form.input name="name" placeholder="Nome" autofocus :model="$newsletter ?? null" />
                <x-form.error field="name" :model="$newsletter ?? null"/>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Email *</label>
            <div class="col-md-9">
                <x-form.input name="email" placeholder="Email" autofocus :model="$newsletter ?? null" />
                <x-form.error field="email" :model="$newsletter ?? null"/>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-9 offset-md-2">
                {!! Form::checkbox('active', 1, old('active', !isset($newsletter) || !!$newsletter->active )) !!}
                {!! Form::label('active', 'Ativo') !!}
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-9 offset-md-2">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Salvar
                </button>

                <a class="btn btn-warning ml-2" href="{{ route('newsletter.index') }}">
                    <i class="fa fa-undo"></i> Voltar à listagem
                </a>
            </div>
        </div>

    <x-form.endModel />

    @if(!empty($newsletter))
        <div class="text-right">
            <form action="{{ route('newsletter.destroy',$newsletter->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash"></i> Deletar
                </button>
            </form>
        </div>
    @endif
@endsection
