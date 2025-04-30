@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Customized Invitations</div>

                <div class="card-body">
                    @if($invitations->isEmpty())
                        <p>You haven't customized any invitations yet.</p>
                    @else
                        <div class="list-group">
                            @foreach($invitations as $invitation)
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-1">{{ $invitation->template->name }}</h5>
                                        <small class="text-muted">{{ $invitation->created_at->format('M d, Y') }}</small>
                                    </div>
                                    <p class="mb-1">Customized with your details</p>
                                    <div class="mt-2">
                                        <a href="{{ url('/invitation-templates/' . $invitation->id) }}" class="btn btn-sm btn-primary">View</a>
                                        <a href="{{ route('invitation-templates.edit', $invitation->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 