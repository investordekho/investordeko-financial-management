<!-- Debug -->

@php 
    $isSubscribed = $subscriber?->is_subscribed ?? false;

    $approvedInvestee = [];
    $lockedInvestee = [];

    foreach ($investees as $investee) {
        if (in_array($investee->id, $userAccess)) {
            $approvedInvestee[] = $investee;
        } else {
            $lockedInvestee[] = $investee;
        }
    }

    // Sort: approved first
    $sortedInvestee = array_merge($approvedInvestee, $lockedInvestee);
@endphp


@if ($investees->count())

    @if($showSubscribeMessageinvestee)
    <div class="col-md-12 text-center mt-4">
        <div class="alert subscription-box">
            <h5 class="fw-bold">🔒 Unlock Full Access!</h5>
            <p>Subscribe now to view complete details and unlock all data you searched for.</p>
            <a href="{{ route('subscription') }}" class="btn btn-warning btn-lg">🚀 Subscribe Now</a>
        </div>
    </div>
    @endif

    <div class="container mt-5">
        <div class="row">

            @foreach ($sortedInvestee as $investee)
                @php 
                    $approved = in_array($investee->id, $userAccess);
                    $blurClass = (!$isSubscribed || !$approved) ? 'locked-content' : '';
                @endphp

                <div class="col-md-12 mb-4">
                    <div class="investee-card p-4">

                        <div class="row align-items-center">
                            <div class="col-md-2 text-center">
                                <div class="profile-wrapper">
                                    <img src="{{ $investee->profile_image ? asset('storage/profile_image/' . $investee->profile_image) : asset('img/default_profile.png') }}" 
                                         class="profile-img" 
                                         alt="Investee Logo">
                                    <span class="badge premium-badge">⭐ Premium</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h4 class="fw-bold name-text {{ $blurClass }}">
                                    {{ $investee->company_name ?? 'Unknown User' }}
                                </h4> 

                                <p class="text-muted details-text {{ $blurClass }}">
                                    <i class="bi bi-geo-alt-fill text-primary"></i> {{ $investee->address }}  
                                    &nbsp;|&nbsp;
                                    <i class="bi bi-person-badge text-success"></i> 
                                    Founded by {{ $investee->founders->first()->name ?? 'N/A' }}
                                </p>
                            </div>

                            <div class="col-md-4 text-end">
                                @if($isSubscribed && $approved)
                                    <a href="{{ route('investordashboard.investeelistdetail', ['id' => $investee->id]) }}" 
                                       class="btn btn-primary btn-sm">🔍 View Profile</a>
                                @else
                                    <span class="btn btn-primary btn-sm disabled" style="cursor:not-allowed;">
                                        🔒 View Profile
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr class="divider">

                        <div class="row text-center">
                            <div class="col-md-4">
                                <p class="info-label"><i class="bi bi-briefcase-fill text-info"></i> Business Type</p>
                                <p class="info-value {{ $blurClass }}">{{ $investee->nature_of_business ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="info-label"><i class="bi bi-calendar-event text-warning"></i> Incorporated</p>
                                <p class="info-value {{ $blurClass }}">{{ $investee->incorporated_in ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="info-label"><i class="bi bi-cash-stack text-success"></i> Fund Usage</p>
                                <p class="info-value {{ $blurClass }}">{{ $investee->fundRequirements->first()->usage ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <hr class="divider">

                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="fw-bold"><i class="bi bi-graph-up text-primary"></i> Previous Investments</h5>

                                @if ($investee->previousRounds->count())
                                    @foreach ($investee->previousRounds as $round)
                                        <p class="investment-details {{ $blurClass }}">
                                            <strong>Round:</strong> {{ $round->round }}  
                                            &nbsp;|&nbsp;
                                            <strong>Investors:</strong> {{ $round->investors }}
                                            &nbsp;|&nbsp;
                                            <strong>Amount Raised:</strong> ₹{{ number_format($round->amount_raised, 2) }} Cr  
                                            &nbsp;|&nbsp;
                                            <strong>Valuation:</strong> ₹{{ number_format($round->valuation, 2) }} Cr
                                        </p>
                                    @endforeach
                                @else
                                    <p class="text-muted">No previous investments found.</p>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

            @endforeach

        </div>
    </div>

@else
    <div class="container mt-5 {{ !$isSubscribed ? 'locked-content' : '' }}">
        <h2 class="text-center mb-4 fw-bold text-dark">No Investees Found</h2>
        <p class="text-center">Please check back later or consider subscribing.</p>
    </div>
@endif


<style>
    .investee-card {
        background: linear-gradient(135deg, #ffffff, #f8f9fa);
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0px 10px 25px rgba(0,0,0,0.1);
        transition: all 0.3s ease-in-out;
    }
    .investee-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 15px 30px rgba(0,0,0,0.15);
    }
    .profile-wrapper { position: relative; display: inline-block; }
    .profile-img { width: 90px; height: 90px; border-radius: 50%; border: 4px solid #ddd; }
    .premium-badge { position: absolute; top: 5px; right: 5px; background: gold; color: black; font-size: 12px; padding: 4px 8px; border-radius: 8px; font-weight: bold; }
    .locked-content { filter: blur(5px); opacity: .6; user-select: none; pointer-events: none; }
    .subscription-box { background:#fffae6; padding:20px; border-radius:12px; }
</style>
