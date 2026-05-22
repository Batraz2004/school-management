@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))

@section('content')
    <div class="text-center mt-4">
        <a href="{{ url('/') }}" class="btn btn-primary">
            {{ __('Go to homepage') }}
        </a>
    </div>
@endsection