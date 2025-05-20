@extends('layouts.app')

@section('content')
    <h1>Contact List</h1>
    <a href="{{ route('contacts.create') }}" class="btn btn-primary">Add New Contact</a>
    @if ($allContacts->isEmpty())
        <p>No contacts found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody
                @foreach ($allContacts as $contact)
                    <tr>
                        <td>{{ $contact->contact_name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone_number ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-success">Edit</a>
                            <form action="{{ route('contacts.destroy', $contact) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you wanna delete contact?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection