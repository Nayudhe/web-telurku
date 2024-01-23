@extends('layouts.adminDashboard')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Pesan Masuk</h1>

    @foreach ($messages as $message)
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex gap-4 justify-content-between">
                    <div>
                        <h6 class="m-0 font-weight-bold text-primary">{{ $message->sender_name }}</h6>
                        <p class="mb-0">{{ $message->sender_email }}</p>
                    </div>
                    <p>{{ Carbon\Carbon::parse($message->created_at)->translatedFormat('d F Y h:m') }}</p>
                </div>
            </div>
            <div class="card-body">
                <p>
                    {{ $message->message }}
                </p>
            </div>
        </div>
    @endforeach
    <div class="mt-4 d-flex justify-content-end">
        {{ $messages->links() }}
    </div>
@endsection
