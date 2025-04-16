@extends('layouts.app')

@section('content')

<div class="container-xxl py-5">
    <div class="row justify-content-center">
        <div class="col-12">

            <!-- Page Header -->
            <div class="text-center mb-5">
                <p class="d-inline-block border border-primary rounded-pill text-primary fw-semibold py-1 px-3 mb-2">
                    Subscription Requests
                </p>
                <h1 class="display-6">All Subscription Requests</h1>
            </div>

            <!-- Flash Messages -->
            @foreach (['success', 'error', 'successMessage', 'errorMessage'] as $msg)
                @if(session($msg))
                    <div class="alert alert-{{ str_contains($msg, 'error') ? 'danger' : 'success' }} alert-dismissible fade show" role="alert">
                        {{ session($msg) }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            @endforeach

            <!-- Main Table Card -->
            <div class="card shadow-sm rounded-4 border-0">
                <div class="card-body table-responsive">
                    <table class="table table-striped align-middle table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th style="padding: 15px; width: 5%;">ID</th>
                                <th style="padding: 15px; width: 15%;">User</th>
                                <th style="padding: 15px; width: 10%;">Login User Contact</th>
                                <th style="padding: 15px; width: 10%;">Plan</th>
                                <th style="padding: 15px; width: 10%;">Data Count</th>
                                <th style="padding: 15px; min-width: 150px; width: 50%;">Status</th> <!-- Adjusted width for Status -->
                                <th style="padding: 15px; width: 10%;">Payment Method</th>
                                <th style="padding: 15px; width: 15%;">Screenshot</th>
                                <th style="padding: 15px; width: 10%;">Amount Paid</th>
                                <th style="padding: 15px; width: 10%;">Transaction ID</th>
                                <th style="padding: 15px; width: 10%;">Reference ID</th>
                                <th style="padding: 15px; width: 10%;">Phone</th>
                                <th style="padding: 15px; width: 15%;">Payment Date</th>
                                <th style="padding: 15px; width: 15%;">Subscription Period</th>
                                <th style="padding: 15px; width: 10%;">Plan Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subscriptionRequests as $request)
                            <tr>
                                <td style="padding: 15px;">{{ $request->id }}</td>
                                <td style="padding: 15px;">{{ $request->user->name ?? 'Guest' }}</td>
                                <td style="padding: 15px;">{{ $request->user->phone ?? 'N/A' }}</td>
                                <td style="padding: 15px;">{{ $request->plan }}</td>
                                <td style="padding: 15px;">{{ $request->no_of_data }}</td>

                                <!-- Status Dropdown -->
                                <td style="padding: 15px;">
                                    <form action="{{ route('subscriptionrequest.updatestatus', $request->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="form-select form-select-sm rounded-pill" onchange="this.form.submit()">
                                            <option value="pending" {{ $request->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="approved" {{ $request->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="rejected" {{ $request->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                    </form>
                                </td>

                                <!-- Payment Method -->
                                <td style="padding: 15px;">{{ $request->paymentdetail->payment_method ?? 'N/A' }}</td>

                                <!-- Screenshot -->
                                <td style="padding: 15px;">
                                    @if(!empty($request->paymentdetail->screen_shot))
                                    <img src="{{ asset('storage/' . $request->paymentdetail->screen_shot) }}" alt="Payment Screenshot" width="300">
                                    @else
                                        <span class="text-muted">Not Uploaded</span>
                                    @endif
                                </td>

                                <!-- Payment Details with Null Check -->
                                <td style="padding: 15px;">
                                    {{ $request->paymentdetail ? $request->paymentdetail->amount : 'N/A' }} 
                                    {{ $request->paymentdetail ? $request->paymentdetail->currency : 'N/A' }}
                                </td>
                                <td style="padding: 15px;">{{ $request->paymentdetail->transaction_id ?? 'N/A' }}</td>
                                <td style="padding: 15px;">{{ $request->paymentdetail->reference_id ?? 'N/A' }}</td>
                                <td style="padding: 15px;">{{ $request->paymentdetail->phone ?? 'N/A' }}</td>
                                <td style="padding: 15px;">
                                    {{ $request->paymentdetail ? \Carbon\Carbon::parse($request->paymentdetail->created_at)->format('d M Y, h:i A') : 'N/A' }}
                                </td>

                                <!-- Subscription Period -->
                                <td style="padding: 15px;">{{ $request->subscription_start ?? '-' }} to {{ $request->subscription_end ?? '-' }}</td>

                                <!-- Plan Amount -->
                                <td style="padding: 15px;">{{ $request->plan_amount ?? 'N/A' }}</td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="14" class="text-center text-muted py-4">No subscription requests found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Optional Debug Output -->
            <script>
                console.log('Subscription Requests:', {!! json_encode($subscriptionRequests) !!});
            </script>

        </div>
    </div>
</div>

@endsection
