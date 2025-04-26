@php 
    $isSubscribed = isset($subscriber) && $subscriber?->is_subscribed;
@endphp

@if($investors->count())
    @php 
        $isSubscribed = $subscriber && $subscriber->is_subscribed;
        $visibleInvestorCount = $isSubscribed ? $investors->count() : min($investors->count(), 3);
    @endphp

<div class="container mt-5">
    <!-- <h2 class="text-center mb-4 fw-bold text-dark">Investors List</h2> -->

    <div class="row">
        @foreach ($investors->take($visibleInvestorCount) as $investor)
            <div class="col-md-12 mb-4">
                <div class="investor-card p-4">
                    <div class="row align-items-center">
                        
                        <!-- Profile Image Section -->
                        <div class="col-md-2 text-center">
                            <div class="profile-wrapper">
                                <img src="{{ $investor['profile_image'] ? asset('storage/profile_image/' . $investor['profile_image']) : asset('img/default_profile.png') }}" 
                                     class="profile-img" 
                                     alt="Investor Profile">
                                <span class="badge premium-badge">⭐ Premium</span>
                            </div>
                        </div>

                        <!-- Investor Info Section -->
                        <div class="col-md-6">
                            <h4 class="fw-bold name-text {{ !$isSubscribed ? 'locked-content' : ''}}">
                                {{ $investor['investor_name'] ?? 'Unknown Investor' }}
                            </h4> 
                            <p class="text-muted details-text {{ !$isSubscribed ? 'locked-content' : ''}}">
                                <i class="bi bi-geo-alt-fill text-primary"></i> {{ $investor['address'] }}  
                                &nbsp;|&nbsp;
                                <i class="bi bi-cash-coin text-success"></i> 
                                Sectors: {{ $investor['sectors_preferred'] ?? 'N/A' }}
                            </p>
                        </div>

                        <!-- View Profile Button (Navigates to Details Page) -->
                        <div class="col-md-4 text-end {{ !$isSubscribed ? 'locked-content' : ''}}">
                            <a href="{{ route('investeedashboard.investorlistdetail',['id' => $investor['id']])}}" 
                               class="btn btn-primary btn-sm">🔍 View Details</a>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach

        @if (!$isSubscribed && $investors->count() == 3)
        <div class="col-md-12 text-center mt-4">
            <div class="alert subscription-box">
                <h5 class="fw-bold">🔒 Unlock Full Access!</h5>
                <p>Subscribe now to view complete details and get unlimited access to all investees on this platform.</p>
                <a href="{{ route('subscription') }}" class="btn btn-warning btn-lg">🚀 Subscribe Now</a>
            </div>
        </div>
    @endif
        <!-- @if (!$isSubscribed && $investors->count() == 3)
            <div class="col-md-12 text-center">
                <a href="{{ route('subscription') }}" class="btn btn-secondary">🔒 Unlock More Investors</a>
            </div>
        @endif -->

    </div>
</div>

@else
    <div class="container mt-5 {{!$isSubscribed ? 'locked-content' : ''}}">
        <h2 class="text-center mb-4 fw-bold text-dark">No Investors Found</h2>
        <p class="text-center">Please check back later or consider subscribing for more options.</p>
    </div>
@endif

<style>
    .investor-card {
        background: linear-gradient(135deg, #ffffff, #f8f9fa);
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }
    .investor-card:hover {
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

    .divider {
        border-top: 1px solid #e0e0e0;
        margin: 15px 0;
    }

    .info-label {
        font-size: 14px;
        font-weight: bold;
        color: #6c757d;
    }

    .info-value {
        font-size: 16px;
        color: #333;
    }
    
    .locked-content {
        filter: blur(5px);
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




























