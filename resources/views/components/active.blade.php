@php($active ??= false)

<div class="text-center">
    @if($active)
        <div class="text-success">
            <i class="fas fa-check"></i>
        </div>
    @else
        <div class="text-danger">
            <i class="fas fa-times"></i>
        </div>
    @endif
</div>
