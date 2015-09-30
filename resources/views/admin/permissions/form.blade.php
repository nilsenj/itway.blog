<div class="form-group">
    {!! Form::label('name', 'Название Привилегии:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::label('slug', 'Alias Привилегии:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
    {!! $errors->first('slug', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Описание:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    {!! $errors->first('description', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::submit(isset($model) ? 'Обновить' : 'Сохранить', ['class' => 'btn btn-primary']) !!}
</div>