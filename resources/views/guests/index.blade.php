@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Guest List for {{ $event->name }}</h3>
                    <a href="{{ route('events.guests.create', $event) }}" class="btn btn-primary">Add Guest</a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Dietary Preferences</th>
                                    <th>Special Requests</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($guests as $guest)
                                    <tr>
                                        <td>{{ $guest->name }}</td>
                                        <td>{{ $guest->email }}</td>
                                        <td>{{ $guest->phone }}</td>
                                        <td>
                                            <span class="badge bg-{{ $guest->status === 'confirmed' ? 'success' : ($guest->status === 'declined' ? 'danger' : 'warning') }}">
                                                {{ ucfirst($guest->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $guest->dietary_preferences }}</td>
                                        <td>{{ $guest->special_requests }}</td>
                                        <td>
                                            <a href="{{ route('events.guests.edit', [$event, $guest]) }}" class="btn btn-sm btn-info">Edit</a>
                                            <form action="{{ route('events.guests.destroy', [$event, $guest]) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 