@php($title = !empty($product) ? $product->name : 'Novo Produto')

@extends("layouts.admin", [
    "title" => $title,
    "breadcrumb" => [
        [ "label" => "Produtos", "route" => "product.index" ],
        [ "label" => $title ]
    ]
])

@section('main')
    <x-form.model route="product" :model="$product ?? null" enctype="multipart/form-data"/>

        <div class="form-group row">
            <div class="col-md-9 offset-md-2">
                {!! Form::checkbox('featured', 1, old('featured', isset($product) && !!$product->featured )) !!}
                {!! Form::label('featured', 'Em destaque') !!}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-9 offset-md-2">
                {!! Form::checkbox('active', 1, old('active', !isset($product) || !!$product->active )) !!}
                {!! Form::label('active', 'Ativo') !!}
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nome *</label>
            <div class="col-md-9">
                <x-form.input name="name" placeholder="Nome" autofocus :model="$product ?? null" />
            </div>
        </div>

        <div class="form-group row">
            {!! Form::label(null, 'Imagem *', ["class" => "col-sm-2 col-form-label"]) !!}
            <div class="col-md-9">
                @if( isset($product) && $product->image)
                    <div>
                        <img class="img-fluid w-25 img-bordered" src="{{ $product->image->urlLarge }}" alt="{{ $product->image->filename }}">
                    </div>
                @endif
                {!! Form::file('image') !!}
            </div>
        </div>

        <div class="form-group row">
            {!! Form::label('description', 'Descrição', ["class" => "col-sm-2 col-form-label"]) !!}
            <div class="col-md-9">
                <x-form.textarea name="description" :model="$product ?? null" />
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Categorias *</label>
            <div class="col-md-9">
                {!! Form::select(
                    'categories[]',
                    $categories,
                    isset($product) ? $product->categories->pluck('id')->all() : null,
                    ['class' => $errors->has('categories') ? 'form-control @errror is-invalid' : 'form-control', 'multiple']
                ) !!}
            </div>
        </div>

        <x-form.errors />

        <div class="form-group row mb-0">
            <div class="col-md-9 offset-md-2">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Salvar
                </button>

                <a class="btn btn-warning ml-2" href="{{ route('product.index') }}">
                    <i class="fa fa-undo"></i> Voltar à listagem
                </a>
            </div>
        </div>

    <x-form.endModel />

    @if(!empty($product))
        <div class="text-right">
            <form action="{{ route('product.destroy',$product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash"></i> Deletar
                </button>
            </form>
        </div>
    @endif
@endsection
