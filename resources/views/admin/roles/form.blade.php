<div class="form-group">
    {!! Form::label('name', 'Название роли:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::label('slug', 'Alias роли:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
    {!! $errors->first('slug', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Описание:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    {!! $errors->first('description', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::label('permissions', 'Привилегии:') !!}
    {!! Form::select('permissions[]', $permissions, isset($permission_role) ? $permission_role : null, ['multiple' => 'multiple', 'class' => 'form-control']) !!}
    {!! $errors->first('permissions', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::submit(isset($model) ? 'Обновить' : 'Сохранить', ['class' => 'btn btn-primary']) !!}
</div>