@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>

    <!-- Search Form -->
    <form method="GET" action="{{ route('dashboard.show') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
            <select name="user_type" class="form-select">
                <option value="investee" {{ request('user_type') == 'investee' ? 'selected' : '' }}>Investees</option>
                <option value="investor" {{ request('user_type') == 'investor' ? 'selected' : '' }}>Investors</option>
                <option value="banker" {{ request('user_type') == 'banker' ? 'selected' : '' }}>Bankers</option>
            </select>
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    <!-- Display Search Results -->
    @if ($results->isEmpty())
        <p>No results found for "{{ $searchQuery }}".</p>
    @else
        <h3>Search Results:</h3>
        <ul class="list-group">
            @foreach ($results as $result)
                <li class="list-group-item">
                    <strong>{{ $result->name }}</strong><br>
                    <!-- Additional details based on user type -->
                    @if ($userType == 'investee')
                        Sector: {{ $result->sector }}
                    @elseif ($userType == 'investor')
                        Investment Focus: {{ $result->investment_focus }}
                    @elseif ($userType == 'banker')
                        Field of Specialization: {{ $result->field_of_specialization }}
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
