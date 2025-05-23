@extends('layouts.app')

@section('content')
    <h1>Add New Contact</h1>
    <form action="{{ route('contacts.store') }}" method="POST" class="form">
        @csrf
        <div class="form-group">
            <label for="contact_name">Contact Name</label>
            <input name="contact_name" id="contact_name" type="text" value="{{ old('contact_name') }}" class="">
            @error('contact_name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Contact Email</label>
            <input name="email" id="email" type="email" value="{{ old('email') }}" class="">
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone_number">Contact Phone</label>
            <input name="phone_number" id="phone_number" type="text" value="{{ old('phone_number') }}" class="">
            @error('phone_number')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Save Contact</button>
    </form>
@endsection