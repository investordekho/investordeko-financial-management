
@extends('layouts.app')

@section('content')

<style>
/* Container Styling */
.container {
    max-width: 1200px;
    margin: auto;
}

/* Sidebar Styling */
.sidebar {
    height: 100vh;
    position: sticky;
    top: 80px;
    background: linear-gradient(to bottom, #007bff, #0056b3);
    padding: 20px;
    overflow-y: auto;
    border-radius: 8px;
}

.list-group-item {
    border: none;
    padding: 12px 15px;
    font-size: 16px;
    background: transparent;
    color: white;
    transition: all 0.3s ease-in-out;
    cursor: pointer;
}

.list-group-item:hover, .list-group-item.active {
    background-color: rgba(255, 255, 255, 0.2);
    color: #fff;
    font-weight: bold;
    border-radius: 5px;
}

/* Main Content Styling */
.main-content {
    padding: 20px;
    background: #f9f9f9;
    border-radius: 10px;
}

/* Section Cards */
.section-card {
    background: white;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease-in-out;
}

.section-card:hover {
    transform: translateY(-3px);
}

/* Headings Styling */
h2, h4 {
    border-bottom: 3px solid #007bff;
    padding-bottom: 8px;
    margin-bottom: 20px;
    font-weight: 600;
    color: #333;
}

/* Form Enhancements */
.form-label {
    font-weight: bold;
    color: #555;
}

.form-control {
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    padding: 12px 14px;
    font-size: 14px;
    margin-bottom: 15px;
    border-radius: 5px;
    transition: all 0.3s ease-in-out;
}

.form-control:hover {
    border-color: #007bff;
}

.form-control[readonly] {
    background-color: #e9ecef;
    color: #495057;
}

/* Links inside Public Links Section */
.form-control a {
    color: #007bff;
    font-weight: bold;
    text-decoration: none;
}

.form-control a:hover {
    text-decoration: underline;
}

/* Responsive Adjustments */
@media (max-width: 992px) {
    .sidebar {
        position: relative;
        height: auto;
        width: 100%;
        margin-bottom: 20px;
    }
}
</style>

<style>
/* Container Styling */
.container {
    max-width: 1200px;
}

/* Sidebar Styling */
.sidebar {
    height: 100vh;
    position: sticky;
    top: 80px;
    background: linear-gradient(to bottom, #007bff, #0056b3);
    padding: 20px;
    overflow-y: auto;
    border-radius: 8px;
}

.list-group-item {
    border: none;
    padding: 12px 15px;
    font-size: 16px;
    background: transparent;
    color: white;
    transition: all 0.3s ease-in-out;
    cursor: pointer;
}

.list-group-item:hover, .list-group-item.active {
    background-color: rgba(255, 255, 255, 0.2);
    color: #fff;
    font-weight: bold;
    border-radius: 5px;
}

/* Main Content Styling */
.main-content {
    padding: 20px;
    background: #f9f9f9;
    border-radius: 10px;
}

/* Section Cards */
.section-card {
    background: white;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease-in-out;
}

.section-card:hover {
    transform: translateY(-3px);
}

/* Headings Styling */
h2, h4 {
    border-bottom: 3px solid #007bff;
    padding-bottom: 8px;
    margin-bottom: 20px;
    font-weight: 600;
    color: #333;
}

/* Form Enhancements */
.form-label {
    font-weight: bold;
    color: #555;
}

.form-control {
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    padding: 12px 14px;
    font-size: 14px;
    margin-bottom: 15px;
    border-radius: 5px;
    transition: all 0.3s ease-in-out;
}

.form-control:hover {
    border-color: #007bff;
}

.form-control[readonly] {
    background-color: #e9ecef;
    color: #495057;
}

/* Links inside Public Links Section */
.form-control a {
    color: #007bff;
    font-weight: bold;
    text-decoration: none;
}

.form-control a:hover {
    text-decoration: underline;
}

/* Responsive Adjustments */
@media (max-width: 992px) {
    .sidebar {
        position: relative;
        height: auto;
        width: 100%;
        margin-bottom: 20px;
    }
}
</style>

<div class="container">
    <div class="row">
      
        <div class="col-md-3 sidebar">
            <div class="list-group">
                <a href="#investor-details-1" class="list-group-item active">Investor Details</a>
                <a href="#contact_details-2" class="list-group-item">Contact Details</a>
                <a href="#public-links-3" class="list-group-item">Public Links</a>
                <a href="#previous-investment-4" class="list-group-item">Previous Investments</a>
                <a href="#investment-details-5" class="list-group-item">Investment Details</a>
                <a href="#referrals-6" class="list-group-item">Referrals</a>
                <a href="#guidance-needs-7" class="list-group-item">Guidance Needs</a>
                <a href="#investor-address-8" class="list-group-item">Investor Address</a>
            </div>
        </div>

       
        <div class="col-md-9 main-content">
        <div class="section-card" id="investor-details-1">
            
                <h2 id="investor-details" style="font-size: 16px; color: #444; font-weight: 600; font-family: 'Poppins', sans-serif; margin-bottom: 20px; border-bottom: 3px solid #007bff; padding-bottom: 2px; display: inline-block;">
                    <i class="fas fa-chart-line" style="color: #007bff; margin-right: 8px;"></i> Investor Details
                </h2>

                <div style="background: #ffffff; padding: 17px; border-radius: 12px; box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1); max-width: 1000px; font-family: 'Poppins', sans-serif; border-left: 2px solid #007bff;">

                    <div style="display: flex; align-items: center; border-bottom: 1px solid #ddd; padding: 14px 0;">
                        <i class="fas fa-user" style="color: #007bff; font-size: 14px; width: 30px;"></i>
                        <strong style="color: #333; font-size: 16px; flex: 1;">Investor Name</strong>
                        <span style="font-size: 15px; font-weight: 500; color: #555;">{{ $investor->investor_name }}</span>
                    </div>

                    <div style="display: flex; align-items: center; border-bottom: 1px solid #ddd; padding: 14px 0;">
                        <i class="fas fa-map-marker-alt" style="color: #28a745; font-size: 14px; width: 30px;"></i>
                        <strong style="color: #333; font-size: 16px; flex: 1;">Address</strong>
                        <span style="font-size: 15px; font-weight: 500; color: #555;">{{ $investor->address }}</span>
                    </div>

                    <div style="display: flex; align-items: center; border-bottom: 1px solid #ddd; padding: 14px 0;">
                        <i class="fas fa-id-card" style="color: #ffc107; font-size: 14px; width: 30px;"></i>
                        <strong style="color: #333; font-size: 16px; flex: 1;">Investor Profile</strong>
                        <span style="font-size: 15px; font-weight: 500; color: #555;">{{ $investor->investor_profile }}</span>
                    </div>

                    <div style="display: flex; align-items: center; padding: 14px 0;">
                        <i class="fas fa-industry" style="color: #dc3545; font-size: 14px; width: 30px;"></i>
                        <strong style="color: #333; font-size: 16px; flex: 1;">Sectors Preferred</strong>
                        <span style="font-size: 15px; font-weight: 500; color: #555;">{{ $investor->sectors_preferred }}</span>
                    </div>

                </div>

        </div>

        @if(isset($investor->contactDetails) && !empty($investor->contactDetails))
            <div class="section-card" id="contact_details-2">
            <h4 id="contact_details" style="font-size: 14px; color: #444; font-weight: 600; font-family: 'Poppins', sans-serif; margin-bottom: 20px; border-left: 2px solid #28a745; padding-left: 10px;">
                <i class="fas fa-address-book" style="color: #28a745; margin-right: 8px;"></i> Contact Details
            </h4>

            <div style="background: #f9f9f9; padding: 25px; border-radius: 12px; box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1); max-width: 1000px; font-family: 'Poppins', sans-serif;">

                <div style="display: flex; align-items: center; border-bottom: 1px solid #ddd; padding: 14px 0;">
                    <i class="fas fa-user-tie" style="color: #007bff; font-size: 14px; width: 30px;"></i>
                    <strong style="color: #333; font-size: 16px; flex: 1;">Person Name</strong>
                    <span style="font-size: 15px; font-weight: 500; color: #555;">{{ $investor->contactDetails->concerned_person_name }}</span>
                </div>

                @if(isset($investor->contactDetails->concerned_person_designation))
                <div style="display: flex; align-items: center; border-bottom: 1px solid #ddd; padding: 14px 0;">
                    <i class="fas fa-briefcase" style="color: #ffc107; font-size: 14px; width: 30px;"></i>
                    <strong style="color: #333; font-size: 16px; flex: 1;">Designation</strong>
                    <span style="font-size: 15px; font-weight: 500; color: #555;">{{ $investor->contactDetails->concerned_person_designation }}</span>
                </div>
                @endif

                @if(isset($investor->contactDetails->concerned_person_phone))
                <div style="display: flex; align-items: center; border-bottom: 1px solid #ddd; padding: 14px 0;">
                    <i class="fas fa-phone-alt" style="color: #17a2b8; font-size: 14px; width: 30px; transform: scaleX(-1); margin-right: 10px;  margin-left: -12px;"></i>
                    <strong style="color: #333; font-size: 16px; flex: 1;">Phone</strong>
                    <span style="font-size: 15px; font-weight: 500; color: #555;">{{ $investor->contactDetails->concerned_person_phone }}</span>
                </div>
                @endif

                @if(isset($investor->contactDetails->email))
                <div style="display: flex; align-items: center; padding: 14px 0;">
                    <i class="fas fa-envelope" style="color: #dc3545; font-size: 22px; width: 30px;"></i>
                    <strong style="color: #333; font-size: 16px; flex: 1;">Email</strong>
                    <span style="font-size: 15px; font-weight: 500; color: #555;">{{ $investor->contactDetails->email }}</span>
                </div>
                @endif

            </div>

            </div>
        @endif    

                @if(isset($investor->publicLinks) && $investor->publicLinks->isNotEmpty())
                    <div class="section-card" id="public-links-3" style="background: linear-gradient(135deg, #f8f9fa, #e9ecef); padding: 20px; border-radius: 12px; box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1); max-width: 1000px; font-family: 'Poppins', sans-serif; border-top: 2px solid #17a2b8; margin-bottom: 20px;">

                        <h4 id="public-links" style="font-size: 18px; color: #444; font-weight: 600; font-family: 'Poppins', sans-serif; margin-bottom: 15px; border-bottom: 3px solid #17a2b8; padding-bottom: 5px; display: inline-block; margin-bottom: 20px;">
                            <i class="fas fa-link" style="color: #17a2b8; margin-right: 8px;"></i> Public Links
                        </h4>

                        @foreach($investor->publicLinks as $link)
                        <div style="position: relative; background: #fff; padding: 15px; border-radius: 8px; margin-bottom: 25px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); border-left: 2px solid #007bff;">
                            
                            <!-- Description (Overlapping) -->
                            <div style="position: absolute; top: -12px; left: 12px; background: #28a745; color: #fff; padding: 5px 10px; border-radius: 6px; font-size: 13px; font-weight: 600; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                                <i class="fas fa-info-circle" style="margin-right: 5px;"></i> {{ $link['link_description'] }}
                            </div>

                            <!-- URL Box -->
                            <div style="display: flex; align-items: center; gap: 10px; padding-top: 15px;">
                                <i class="fas fa-globe" style="color: #007bff; font-size: 18px;"></i>
                                <div>
                                    <strong style="color: #333; font-size: 14px;">URL</strong>
                                    <a href="{{ $link->url }}" style="display: block; font-size: 15px; font-weight: 500; color: #007bff; text-decoration: none; margin-top: 3px;">
                                        {{ $link->url }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif

                @if(isset($investor->previousInvestments) && $investor->previousInvestments->isNotEmpty())
<div class="section-card" id="previous-investment-4" style="background: linear-gradient(135deg, #f8f9fa, #e9ecef); padding: 20px; border-radius: 12px; box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1); max-width: 1000px; font-family: 'Poppins', sans-serif; border-top: 2px solid #17a2b8; margin-bottom: 20px;">

    <h4 id="previous-investment" style="font-size: 18px; color: #444; font-weight: 600; font-family: 'Poppins', sans-serif; margin-bottom: 15px; border-bottom: 3px solid #17a2b8; padding-bottom: 5px; display: inline-block;">
        <i class="fas fa-briefcase" style="color: #17a2b8; margin-right: 8px;"></i> Previous Investments
    </h4>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
        @foreach($investor->previousInvestments as $investment)
        <div style="background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); position: relative; border-left: 2px solid #007bff;">
            
            <!-- Year Badge -->
            <div style="position: absolute; top: -10px; right: 15px; background: #28a745; color: #fff; padding: 5px 12px; border-radius: 6px; font-size: 13px; font-weight: 600;">
                <i class="fas fa-calendar-alt" style="margin-right: 5px;"></i> {{ $investment['previous_investment_year'] }}
            </div>

            <!-- Investment Details -->
            <h5 style="color: #007bff; font-size: 17px; font-weight: 600; margin-top: 10px;">
                <i class="fas fa-building" style="margin-right: 5px;"></i> {{ $investment['previous_investment_company'] }}
            </h5>

            <p style="color: #555; font-size: 14px; margin-top: 5px;">
                <i class="fas fa-industry" style="margin-right: 5px; color: #28a745;"></i> Sector: {{ $investment['sector'] }}
            </p>
        </div>
        @endforeach
    </div>
</div>
@endif

              
@if(isset($investor->investmentDetails))
<div class="section-card" id="investment-details-5" style="background: linear-gradient(135deg, #f8f9fa, #e9ecef); padding: 20px; border-radius: 12px; box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1); max-width: 1000px; font-family: 'Poppins', sans-serif; border-top: 2px solid #17a2b8; margin-bottom: 20px;">

    <h4 id="investment-details" style="font-size: 18px; color: #444; font-weight: 600; font-family: 'Poppins', sans-serif; margin-bottom: 15px; border-bottom: 3px solid #17a2b8; padding-bottom: 5px; display: inline-block;">
        <i class="fas fa-chart-line" style="color: #17a2b8; margin-right: 8px;"></i> Investment Details
    </h4>

    <div style="display: flex; flex-wrap: wrap; gap: 20px;">

        <!-- Invest In -->
        <div style="background: #fff; padding: 15px; border-radius: 10px; flex: 1; min-width: 220px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08); border-left: 2px solid #007bff;">
            <h5 style="color: #007bff; font-size: 16px; font-weight: 600;">
                <i class="fas fa-hand-holding-usd" style="margin-right: 6px;"></i> Invest In
            </h5>
            <p style="color: #555; font-size: 14px; margin-top: 5px;">{{ $investor->investmentDetails->invest_in }}</p>
        </div>

        <!-- Investor Type -->
        <div style="background: #fff; padding: 15px; border-radius: 10px; flex: 1; min-width: 220px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08); border-left: 2px solid #28a745;">
            <h5 style="color: #28a745; font-size: 16px; font-weight: 600;">
                <i class="fas fa-user-tag" style="margin-right: 6px;"></i> Investor Type
            </h5>
            <p style="color: #555; font-size: 14px; margin-top: 5px;">{{ $investor->investmentDetails->investor_type }}</p>
        </div>

        <!-- Investment Size -->
        <div style="background: #fff; padding: 15px; border-radius: 10px; flex: 1; min-width: 220px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08); border-left: 2px solid #ffc107;">
            <h5 style="color: #ffc107; font-size: 16px; font-weight: 600;">
                <i class="fas fa-wallet" style="margin-right: 6px;"></i> Investment Size
            </h5>
            <p style="color: #555; font-size: 14px; margin-top: 5px;">{{ $investor->investmentDetails->investment_size }}</p>
        </div>

        <!-- Investment Tenure -->
        <div style="background: #fff; padding: 15px; border-radius: 10px; flex: 1; min-width: 220px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08); border-left: 2px solid #dc3545;">
            <h5 style="color: #dc3545; font-size: 16px; font-weight: 600;">
                <i class="fas fa-hourglass-half" style="margin-right: 6px;"></i> Investment Tenure
            </h5>
            <p style="color: #555; font-size: 14px; margin-top: 5px;">{{ $investor->investmentDetails->investment_tenure }}</p>
        </div>

    </div>
</div>
@endif

@if(isset($investor->referrals) && $investor->referrals->isNotEmpty())
<div class="section-card" id="referrals-6" style="background: linear-gradient(135deg, #f8f9fa, #e9ecef); padding: 20px; border-radius: 12px; box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1); max-width: 1000px; font-family: 'Poppins', sans-serif; border-top: 2px solid #6610f2; margin-bottom: 20px;">

    <h4 id="referrals" style="font-size: 18px; color: #444; font-weight: 600; font-family: 'Poppins', sans-serif; margin-bottom: 15px; border-bottom: 3px solid #6610f2; padding-bottom: 5px; display: inline-block;">
        <i class="fas fa-user-friends" style="color: #6610f2; margin-right: 8px;"></i> Referrals
    </h4>

    <div style="display: flex; flex-direction: column; gap: 15px;">
        @foreach($investor->referrals as $referral)
        <div style="background: #fff; padding: 15px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08); display: flex; align-items: center; gap: 12px; border-left: 2px solid #6610f2;">
            <i class="fas fa-handshake" style="color: #6610f2; font-size: 16px;"></i>
            <div>
                <h5 style="color: #333; font-size: 14px; font-weight: 600; margin-bottom: 3px;">Referral Source</h5>
                <p style="color: #555; font-size: 14px; margin: 0;">{{ $referral->referral_source }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

@if(isset($investor->guidanceNeeds) && !empty($investor->guidanceNeeds))
<div class="section-card" id="guidance-needs-7" style="background: linear-gradient(135deg, #f0f4f8, #d9e2ec); padding: 20px; border-radius: 12px; box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1); max-width: 1000px; font-family: 'Poppins', sans-serif; border-top: 2px solid #007bff; margin-bottom: 20px;">

    <h4 id="guidance-needs" style="font-size: 18px; color: #2c3e50; font-weight: 600; font-family: 'Poppins', sans-serif; margin-bottom: 15px; border-bottom: 3px solid #007bff; padding-bottom: 5px; display: inline-block;">
        <i class="fas fa-lightbulb" style="color: #007bff; margin-right: 8px;"></i> Guidance Needs
    </h4>

    @if(isset($investor['guidanceNeeds']) && isset($investor['guidanceNeeds']['guidance_needed']))
    <div style="background: #fff; padding: 15px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08); border-left: 2px solid #007bff; margin-bottom: 15px;">
        <h5 style="color: #2c3e50; font-size: 14px; font-weight: 600; margin-bottom: 5px;">
            <i class="fas fa-comments" style="color: #007bff; margin-right: 6px;"></i> Guidance Needed
        </h5>
        <p style="color: #555; font-size: 14px; margin: 0; line-height: 1.6;">{{ $investor->guidanceNeeds->guidance_needed }}</p>
    </div>

    <div style="background: #fff; padding: 15px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08); border-left: 2px solid #0056b3;">
        <h5 style="color: #2c3e50; font-size: 14px; font-weight: 600; margin-bottom: 5px;">
            <i class="fas fa-info-circle" style="color: #0056b3; margin-right: 6px;"></i> Other Guidance
        </h5>
        <p style="color: #555; font-size: 14px; margin: 0; line-height: 1.6;">{{ $investor->guidanceNeeds->other_guidance }}</p>
    </div>
    @endif
</div>
@endif

                @if(isset($investor->investorAddresses) && $investor->investorAddresses->isNotEmpty())
<div class="section-card" id="investor-address-8" style="background: linear-gradient(135deg, #f0f4f8, #d9e2ec); padding: 20px; border-radius: 12px; box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1); max-width: 1000px; font-family: 'Poppins', sans-serif; border-top: 2px solid #007bff; margin-bottom: 20px;">

    <h4 id="investor-address" style="font-size: 18px; color: #2c3e50; font-weight: 600; font-family: 'Poppins', sans-serif; margin-bottom: 15px; border-bottom: 3px solid #007bff; padding-bottom: 5px; display: inline-block;">
        <i class="fas fa-map-marker-alt" style="color: #007bff; margin-right: 8px;"></i> Investor Address
    </h4>

    @foreach($investor->investorAddresses as $address)
    <div style="background: #fff; padding: 15px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08); border-left: 2px solid #007bff; margin-bottom: 15px;">
        <div style="display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-globe" style="color: #007bff; font-size: 14px;"></i>
            <strong style="color: #2c3e50; font-size: 14px;">Country</strong>
        </div>
        <p style="font-size: 14px; font-weight: 500; color: #555; margin: 5px 0;">{{ $address->country }}</p>
    </div>

    <div style="display: flex; gap: 15px;">
        <div style="background: #fff; padding: 15px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08); border-left: 2px solid #28a745; flex: 1;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-map" style="color: #28a745; font-size: 14px;"></i>
                <strong style="color: #2c3e50; font-size: 14px;">State</strong>
            </div>
            <p style="font-size: 14px; font-weight: 500; color: #555; margin: 5px 0;">{{ $address->state }}</p>
        </div>

        <div style="background: #fff; padding: 15px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08); border-left: 2px solid #17a2b8; flex: 1;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-city" style="color: #17a2b8; font-size: 14px;"></i>
                <strong style="color: #2c3e50; font-size: 14px;">City</strong>
            </div>
            <p style="font-size: 14px; font-weight: 500; color: #555; margin: 5px 0;">{{ $address->city }}</p>
        </div>
    </div>

    <div style="background: #fff; padding: 15px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08); border-left: 2px solid #ffc107; margin-top: 15px;">
        <div style="display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-envelope" style="color: #ffc107; font-size: 14px;"></i>
            <strong style="color: #2c3e50; font-size: 14px;">ZIP Code</strong>
        </div>
        @if(isset($address->zip_code))
         @if($address->zip_code == 0)
        <p style="font-size: 14px; font-weight: 500; color: #555; margin: 5px 0;">null</p>
        @else
        <p style="font-size: 14px; font-weight: 500; color: #555; margin: 5px 0;">{{ $address->zip_code }}</p>
        @endif
        @endif
    </div>
    @endforeach

</div>
@endif

            
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".list-group-item").forEach(link => {
            link.addEventListener("click", function(event) {
                event.preventDefault();
                let section = document.querySelector(this.getAttribute("href"));
                if (section) {
                    section.scrollIntoView({ behavior: "smooth" });
                }
            });
        });
    });
</script>

<!-- Smooth Scroll and Active State for Sidebar -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sections = document.querySelectorAll("h2, h4"); // Sections to observe
        const links = document.querySelectorAll(".list-group-item");
        
        links.forEach(link => {
            let id = link.getAttribute("href");
            let section = document.querySelector(id);
            console.log(link.getAttribute("href")); // Should print the href value
console.log(document.querySelector(link.getAttribute("href"))); // Should print the section element or null

            if(!section || section.offsetHeight === 0)
            {
                link.style.display = "none";
            }
        })
        // Smooth scroll on click
        links.forEach(link => {
            link.addEventListener("click", function(event) {
                event.preventDefault();
                let section = document.querySelector(this.getAttribute("href"));
                if (section) {
                    section.scrollIntoView({ behavior: "smooth" });
                }
            });
        });

        // Change active link based on scroll
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    links.forEach(link => link.classList.remove("active"));
                    document.querySelector(`.list-group-item[href="#${entry.target.id}"]`)?.classList.add("active");
                }
            });
        }, { threshold: 0.6 }); // 60% of section must be visible

        sections.forEach(section => observer.observe(section));
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sidebar = document.querySelector(".sidebar");
        const navbarHeight = 80; // Adjust according to your actual navbar height
        const maxOffset = 80; // Maximum movement for the sidebar

        window.addEventListener("scroll", function () {
            let scrollY = window.scrollY;

            // Calculate how much the sidebar should move up, capped at maxOffset
            let newTop = Math.max(navbarHeight - Math.min(scrollY, maxOffset), 0) + "px";

            // Apply the new top position smoothly
            sidebar.style.position = "sticky";
            sidebar.style.top = newTop;
            sidebar.style.transition = "top 0.2s ease-in-out"; // Smooth transition
        });
    });
</script>
<Script>
window.addEventListener("scroll",function(){
    let scrollposition =window.scrollY;
    document.querySelectorAll(".section-card").forEach(section => {
        let sectionTop = section.offsetTop;
        let sectionHeight = section.clientHeight;
        

        if(scrollposition >= sectionTop-50 && scrollposition < sectionTop + sectionHeight){
            document.querySelectorAll(".list-group-item").forEach(link => {
                link.classList.remove("active");
            })

          let sidebarsection=document.querySelector(`.list-group-item[href="#${section.id}"]`);
          if(sidebarsection){
            sidebarsection.classList.add("active");
          }
        }
    })
})
</script>
<!-- <script>
document.addEventListener("DOMContentLoaded", function () {
    const sections = document.querySelectorAll(".section-card"); // Now correctly selecting sections
    const links = document.querySelectorAll(".list-group-item");

    // IntersectionObserver setup
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                links.forEach(link => link.classList.remove("active"));
                const activeLink = document.querySelector(`.list-group-item[href="#${entry.target.id}"]`);
                if (activeLink) {
                    activeLink.classList.add("active");
                    console.log("Active section:", entry.target.id);
                }
            }
        });
    }, { threshold: 0.6 });

    sections.forEach(section => observer.observe(section));
});

</script> -->


@endsection 
