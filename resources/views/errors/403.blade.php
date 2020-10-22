@extends('errors::minimal')

@section('title', __('Prohibido'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'No esta permitido realizar esta accion'))
