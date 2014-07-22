@extends('layouts.master')

@section('content')

<h2>Account Edit</h2>
{{ Form::open() }}

{{ Form::label('name', 'Name') }}
{{ Form::text('values['.AccountService::FIELD_NAME.']', $formData[AccountService::FIELD_NAME]) }}

{{ Form::label('email', 'Email') }}
{{ Form::text('values['.AccountService::FIELD_EMAIL.']', $formData[AccountService::FIELD_EMAIL]) }}

{{ Form::button('save', array('type'=>'submit')) }}

{{ Form::close() }}

@stop