@props(['route' => ''])

<form method="GET" action="{{ route($route) }}">
    <div class="input-group mb-3">
        <input class="form-control" name="search" value="{{ request('search') ?? '' }}" placeholder="O que você procura?" />
        <div class="input-group-append">
            <button class="btn btn-info" type="submit">
                <i class="fa fa-search"></i> Buscar
            </button>
        </div>
    </div>
</form>
