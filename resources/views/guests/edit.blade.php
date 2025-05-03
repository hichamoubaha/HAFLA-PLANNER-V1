@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Guest</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('events.guests.update', [$event, $guest]) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $guest->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $guest->email) }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone', $guest->phone) }}">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="dietary_preferences" class="form-label">Dietary Preferences</label>
                            <textarea class="form-control @error('dietary_preferences') is-invalid @enderror" 
                                      id="dietary_preferences" 
                                      name="dietary_preferences" 
                                      rows="2">{{ old('dietary_preferences', $guest->dietary_preferences) }}</textarea>
                            @error('dietary_preferences')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="special_requests" class="form-label">Special Requests</label>
                            <textarea class="form-control @error('special_requests') is-invalid @enderror" 
                                      id="special_requests" 
                                      name="special_requests" 
                                      rows="2">{{ old('special_requests', $guest->special_requests) }}</textarea>
                            @error('special_requests')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" 
                                      name="notes" 
                                      rows="2">{{ old('notes', $guest->notes) }}</textarea>
                            @error('notes')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('events.guests.index', $event) }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Guest</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 