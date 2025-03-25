<div class="container mt-5">
    <!-- <h2 class="text-center mb-4 fw-bold text-dark">Investors List</h2> -->

    <div class="row">
        @foreach ($investors as $investor)
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
                            <h4 class="fw-bold name-text">
                                {{ $investor['investor_name'] ?? 'Unknown Investor' }}
                            </h4> 
                            <p class="text-muted details-text">
                                <i class="bi bi-geo-alt-fill text-primary"></i> {{ $investor['address'] }}  
                                &nbsp;|&nbsp;
                                <i class="bi bi-cash-coin text-success"></i> 
                                Sectors: {{ $investor['sectors_preferred'] ?? 'N/A' }}
                            </p>
                        </div>

                        <!-- View Profile Button (Navigates to Details Page) -->
                        <div class="col-md-4 text-end">
                            <a href="{{ route('investeedashboard.investorlistdetail',['id' => $investor['id']])}}" 
                               class="btn btn-primary btn-sm">🔍 View Details</a>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

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
</style>
































<!-- <div class="container" style="max-width: 1200px; margin: 40px auto; padding: 20px;">
    <h2 class="mb-4" style="text-align: center; color: #333; font-weight: bold;">Investors List</h2>
    
    <div class="row">
        @foreach ($investors as $investor)
            <div class="col-md-6 mb-4">
                <div class="card shadow" style="border-radius: 10px; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <div class="card-body" style="padding: 20px;">
                        <h4 class="card-title" style="font-size: 1.5rem; color: #007bff; font-weight: bold;">
                            {{ $investor['investor_name'] ?? 'N/A' }}
                        </h4>
                        <p style="font-size: 1rem; color: #555; margin-bottom: 10px;">
                            <strong>Address:</strong> {{ $investor['address'] ?? 'N/A' }}
                        </p>
                        <p style="font-size: 1rem; color: #555; margin-bottom: 10px;">
                            <strong>Preferred Sectors:</strong> {{ $investor['sectors_preferred'] ?? 'N/A' }}
                        </p>

                        {{-- Contact Details --}}
                        <h5 style="font-size: 1.2rem; margin-top: 15px; color: #444; font-weight: bold; border-bottom: 2px solid #ddd; padding-bottom: 5px;">
                            Contact Details
                        </h5>
                        <p style="font-size: 1rem; color: #555; margin-bottom: 10px;">
                            <strong>Name:</strong> {{ $investor['contact_details']['concerned_person_name'] ?? 'N/A' }}
                        </p>
                        <p style="font-size: 1rem; color: #555; margin-bottom: 10px;">
                            <strong>Phone:</strong> {{ $investor['contact_details']['concerned_person_phone'] ?? 'N/A' }}
                        </p>
                        <p style="font-size: 1rem; color: #555; margin-bottom: 10px;">
                            <strong>Email:</strong> {{ $investor['contact_details']['email'] ?? 'N/A' }}
                        </p>

                        {{-- Investment Details --}}
                        <h5 style="font-size: 1.2rem; margin-top: 15px; color: #444; font-weight: bold; border-bottom: 2px solid #ddd; padding-bottom: 5px;">
                            Investment Details
                        </h5>
                        @if (!empty($investor['investment_details']))
                            <p style="font-size: 1rem; color: #555; margin-bottom: 10px;">
                                <strong>Investment Type:</strong> {{ $investor['investment_details']['investor_type'] ?? 'N/A' }}
                            </p>
                            <p style="font-size: 1rem; color: #555; margin-bottom: 10px;">
                                <strong>Investment Size:</strong> {{ $investor['investment_details']['investment_size'] ?? 'N/A' }}
                            </p>
                            <p style="font-size: 1rem; color: #555; margin-bottom: 10px;">
                                <strong>Investment Tenure:</strong> {{ $investor['investment_details']['investment_tenure'] ?? 'N/A' }}
                            </p>
                        @else
                            <p style="font-size: 1rem; color: #555;">No investment details available.</p>
                        @endif

                        {{-- Public Links --}}
                        <h5 style="font-size: 1.2rem; margin-top: 15px; color: #444; font-weight: bold; border-bottom: 2px solid #ddd; padding-bottom: 5px;">
                            Public Links
                        </h5>
                        @if (!empty($investor['public_links']))
                            <ul style="padding-left: 20px;">
                                @foreach ($investor['public_links'] as $link)
                                    <li style="list-style-type: square; margin-bottom: 5px;">
                                        <strong>{{ $link['link_description'] ?? 'N/A' }}:</strong>
                                        <a href="{{ $link['url'] ?? '#' }}" target="_blank" style="color: #007bff; text-decoration: none;">
                                            {{ $link['url'] ?? 'N/A' }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p style="font-size: 1rem; color: #555;">No public links available.</p>
                        @endif

                        {{-- Referrals --}}
                        @if (!empty($investor['referrals']))
                            <h5 style="font-size: 1.2rem; margin-top: 15px; color: #444; font-weight: bold; border-bottom: 2px solid #ddd; padding-bottom: 5px;">
                                Referral Source
                            </h5>
                            <p style="font-size: 1rem; color: #555;">{{ $investor['referrals']['referral_source'] ?? 'N/A' }}</p>
                        @endif

                        {{-- Address Details --}}
                        <h5 style="font-size: 1.2rem; margin-top: 15px; color: #444; font-weight: bold; border-bottom: 2px solid #ddd; padding-bottom: 5px;">
                            Investor Addresses
                        </h5>
                        @if (!empty($investor['investor_addresses']))
                            <ul style="padding-left: 20px;">
                                @foreach ($investor['investor_addresses'] as $address)
                                    <li style="list-style-type: square; margin-bottom: 5px;">
                                        {{ $address['city'] ?? 'N/A' }}, {{ $address['state'] ?? 'N/A' }}, {{ $address['country'] ?? 'N/A' }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p style="font-size: 1rem; color: #555;">No addresses available.</p>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div> -->
