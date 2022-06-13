@php($action = $model ? 'edit' : 'store')
@php($id ??= $route . '-' . $action)

<form id="create-edit-form" method="POST" action="{{ route($route . '.' . $action, $model) }}" {{ $attributes }}>
@method($model ? 'PUT' : 'POST')
@csrf
