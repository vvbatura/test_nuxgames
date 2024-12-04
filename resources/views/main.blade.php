@extends('layouts.app')

@section('content')

    <div>
        <h2>{{ __('Registration') }}</h2>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">{{ __('Username') }}</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('Enter Username') }}" value="{{ old('name') }}">
                <small class="form-text text-muted error-message">{{ $errors->has('name') ? $errors->first('name') : '' }}</small>
            </div>
            <div class="form-group">
                <label for="phone">{{ __('Phonenumber') }}</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="{{ __('Enter Phonenumber') }}" value="{{ old('phone') }}">
                <small class="form-text text-muted error-message">{{ $errors->has('phone') ? $errors->first('phone') : '' }}</small>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
            </div>
        </form>
    </div>

    <style>
        button {
            margin: 10px;
        }
        .error-message {
            color: red !important;
        }
    </style>

@endsection
