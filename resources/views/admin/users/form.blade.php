@if(isset($model))
    {!! Form::model($model, ['method' => 'PATCH', 'files' => true, 'class' => 'form', 'route' => ['admin::users::update', $model->id]]) !!}
@else
    {!! Form::open(['class' => 'form', 'files' => true, 'route' => 'admin::users::store']) !!}
@endif
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control input input-line input-block']) !!}
    {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
</div>
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control input input-line input-block']) !!}
    {!! $errors->first('email', '<div class="text-danger">:message</div>') !!}
</div>
<div class="form-group">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control input input-line input-block']) !!}
    {!! $errors->first('password', '<div class="text-danger">:message</div>') !!}
</div>
<div class="form-group">
    {!! Form::label('role', 'Role:') !!}
    {!! Form::select('role', $roles, isset($role) ? $role : null, ['class' => 'form-control input input-line input-block']) !!}
    {!! $errors->first('role', '<div class="text-danger">:message</div>') !!}
</div>
<div class="form-group">
    {!! Form::submit(isset($model) ? 'Update' : 'Save', ['class' => 'button button-primary centered']) !!}
</div>
{!! Form::close() !!}