<!-- @if ($investees->count())
    @php
        $isSubscribed = $subscriber && $subscriber->is_subscribed;
        $visibleInvesteeCount = $isSubscribed ? $investees->count() : min($investees->count(), 3);
    @endphp

    @foreach ($investees->take($visibleInvesteeCount) as $investee)
        <div class="col-md-12 mb-4">
            <div class="investee-entry p-3 rounded shadow-sm" style="background-color: #f8f9fa; color: black; border: 1px solid #ccc;">
                <div class="row">
                 
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
    <img src="{{ $investee->profile_image ? asset('storage/profile_image/' . $investee->profile_image) : asset('img/default_profile.png') }}" class="img-fluid rounded-circle" alt="Investee Logo" style="width: 90px; height: 90px;">
</div>


                    <div class="col-md-6">
                        <h3 class="nameE {{ !$isSubscribed ? 'blurred-content' : '' }}">
                            {{ $investee->user->name ?? 'Unknown User' }}
                        </h3> 
                        <p class="mt-2 {{ !$isSubscribed ? 'blurred-content' : '' }}" style="font-size: 18px;">
                            <i class="bi bi-geo-alt-fill" style="color: #5e6469;"></i> {{ $investee->address }} |
                            <i>Incorporated in {{ $investee->incorporated_in ?? 'N/A' }}</i>
                        </p>
                    </div>

                 
                    <div class="col-md-4 d-flex justify-content-end align-items-center">
                     
                    </div>
                </div>

                <hr>

                <div class="row text-center">
           
                    <div class="col-md-4">
                        <strong><i class="bi bi-briefcase-fill" style="color: #5e6469;"></i> Nature of Business:</strong>
                        <p class="{{ !$isSubscribed ? 'blurred-content' : '' }}">{{ $investee->nature_of_business ?? 'N/A' }}</p>
                    </div>

                    <div class="col-md-4">
                        <strong><i class="bi bi-calendar-fill" style="color: #5e6469;"></i> Incorporated In:</strong>
                        <p class="{{ !$isSubscribed ? 'blurred-content' : '' }}">{{ $investee->incorporated_in ?? 'N/A' }}</p>
                    </div>

                   
                    <div class="col-md-4">
                        <strong><i class="bi bi-cash-stack" style="color: #5e6469;"></i> Usage of Fund:</strong>
                        <p class="{{ !$isSubscribed ? 'blurred-content' : '' }}">{{ $investee->fundRequirements->first()->usage ?? 'N/A' }}</p>
                    </div>
                </div>

                <hr>

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


<style>
    .blurred-content {
        filter: blur(4px);
    }
</style> -->





























































@if ($investees->count()) 
    @php
        $isSubscribed = $subscriber && $subscriber->is_subscribed;
        $visibleInvesteeCount = $isSubscribed ? $investees->count() : min($investees->count(), 3);
    @endphp

    @foreach ($investees->take($visibleInvesteeCount) as $investee)
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
                        <h4 class="fw-bold name-text {{ !$isSubscribed ? 'locked-content' : '' }}">
                            {{ $investee->company_name ?? 'Unknown User' }}
                        </h4> 
                        <p class="text-muted details-text {{ !$isSubscribed ? 'locked-content' : '' }}">
                            <i class="bi bi-geo-alt-fill text-primary"></i> {{ $investee->address }}  
                            &nbsp;|&nbsp;
                          
                            <i class="bi bi-person-badge text-success"></i> 
                            Founded by {{ $investee->founders->first()->name ?? 'N/A' }}
                        </p>
                    </div>

             
                 
                    <div class="col-md-4 text-end">
                        <a href="{{ route('investor.investorlistdetail', ['id' => $investee->id]) }}" 
                        class="btn btn-primary btn-sm">🔍 View Profile</a>
                    </div>

                </div>

                <hr class="divider">

                <div class="row text-center">
                    <div class="col-md-4">
                        <p class="info-label"><i class="bi bi-briefcase-fill text-info"></i> Business Type</p>
                        <p class="info-value {{ !$isSubscribed ? 'locked-content' : '' }}">{{ $investee->nature_of_business ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p class="info-label"><i class="bi bi-calendar-event text-warning"></i> Incorporated</p>
                        <p class="info-value {{ !$isSubscribed ? 'locked-content' : '' }}">{{ $investee->incorporated_in ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p class="info-label"><i class="bi bi-cash-stack text-success"></i> Fund Usage</p>
                        <p class="info-value {{ !$isSubscribed ? 'locked-content' : '' }}">{{ $investee->fundRequirements->first()->usage ?? 'N/A' }}</p>
                    </div>
                </div>

                <hr class="divider">

          
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="fw-bold"><i class="bi bi-graph-up text-primary"></i> Previous Investments</h5>
                        @if ($investee->previousRounds->count())
                            @foreach ($investee->previousRounds as $round)
                                <p class="investment-details {{ !$isSubscribed ? 'locked-content' : '' }}">
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

    @if (!$isSubscribed && $investees->count() > 3)
        <div class="col-md-12 text-center mt-4">
            <div class="alert subscription-box">
                <h5 class="fw-bold">🔒 Unlock Full Access!</h5>
                <p>Subscribe now to view complete details and get unlimited access to all investees on this platform.</p>
                <a href="{{ route('subscription') }}" class="btn btn-warning btn-lg">🚀 Subscribe Now</a>
            </div>
        </div>
    @endif
@else
    <div class="col-md-12 text-center">
        <p class="text-muted">No investees found matching your criteria.</p>
    </div>
@endif


<style>
    .investee-card {
        background: linear-gradient(135deg, #ffffff, #f8f9fa);
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }
    .investee-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.15);
    }
    
    .profile-wrapper {
        position: relative;
        display: inline-block;
    }
    
    .profile-img {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        border: 4px solid #ddd;
    }
    
    .premium-badge {
        position: absolute;
        top: 5px;
        right: 5px;
        background: gold;
        color: black;
        font-size: 12px;
        padding: 4px 8px;
        border-radius: 8px;
        font-weight: bold;
    }

    .locked-content {
        filter: blur(3px);
        opacity: 0.6;
    }
    
    .subscription-box {
        background: #fffae6;
        padding: 20px;
        border-radius: 12px;
        transition: 0.3s;
    }

    .subscription-box:hover {
        background: #ffe5b4;
    }
</style>
