@if ($investees->count())
    @php
        $isSubscribed = $subscriber && $subscriber->is_subscribed;
        $visibleInvesteeCount = $isSubscribed ? $investees->count() : min($investees->count(), 3);
    @endphp

    @foreach ($investees->take($visibleInvesteeCount) as $investee)
        <div class="col-md-12 mb-4">
            <div class="investee-entry p-3 rounded shadow-sm" style="background-color: #f8f9fa; color: black; border: 1px solid #ccc;">
                <div class="row">
                    <!-- Profile Image -->
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
    <img src="{{ $investee->profile_image ? asset('storage/profile_image/' . $investee->profile_image) : asset('img/default_profile.png') }}" class="img-fluid rounded-circle" alt="Investee Logo" style="width: 90px; height: 90px;">
</div>


                    <!-- Investee Name (Fetched from user ID in companies table) and Address -->
                    <div class="col-md-6">
                        <h3 class="nameE {{ !$isSubscribed ? 'blurred-content' : '' }}">
                            {{ $investee->user->name ?? 'Unknown User' }}
                        </h3> <!-- Fetch name from user_id -->
                        <p class="mt-2 {{ !$isSubscribed ? 'blurred-content' : '' }}" style="font-size: 18px;">
                            <i class="bi bi-geo-alt-fill" style="color: #5e6469;"></i> {{ $investee->address }} |
                            <i>Incorporated in {{ $investee->incorporated_in ?? 'N/A' }}</i>
                        </p>
                    </div>

                    <!-- Personalised Note Button -->
                    <div class="col-md-4 d-flex justify-content-end align-items-center">
                        <!--<button class="btn btn-success">📝 Personalised Note</button> -->
                    </div>
                </div>

                <hr>

                <!-- Information Section -->
                <div class="row text-center">
                    <!-- Nature of Business -->
                    <div class="col-md-4">
                        <strong><i class="bi bi-briefcase-fill" style="color: #5e6469;"></i> Nature of Business:</strong>
                        <p class="{{ !$isSubscribed ? 'blurred-content' : '' }}">{{ $investee->nature_of_business ?? 'N/A' }}</p>
                    </div>

                    <!-- Incorporated In -->
                    <div class="col-md-4">
                        <strong><i class="bi bi-calendar-fill" style="color: #5e6469;"></i> Incorporated In:</strong>
                        <p class="{{ !$isSubscribed ? 'blurred-content' : '' }}">{{ $investee->incorporated_in ?? 'N/A' }}</p>
                    </div>

                    <!-- Usage of Fund (from fund_requirements table) -->
                    <div class="col-md-4">
                        <strong><i class="bi bi-cash-stack" style="color: #5e6469;"></i> Usage of Fund:</strong>
                        <p class="{{ !$isSubscribed ? 'blurred-content' : '' }}">{{ $investee->fundRequirements->first()->usage ?? 'N/A' }}</p>
                    </div>
                </div>

                <hr>

                <!-- Previous Investments (from previous_rounds table) -->
                <div class="row">
                    <div class="col-md-12">
                        <strong>Previous Investments:</strong>
                        @if ($investee->previousRounds->count())
                            @foreach ($investee->previousRounds as $round)
                                <p class="{{ !$isSubscribed ? 'blurred-content' : '' }}">
                                    <strong>Round:</strong> {{ $round->round }} |
                                    <strong>Investors:</strong> {{ $round->investors }} |
                                    <strong>Amount Raised:</strong> ₹{{ number_format($round->amount_raised, 2) }} Cr |
                                    <strong>Valuation:</strong> ₹{{ number_format($round->valuation, 2) }} Cr
                                </p>
                            @endforeach
                        @else
                            <p>No previous investments found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Subscription Prompt for Unsubscribed Users -->
    @if (!$isSubscribed && $investees->count() > 3)
        <div class="col-md-12 text-center">
            <p style="color: black;">Get access to information on all the investees.</p>
            <p style="color: black;">The full list is available only for subscribers. Upgrade to a full subscription and get all the benefits of this unique platform. 🚀</p>
            <a href="{{ route('subscription') }}" class="btn btn-dark text-white">Subscribe Now</a>
        </div>
    @endif
@else
    <p>No investees found matching your criteria.</p>
@endif

<!-- Blurring effect -->
<style>
    .blurred-content {
        filter: blur(4px);
    }
</style>
