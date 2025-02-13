@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dashboard</h1>

        <!-- Display search query and type if provided -->
        @if(session('search_query') && session('user_type'))
            <p>Showing results for <strong>{{ session('search_query') }}</strong> as <strong>{{ session('user_type') }}</strong></p>
            <!-- Display relevant search results here based on user type -->
        @else
            <p>Welcome to the Dashboard!</p>
        @endif
    </div>
@endsection
