@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">RSVP for {{ $guest->event->name }}</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('guests.process-rsvp', $guest) }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Will you be attending?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status_confirmed" value="confirmed" {{ $guest->status === 'confirmed' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_confirmed">
                                    Yes, I will attend
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status_declined" value="declined" {{ $guest->status === 'declined' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_declined">
                                    No, I cannot attend
                                </label>
                            </div>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
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

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Submit RSVP</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 