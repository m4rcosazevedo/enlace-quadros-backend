@php($title = !empty($category) ? $category->name : 'Nova Categoria')

@extends("layouts.admin", [
    "title" => $title,
    "breadcrumb" => [
        [ "label" => "Categorias", "route" => "category.index" ],
        [ "label" => $title ]
    ]
])

@section('main')
    <x-form.model route="category" :model="$category ?? null" />

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nome *</label>
            <div class="col-md-9">
                <x-form.input name="name" placeholder="Nome" autofocus :model="$category ?? null" />
                <x-form.error field="name" :model="$category ?? null"/>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Descrição</label>
            <div class="col-md-9">
                <x-form.textarea name="description" :model="$category ?? null" />
                <x-form.error field="description" :model="$category ?? null"/>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Posição *</label>
            <div class="col-md-9">
                <x-form.input name="position" placeholder="Posição" type="number" min="0" max="99" maxlength="2" value="0" :model="$category ?? null"/>
                <x-form.error field="position" :model="$category ?? null"/>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Categoria pai *</label>
            <div class="col-md-9">
                <select class="form-control" name="category_id">
                    <option value="">Sem categoria pai</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ !empty($category) && $cat->id === $category->category_id ? 'selected' : null }}>{{ $cat->name }} {{ $cat->parent ? " - ({$cat->parent->name})" : '' }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-9 offset-md-2">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Salvar
                </button>

                <a class="btn btn-warning ml-2" href="{{ route('category.index') }}">
                    <i class="fa fa-undo"></i> Voltar à listagem
                </a>
            </div>
        </div>

    <x-form.endModel />

    @if(!empty($category))
        <div class="text-right">
            <form action="{{ route('category.destroy',$category->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash"></i> Deletar
                </button>
            </form>
        </div>
    @endif
@endsection
