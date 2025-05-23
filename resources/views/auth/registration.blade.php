@extends('layouts.app');

@section('content')

<form class="form form--register" method="POST" action="{{route('register')}}">
@csrf
<div class="form__inputs">

    <div class="form__group">
        <label for="email" class="form__label">Email</label>
        <input type="email" name="email" class="form__input @error('email')
        form__input--error
        @enderror">
        @error('email')
            <div class="form__error">{{$message}}</div>
        @enderror
    </div>

    <div class="form__group">
        <label for="password" class="form__label">Password</label>
        <input type="password" name="password" class="form__input @error('password')
            form__input--error
        @enderror">
             @error('password')
            <div class="form__error">{{$message}}</div>
        @enderror
    </div>

</div>

<div class="form__actions">

    <button type="submit" class="form__button form__button--primary">Sign up</button>

    <a href="{{route('login')}}" class="form__signinlink">Already have an account? Sign in here</a>
</div>

</form>