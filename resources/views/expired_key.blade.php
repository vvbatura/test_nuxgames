@extends('layouts.app')

@section('content')

    <div>
        <h2>{{ __('ExpiredKey') }}</h2>

        <h3>{{ __('Key') . ' - ' . $link->key . __('Expired') }}</h3>
    </div>

@endsection
