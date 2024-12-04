@extends('layouts.app')

@section('content')

    <div>
        <h2>{{ __('Page') . ' - ' . $link->key }}</h2>

        <div>
            <form action="{{ route('activate_new_key', $link->key) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">{{ __('Generate new Link') }}</button>
            </form>
            @if(old('link') || $errors->has('activateNewKey'))
                <div class="alert alert-primary" role="alert">
                    @if(old('link'))
                        {{ __('This is new Link') . ' - ' .  route('page', old('link')) }}
                    @endif
                    @if ($errors->has('activateNewKey'))
                        <div class="error-message">
                            {{ $errors->first('activateNewKey') }}
                        </div>
                    @endif
                </div>
            @endif
        </div>
        <div>
            <form action="{{ route('deactivate_key', $link->key) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-dark">{{ __('Deactivate this Link') }}</button>
            </form>
            @if ($errors->has('deactivateKey'))
                <div class="alert alert-dark" role="alert">
                    <div class="error-message">
                        {{ $errors->first('deactivateKey') }}
                    </div>
                </div>
            @endif
        </div>
        <div>
            <form action="{{ route('create_game', $link->key) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-warning">{{ __('Imfeelinglucky') }}</button>
            </form>
            @if(old('game') || $errors->has('game'))
                <div class="alert alert-warning" role="alert">
                    @if($game = old('game'))
                        <h3>{{ __('Your game') }}</h3>
                        <div>
                            {{ __('Number') . ' - ' . $game['number'] . '; ' . __($game['win'] ? 'Win' : 'Lose') . '; ' . __('Sum') . ' - ' . $game['sum'] }}
                        </div>
                    @endif
                    @if ($errors->has('game'))
                        <div class="error-message">
                            {{ $errors->first('game') }}
                        </div>
                    @endif
                </div>
            @endif
        </div>
        <div>
            <form action="{{ route('get_games', $link->key) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">{{ __('History ') }}</button>
            </form>
            @if (old('games', []))
                <div class="alert alert-success" role="alert">
                    <h3>{{ __('History oldest games') }}</h3>
                    @foreach(old('games', []) as $game)
                        <div>
                            {{ __('Number') . ' - ' . $game['number'] . '; ' . __($game['win'] ? 'Win' : 'Lose') . '; ' . __('Sum') . ' - ' . $game['sum'] }}
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

    <style>
        button {
            margin: 5px;
        }
        .error-message {
            color: red;
        }
    </style>

@endsection
