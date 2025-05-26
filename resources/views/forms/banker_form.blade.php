@extends('layouts.app')

@section('content')


<!-- <div class="container p-2 bg-light">
    
     <div class="row p-2"  style="">
       
     -->
     <!-- <div class="container my-5">
    <div class="p-4 bg-white border rounded shadow-sm"> -->
    <div class="container" style="padding-top: 4rem; margin-bottom: 4rem;">
    <div style="
        background-color: #ffffff;
        border-radius: 12px;
        padding: 2.5rem;
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1), 0 6px 12px rgba(0, 0, 0, 0.05);
        transition: box-shadow 0.3s ease-in-out, transform 0.3s ease;
    " onmouseover="this.style.boxShadow='0 18px 36px rgba(0, 0, 0, 0.15), 0 10px 20px rgba(0, 0, 0, 0.08)'; this.style.transform='translateY(-5px)'" onmouseout="this.style.boxShadow='0 12px 24px rgba(0, 0, 0, 0.1), 0 6px 12px rgba(0, 0, 0, 0.05)'; this.style.transform='translateY(0)'">
        
        <div class="row mb-4">
            <div class="col-12">
                <h2 style="
                    font-size: 1.8rem;
                    font-weight: 700;
                    color: #2f2f2f;
                    /* text-transform: uppercase; */
                    letter-spacing: 1px;
                    padding-left: 20px;
                    border-left: 5px solid #007bff;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    transition: all 0.3s ease;
                " onmouseover="this.style.transform='translateX(4px)'; this.style.boxShadow='0 6px 8px rgba(0, 0, 0, 0.2)'; this.style.color='#0056b3'" onmouseout="this.style.transform='translateX(0)'; this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'; this.style.color='#2f2f2f'">
                    Investment Banker Submission Form
                </h2>
            </div>
        </div>

    <form class="form-group bg-light" id="investmentBankerForm" action="{{ route('form.bank.submit') }}" method="POST" enctype="multipart/form-data" style="padding: 2.5rem;" novalidate>

        @csrf
     <!-- Company Details Section -->
<div class="row g-3">
    <div class="col-sm-2">
        <h3 class="h5">Company Details</h3>
    </div>

    <div class="col-sm-3">
        <label for="company_name" class="form-label">
            Company Name <span class="text-danger">*</span>
        </label>
        <input 
            type="text" 
            class="form-control @error('company_name') is-invalid @enderror" 
            id="company_name" 
            name="company_name" 
            value="{{ old('company_name') }}" 
            required
        >
        @error('company_name')
            <span class="text-danger small">This field is required</span>
        @enderror
    </div>

    <div class="col-sm-3">
        <label for="incorporated_in" class="form-label">
            Incorporated In <span class="text-danger">*</span>
        </label>
        <input 
            type="number" 
            class="form-control @error('incorporated_in') is-invalid @enderror" 
            id="incorporated_in" 
            name="incorporated_in" 
            min="1900" 
            max="2023" 
            value="{{ old('incorporated_in') }}" 
            required
        >
        @error('incorporated_in')
            <span class="text-danger small">This field is required</span>
        @enderror
    </div>

    <div class="col-sm-2">
        <label for="ib_team_size" class="form-label">
            IB Team Size <span class="text-danger">*</span>
        </label>
        <select 
            class="form-select @error('ib_team_size') is-invalid @enderror" 
            id="ib_team_size" 
            name="ib_team_size" 
            required
        >
            <option value="" disabled {{ old('ib_team_size') ? '' : 'selected' }}>Select Size</option>
            <option value="1-10" {{ old('ib_team_size') == '1-10' ? 'selected' : '' }}>1-10</option>
            <option value="11-50" {{ old('ib_team_size') == '11-50' ? 'selected' : '' }}>11-50</option>
            <option value="51-100" {{ old('ib_team_size') == '51-100' ? 'selected' : '' }}>51-100</option>
            <option value="100+" {{ old('ib_team_size') == '100+' ? 'selected' : '' }}>100+</option>
        </select>
        @error('ib_team_size')
            <span class="text-danger small">This field is required</span>
        @enderror
    </div>

    <div class="col-sm-2">
        <label for="company_profile" class="form-label">
            Company Profile <span class="text-danger">*</span>
        </label>
        <input 
            type="file" 
            class="form-control @error('company_profile') is-invalid @enderror" 
            id="company_profile" 
            name="company_profile" 
            required
        >
        @error('company_profile')
            <span class="text-danger small">This field is required</span>
        @enderror
       
    </div>
</div>

<!-- Contact Details Section -->
<div class="row g-3 align-items-start mt-2">
    <div class="col-sm-2">
        <h3 class="h5">Contact Details</h3>
        <div class="form-check mb-3">
            <input 
                type="checkbox" 
                class="form-check-input" 
                id="concerned_person_is_me" 
                name="concerned_person_is_me"
                value="1" 
                {{ old('concerned_person_is_me') ? 'checked' : '' }}
                onclick="fillConcernedPersonDetails()"
            >
            <label class="form-check-label text-danger small" for="concerned_person_is_me">
                Same as registered person
            </label>
        </div>
    </div>

    <!-- Email Field -->
    <div class="col-sm-3">
        <label for="email" class="form-label">
            Email <span class="text-danger">*</span>
        </label>
        <div>
            <input 
                type="email" 
                class="form-control @error('email') is-invalid @enderror" 
                id="email" 
                name="email" 
                value="{{ old('email') }}" 
                required
            >
            @error('email')
                <div class="text-danger small mt-1">This field is required</div>
            @enderror
        </div>
    </div>

    <!-- Phone Number Field -->
    <div class="col-sm-3">
        <label for="phone_number" class="form-label">
            Phone Number <span class="text-danger">*</span>
        </label>
        <div>
            <input 
                type="tel" 
                class="form-control @error('phone_number') is-invalid @enderror" 
                id="phone_number" 
                name="phone_number" 
                maxlength="10" 
                value="{{ old('phone_number') }}" 
                required
            >
            @error('phone_number')
                <div class="text-danger small mt-1">This field is required</div>
            @enderror
        </div>
    </div>




    <div class="col-md-3">
        <label for="concerned_person_designation" class="form-label">Designation</label>
        <select class="form-select" id="concerned_person_designation" name="concerned_person_designation" required>
            <option value="" disabled {{ old('concerned_person_designation') ? '' : 'selected' }}>Select Designation</option>
            <option value="Chief Administrative Officer" {{ old('concerned_person_designation') == 'Chief Administrative Officer' ? 'selected' : '' }}>Chief Administrative Officer</option>
            <option value="Chief Analytics Officer" {{ old('concerned_person_designation') == 'Chief Analytics Officer' ? 'selected' : '' }}>Chief Analytics Officer</option>
            <option value="Chief Brand Officer" {{ old('concerned_person_designation') == 'Chief Brand Officer' ? 'selected' : '' }}>Chief Brand Officer</option>
            <option value="Chief Business Development Officer" {{ old('concerned_person_designation') == 'Chief Business Development Officer' ? 'selected' : '' }}>Chief Business Development Officer</option>
            <option value="Chief Business Officer" {{ old('concerned_person_designation') == 'Chief Business Officer' ? 'selected' : '' }}>Chief Business Officer</option>
            <option value="Chief Commercial Officer" {{ old('concerned_person_designation') == 'Chief Commercial Officer' ? 'selected' : '' }}>Chief Commercial Officer</option>
            <option value="Chief Communications Officer" {{ old('concerned_person_designation') == 'Chief Communications Officer' ? 'selected' : '' }}>Chief Communications Officer</option>
            <option value="Chief Compliance Officer" {{ old('concerned_person_designation') == 'Chief Compliance Officer' ? 'selected' : '' }}>Chief Compliance Officer</option>
            <option value="Chief Content Officer" {{ old('concerned_person_designation') == 'Chief Content Officer' ? 'selected' : '' }}>Chief Content Officer</option>
            <option value="Chief Creative Officer" {{ old('concerned_person_designation') == 'Chief Creative Officer' ? 'selected' : '' }}>Chief Creative Officer</option>
            <option value="Chief Customer Officer" {{ old('concerned_person_designation') == 'Chief Customer Officer' ? 'selected' : '' }}>Chief Customer Officer</option>
            <option value="Chief Data Officer" {{ old('concerned_person_designation') == 'Chief Data Officer' ? 'selected' : '' }}>Chief Data Officer</option>
            <option value="Chief Design Officer" {{ old('concerned_person_designation') == 'Chief Design Officer' ? 'selected' : '' }}>Chief Design Officer</option>
            <option value="Chief Digital Officer" {{ old('concerned_person_designation') == 'Chief Digital Officer' ? 'selected' : '' }}>Chief Digital Officer</option>
            <option value="Chief Diversity Officer" {{ old('concerned_person_designation') == 'Chief Diversity Officer' ? 'selected' : '' }}>Chief Diversity Officer</option>
            <option value="Chief Executive Officer" {{ old('concerned_person_designation') == 'Chief Executive Officer' ? 'selected' : '' }}>Chief Executive Officer</option>
            <option value="Chief Experience Officer" {{ old('concerned_person_designation') == 'Chief Experience Officer' ? 'selected' : '' }}>Chief Experience Officer</option>
            <option value="Chief Financial Officer" {{ old('concerned_person_designation') == 'Chief Financial Officer' ? 'selected' : '' }}>Chief Financial Officer</option>
            <option value="Chief Gaming Officer" {{ old('concerned_person_designation') == 'Chief Gaming Officer' ? 'selected' : '' }}>Chief Gaming Officer</option>
            <option value="Chief Genealogical Officer" {{ old('concerned_person_designation') == 'Chief Genealogical Officer' ? 'selected' : '' }}>Chief Genealogical Officer</option>
            <option value="Chief Human Resources Officer" {{ old('concerned_person_designation') == 'Chief Human Resources Officer' ? 'selected' : '' }}>Chief Human Resources Officer</option>
            <option value="Chief Information Officer" {{ old('concerned_person_designation') == 'Chief Information Officer' ? 'selected' : '' }}>Chief Information Officer</option>
            <option value="Chief Information Officer (Higher Education)" {{ old('concerned_person_designation') == 'Chief Information Officer (Higher Education)' ? 'selected' : '' }}>Chief Information Officer (Higher Education)</option>
            <option value="Chief Information Security Officer" {{ old('concerned_person_designation') == 'Chief Information Security Officer' ? 'selected' : '' }}>Chief Information Security Officer</option>
            <option value="Chief Innovation Officer" {{ old('concerned_person_designation') == 'Chief Innovation Officer' ? 'selected' : '' }}>Chief Innovation Officer</option>
            <option value="Chief Investment Officer" {{ old('concerned_person_designation') == 'Chief Investment Officer' ? 'selected' : '' }}>Chief Investment Officer</option>
            <option value="Chief Knowledge Officer" {{ old('concerned_person_designation') == 'Chief Knowledge Officer' ? 'selected' : '' }}>Chief Knowledge Officer</option>
            <option value="Chief Learning Officer" {{ old('concerned_person_designation') == 'Chief Learning Officer' ? 'selected' : '' }}>Chief Learning Officer</option>
            <option value="Chief Marketing Officer" {{ old('concerned_person_designation') == 'Chief Marketing Officer' ? 'selected' : '' }}>Chief Marketing Officer</option>
            <option value="Chief Operating Officer" {{ old('concerned_person_designation') == 'Chief Operating Officer' ? 'selected' : '' }}>Chief Operating Officer</option>
            <option value="Chief Privacy Officer" {{ old('concerned_person_designation') == 'Chief Privacy Officer' ? 'selected' : '' }}>Chief Privacy Officer</option>
            <option value="Chief Process Officer" {{ old('concerned_person_designation') == 'Chief Process Officer' ? 'selected' : '' }}>Chief Process Officer</option>
            <option value="Chief Product Officer" {{ old('concerned_person_designation') == 'Chief Product Officer' ? 'selected' : '' }}>Chief Product Officer</option>
            <option value="Chief Reputation Officer" {{ old('concerned_person_designation') == 'Chief Reputation Officer' ? 'selected' : '' }}>Chief Reputation Officer</option>
            <option value="Chief Research Officer" {{ old('concerned_person_designation') == 'Chief Research Officer' ? 'selected' : '' }}>Chief Research Officer</option>
            <option value="Chief Restructuring Officer" {{ old('concerned_person_designation') == 'Chief Restructuring Officer' ? 'selected' : '' }}>Chief Restructuring Officer</option>
            <option value="Chief Risk Officer" {{ old('concerned_person_designation') == 'Chief Risk Officer' ? 'selected' : '' }}>Chief Risk Officer</option>
            <option value="Chief Science Officer" {{ old('concerned_person_designation') == 'Chief Science Officer' ? 'selected' : '' }}>Chief Science Officer</option>
            <option value="Chief Scientific Officer" {{ old('concerned_person_designation') == 'Chief Scientific Officer' ? 'selected' : '' }}>Chief Scientific Officer</option>
            <option value="Chief Security Officer" {{ old('concerned_person_designation') == 'Chief Security Officer' ? 'selected' : '' }}>Chief Security Officer</option>
            <option value="Chief Services Officer" {{ old('concerned_person_designation') == 'Chief Services Officer' ? 'selected' : '' }}>Chief Services Officer</option>
            <option value="Chief Strategy Officer" {{ old('concerned_person_designation') == 'Chief Strategy Officer' ? 'selected' : '' }}>Chief Strategy Officer</option>
            <option value="Chief Sustainability Officer" {{ old('concerned_person_designation') == 'Chief Sustainability Officer' ? 'selected' : '' }}>Chief Sustainability Officer</option>
            <option value="Chief Technology Officer" {{ old('concerned_person_designation') == 'Chief Technology Officer' ? 'selected' : '' }}>Chief Technology Officer</option>
            <option value="Chief Visibility Officer" {{ old('concerned_person_designation') == 'Chief Visibility Officer' ? 'selected' : '' }}>Chief Visibility Officer</option>
            <option value="Chief Visionary Officer" {{ old('concerned_person_designation') == 'Chief Visionary Officer' ? 'selected' : '' }}>Chief Visionary Officer</option>
            <option value="Chief Web Officer" {{ old('concerned_person_designation') == 'Chief Web Officer' ? 'selected' : '' }}>Chief Web Officer</option>
            <option value="General Manager" {{ old('concerned_person_designation') == 'General Manager' ? 'selected' : '' }}>General Manager</option>
            <option value="Manager" {{ old('concerned_person_designation') == 'Manager' ? 'selected' : '' }}>Manager</option>
            <option value="Others" {{ old('concerned_person_designation') == 'Others' ? 'selected' : '' }}>Others</option>
            <option value="Secretary" {{ old('concerned_person_designation') == 'Secretary' ? 'selected' : '' }}>Secretary</option>
            <option value="Supervisor" {{ old('concerned_person_designation') == 'Supervisor' ? 'selected' : '' }}>Supervisor</option>
            <option value="Vice President" {{ old('concerned_person_designation') == 'Vice President' ? 'selected' : '' }}>Vice President</option>
        </select>
    </div>
</div>

<hr>
       <!-- Public Links Section -->
<div class="row g-3 align-items-start">
    <div class="col-sm-2 mt-5">
        <h3 class="h5">Public Links</h3>
    </div>

    <!-- URL Field -->
    <div class="col-md-4">
        <label for="public_links" class="form-label">
            URL <span class="text-danger">*</span>
        </label>
        <div>
            <input 
                type="url" 
                class="form-control @error('public_links.0') is-invalid @enderror" 
                name="public_links[]" 
                placeholder="URL" 
                value="{{ old('public_links.0') }}" 
                required
            >
            @error('public_links.0')
                <div class="text-danger small mt-1">This field is required</div>
            @enderror
        </div>
    </div>

    <!-- Select Account Field -->
    <div class="col-md-4">
        <label for="link_descriptions" class="form-label">
            Select Account <span class="text-danger">*</span>
        </label>
        <div>
            <select 
                class="form-select @error('link_descriptions.0') is-invalid @enderror" 
                name="link_descriptions[]" 
                required
            >
                <option value="" disabled {{ old('link_descriptions.0') ? '' : 'selected' }}>Select Account</option>
                <option value="Facebook" {{ old('link_descriptions.0') == 'Facebook' ? 'selected' : '' }}>Facebook</option>
                <option value="Twitter" {{ old('link_descriptions.0') == 'Twitter' ? 'selected' : '' }}>Twitter</option>
                <option value="LinkedIn" {{ old('link_descriptions.0') == 'LinkedIn' ? 'selected' : '' }}>LinkedIn</option>
                <option value="Others" {{ old('link_descriptions.0') == 'Others' ? 'selected' : '' }}>Others</option>
            </select>
            @error('link_descriptions.0')
                <div class="text-danger small mt-1">This field is required</div>
            @enderror
        </div>
    </div>

    <!-- Add Button -->
    <div class="col-md-2 d-flex align-items-end mt-5">
        <button type="button" class="btn btn-info w-10" style="height: 38px;" onclick="addPublicLinkField()">+</button>
    </div>
</div>


<!-- Container for additional public links -->
<div id="public-links-container">
    @if(old('public_links'))
        @foreach(old('public_links') as $index => $public_link)
            @if($index > 0)
                <div class="row g-3 align-items-end mt-2">
                       <div class="col-sm-2 mt-5">
                            <!-- <h3 class="h5">Public Links</h3> -->
                        </div>
                    <div class="col-md-4">
                        @error('public_links.'.$index)
                            <span class="text-danger small">This field is required</span>
                        @enderror
                        <input 
                            type="url" 
                            class="form-control @error('public_links.'.$index) is-invalid @enderror" 
                            name="public_links[]" 
                            placeholder="URL" 
                            value="{{ $public_link }}" 
                            required
                        >
                        
                    </div>
                    <div class="col-md-4">
                        <select 
                            class="form-select @error('link_descriptions.'.$index) is-invalid @enderror" 
                            name="link_descriptions[]" 
                            required
                        >
                            <option value="" disabled {{ old('link_descriptions.'.$index) ? '' : 'selected' }}>Select Account</option>
                            <option value="Facebook" {{ old('link_descriptions.'.$index) == 'Facebook' ? 'selected' : '' }}>Facebook</option>
                            <option value="Twitter" {{ old('link_descriptions.'.$index) == 'Twitter' ? 'selected' : '' }}>Twitter</option>
                            <option value="LinkedIn" {{ old('link_descriptions.'.$index) == 'LinkedIn' ? 'selected' : '' }}>LinkedIn</option>
                            <option value="Others" {{ old('link_descriptions.'.$index) == 'Others' ? 'selected' : '' }}>Others</option>
                        </select>
                        @error('link_descriptions.'.$index)
                            <span class="text-danger small">This field is required</span>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger" onclick="removePublicLinkField(this)">-</button>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
</div>

<hr>

<!-- Location Details Section -->
<div class="row g-3 align-items-end">
    <div class="col-sm-2">
        <h3 class="h5">Location Details</h3>
    </div>
    <div class="col-md-4">
        <label for="address" class="form-label">
            Address <span class="text-danger">*</span>
        </label>
        @error('address')
            <span class="text-danger small">This field is required</span>
        @enderror
        <input 
            type="text" 
            class="form-control @error('address') is-invalid @enderror" 
            id="address" 
            name="address" 
            value="{{ old('address') }}" 
            required
        >
    </div>
    <div class="col-md-4">
        <label for="location" class="form-label">
            City <span class="text-danger">*</span>
        </label>
        @error('location')
            <span class="text-danger small">This field is required</span>
        @enderror
        <input 
            type="text" 
            class="form-control @error('location') is-invalid @enderror" 
            id="location" 
            name="location" 
            value="{{ old('location') }}" 
            required
        >
    </div>
</div>
<div class="row g-3 align-items-end mt-2">
    <div class="col-sm-2"></div>
    <div class="col-md-4">
        <label for="state" class="form-label">
            State <span class="text-danger">*</span>
        </label>
        @error('state')
            <span class="text-danger small">This field is required</span>
        @enderror
        <input 
            type="text" 
            class="form-control @error('state') is-invalid @enderror" 
            id="state" 
            name="state" 
            value="{{ old('state') }}" 
            required
        >
    </div>
    <div class="col-md-4">
        <label for="country" class="form-label">
            Country <span class="text-danger">*</span>
        </label>
        @error('country')
            <span class="text-danger small">This field is required</span>
        @enderror
        <input 
            type="text" 
            class="form-control @error('country') is-invalid @enderror" 
            id="country" 
            name="country" 
            value="{{ old('country') }}" 
            required
        >
    </div>
</div>

<hr>

<!-- Fund Raise Size Section -->
<h3 class="h5">Fund Raise Size</h3>
<div class="row g-3">
    <div class="col-md-6">
        <label for="min_fund_raise_size" class="form-label">
            Min <span class="text-danger">*</span>
        </label>
        @error('min_fund_raise_size')
            <span class="text-danger small">This field is required</span>
        @enderror
        <select 
            class="form-select @error('min_fund_raise_size') is-invalid @enderror" 
            id="min_fund_raise_size" 
            name="min_fund_raise_size" 
            required
            onchange="validateFundRaiseSize()"
        >
            <option value="" disabled {{ old('min_fund_raise_size') ? '' : 'selected' }}>Min</option>
            <option value="10_lakh" {{ old('min_fund_raise_size') == '10_lakh' ? 'selected' : '' }}>10 lakh</option>
            <option value="50_lakh" {{ old('min_fund_raise_size') == '50_lakh' ? 'selected' : '' }}>50 lakh</option>
            <option value="1_cr" {{ old('min_fund_raise_size') == '1_cr' ? 'selected' : '' }}>1 cr</option>
            <option value="10_cr" {{ old('min_fund_raise_size') == '10_cr' ? 'selected' : '' }}>10 cr</option>
        </select>
    </div>
    <div class="col-md-6">
        <label for="max_fund_raise_size" class="form-label">
            Max <span class="text-danger">*</span>
        </label>
        @error('max_fund_raise_size')
            <span class="text-danger small">This field is required</span>
        @enderror
        <select 
            class="form-select @error('max_fund_raise_size') is-invalid @enderror" 
            id="max_fund_raise_size" 
            name="max_fund_raise_size" 
            required
            onchange="validateFundRaiseSize()"
        >
            <option value="" disabled {{ old('max_fund_raise_size') ? '' : 'selected' }}>Max</option>
            <option value="1_cr" {{ old('max_fund_raise_size') == '1_cr' ? 'selected' : '' }}>1 cr</option>
            <option value="10_cr" {{ old('max_fund_raise_size') == '10_cr' ? 'selected' : '' }}>10 cr</option>
            <option value="50_cr" {{ old('max_fund_raise_size') == '50_cr' ? 'selected' : '' }}>50 cr</option>
            <option value="100_cr" {{ old('max_fund_raise_size') == '100_cr' ? 'selected' : '' }}>100 cr+</option>
        </select>
    </div>
    <div class="col-12">
        <span id="fund-raise-size-error" class="text-danger small" style="display:none;">Min should not be greater than equal to Max.</span>
    </div>
</div>
<script>
    function getFundRaiseValue(val) {
        // Assign numeric values for comparison
        switch(val) {
            case '10_lakh': return 1;
            case '50_lakh': return 2;
            case '1_cr': return 3;
            case '10_cr': return 4;
            case '50_cr': return 5;
            case '100_cr': return 6;
            default: return 0;
        }
    }

    function validateFundRaiseSize() {
        var min = document.getElementById('min_fund_raise_size').value;
        var max = document.getElementById('max_fund_raise_size').value;
        var error = document.getElementById('fund-raise-size-error');
        if (min && max && getFundRaiseValue(min) >= getFundRaiseValue(max)) {
            error.style.display = 'inline';
        } else {
            error.style.display = 'none';
        }
    }

    // Prevent form submission if invalid
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('investmentBankerForm');
        form.addEventListener('submit', function(e) {
            var min = document.getElementById('min_fund_raise_size').value;
            var max = document.getElementById('max_fund_raise_size').value;
            var error = document.getElementById('fund-raise-size-error');
            if (min && max && getFundRaiseValue(min) > getFundRaiseValue(max)) {
                error.style.display = 'inline';
                e.preventDefault();
            }
        });
    });
</script>
<hr>
<h3 class="h5">Previous Deals</h3>
<div id="previous-deals-container">
    @php
        $previous_deal_years = old('previous_deal_year', []);
        $previous_deal_companies = old('previous_deal_company', []);
        $previous_deal_sectors = old('previous_deal_sector', []);
        $previous_deal_types = old('previous_deal_type', []);
        $count = max(
            count($previous_deal_years),
            count($previous_deal_companies),
            count($previous_deal_sectors),
            count($previous_deal_types),
            1
        );
    @endphp
    @for($i = 0; $i < $count; $i++)
    <div class="row g-1 mb-1">
        <div class="col-md-3 form-group">
            <label for="previous_deal_year_{{ $i }}" class="form-label">
                Year <span class="text-danger">*</span>
            </label>
            <select class="form-control" name="previous_deal_year[]" id="previous_deal_year_{{ $i }}" required>
                <option value="" disabled {{ (isset($previous_deal_years[$i]) && $previous_deal_years[$i]) ? '' : 'selected' }}>Select Year</option>
                @for($y = date('Y'); $y >= 1990; $y--)
                    <option value="{{ $y }}" {{ (isset($previous_deal_years[$i]) && $previous_deal_years[$i] == $y) ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>
        <div class="col-md-3 form-group">
            <label for="previous_deal_company_{{ $i }}" class="form-label">
                Company <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control @error('previous_deal_company.'.$i) is-invalid @enderror" name="previous_deal_company[]" id="previous_deal_company_{{ $i }}" placeholder="Company" value="{{ $previous_deal_companies[$i] ?? '' }}" required>
            @error('previous_deal_company.'.$i)
            <span class="text-danger small">This field is required</span>
            @enderror
        </div>
        <div class="col-md-3 form-group">
            <label for="previous_deal_sector_{{ $i }}" class="form-label">
                Sector <span class="text-danger">*</span>
            </label>
            <input list="business-options" class="form-control spaced-input" id="previous_deal_sector_{{ $i }}" name="previous_deal_sector[]" value="{{ $previous_deal_sectors[$i] ?? '' }}" required>
            <datalist id="business-options">
                <option value="Accounting">Accounting</option>
                <option value="Airlines/Aviation">Airlines/Aviation</option>
                <option value="Alternative Dispute Resolution">Alternative Dispute Resolution</option>
                <option value="Alternative Medicine">Alternative Medicine</option>
                <option value="Animation">Animation</option>
                <option value="Apparel/Fashion">Apparel/Fashion</option>
                <option value="Architecture/Planning">Architecture/Planning</option>
                <option value="Arts/Crafts">Arts/Crafts</option>
                <option value="Automotive">Automotive</option>
                <option value="Aviation/Aerospace">Aviation/Aerospace</option>
                <option value="Banking/Mortgage">Banking/Mortgage</option>
                <option value="Biotechnology/Greentech">Biotechnology/Greentech</option>
                <option value="Broadcast Media">Broadcast Media</option>
                <option value="Building Materials">Building Materials</option>
                <option value="Business Supplies/Equipment">Business Supplies/Equipment</option>
                <option value="Capital Markets/Hedge Fund/Private Equity">Capital Markets/Hedge Fund/Private Equity</option>
                <option value="Chemicals">Chemicals</option>
                <option value="Civic/Social Organization">Civic/Social Organization</option>
                <option value="Civil Engineering">Civil Engineering</option>
                <option value="Commercial Real Estate">Commercial Real Estate</option>
                <option value="Computer Games">Computer Games</option>
                <option value="Computer Hardware">Computer Hardware</option>
                <option value="Computer Networking">Computer Networking</option>
                <option value="Computer Software/Engineering">Computer Software/Engineering</option>
                <option value="Computer/Network Security">Computer/Network Security</option>
                <option value="Construction">Construction</option>
                <option value="Consumer Electronics">Consumer Electronics</option>
                <option value="Consumer Goods">Consumer Goods</option>
                <option value="Consumer Services">Consumer Services</option>
                <option value="Cosmetics">Cosmetics</option>
                <option value="Dairy">Dairy</option>
                <option value="Defense/Space">Defense/Space</option>
                <option value="Design">Design</option>
                <option value="E-Learning">E-Learning</option>
                <option value="Education Management">Education Management</option>
                <option value="Electrical/Electronic Manufacturing">Electrical/Electronic Manufacturing</option>
                <option value="Entertainment/Movie Production">Entertainment/Movie Production</option>
                <option value="Environmental Services">Environmental Services</option>
                <option value="Events Services">Events Services</option>
                <option value="Executive Office">Executive Office</option>
                <option value="Facilities Services">Facilities Services</option>
                <option value="Farming">Farming</option>
                <option value="Financial Services">Financial Services</option>
                <option value="Fine Art">Fine Art</option>
                <option value="Fishery">Fishery</option>
                <option value="Food Production">Food Production</option>
                <option value="Food/Beverages">Food/Beverages</option>
                <option value="Fundraising">Fundraising</option>
                <option value="Furniture">Furniture</option>
                <option value="Gambling/Casinos">Gambling/Casinos</option>
                <option value="Glass/Ceramics/Concrete">Glass/Ceramics/Concrete</option>
                <option value="Government Administration">Government Administration</option>
                <option value="Government Relations">Government Relations</option>
                <option value="Graphic Design/Web Design">Graphic Design/Web Design</option>
                <option value="Health/Fitness">Health/Fitness</option>
                <option value="Higher Education/Acadamia">Higher Education/Acadamia</option>
                <option value="Hospital/Health Care">Hospital/Health Care</option>
                <option value="Hospitality">Hospitality</option>
                <option value="Human Resources/HR">Human Resources/HR</option>
                <option value="Import/Export">Import/Export</option>
                <option value="Individual/Family Services">Individual/Family Services</option>
                <option value="Industrial Automation">Industrial Automation</option>
                <option value="Information Services">Information Services</option>
                <option value="Information Technology/IT">Information Technology/IT</option>
                <option value="Insurance">Insurance</option>
                <option value="International Affairs">International Affairs</option>
                <option value="International Trade/Development">International Trade/Development</option>
                <option value="Internet">Internet</option>
                <option value="Investment Banking/Venture">Investment Banking/Venture</option>
                <option value="Investment Management/Hedge Fund/Private Equity">Investment Management/Hedge Fund/Private Equity</option>
                <option value="Judiciary">Judiciary</option>
                <option value="Law Enforcement">Law Enforcement</option>
                <option value="Law Practice/Law Firms">Law Practice/Law Firms</option>
                <option value="Legal Services">Legal Services</option>
                <option value="Legislative Office">Legislative Office</option>
                <option value="Leisure/Travel">Leisure/Travel</option>
                <option value="Library">Library</option>
                <option value="Logistics/Procurement">Logistics/Procurement</option>
                <option value="Luxury Goods/Jewelry">Luxury Goods/Jewelry</option>
                <option value="Machinery">Machinery</option>
                <option value="Management Consulting">Management Consulting</option>
                <option value="Maritime">Maritime</option>
                <option value="Market Research">Market Research</option>
                <option value="Marketing/Advertising/Sales">Marketing/Advertising/Sales</option>
                <option value="Mechanical or Industrial Engineering">Mechanical or Industrial Engineering</option>
                <option value="Media Production">Media Production</option>
                <option value="Medical Equipment">Medical Equipment</option>
                <option value="Medical Practice">Medical Practice</option>
                <option value="Mental Health Care">Mental Health Care</option>
                <option value="Military Industry">Military Industry</option>
                <option value="Mining/Metals">Mining/Metals</option>
                <option value="Motion Pictures/Film">Motion Pictures/Film</option>
                <option value="Museums/Institutions">Museums/Institutions</option>
                <option value="Music">Music</option>
                <option value="Nanotechnology">Nanotechnology</option>
                <option value="Newspapers/Journalism">Newspapers/Journalism</option>
                <option value="Non-Profit/Volunteering">Non-Profit/Volunteering</option>
                <option value="Oil/Energy/Solar/Greentech">Oil/Energy/Solar/Greentech</option>
                <option value="Online Publishing">Online Publishing</option>
                <option value="Other Industry">Other Industry</option>
                <option value="Outsourcing/Offshoring">Outsourcing/Offshoring</option>
                <option value="Package/Freight Delivery">Package/Freight Delivery</option>
                <option value="Packaging/Containers">Packaging/Containers</option>
                <option value="Paper/Forest Products">Paper/Forest Products</option>
                <option value="Performing Arts">Performing Arts</option>
                <option value="Pharmaceuticals">Pharmaceuticals</option>
                <option value="Philanthropy">Philanthropy</option>
                <option value="Photography">Photography</option>
                <option value="Plastics">Plastics</option>
                <option value="Political Organization">Political Organization</option>
                <option value="Primary/Secondary Education">Primary/Secondary Education</option>
                <option value="Printing">Printing</option>
                <option value="Professional Training">Professional Training</option>
                <option value="Program Development">Program Development</option>
                <option value="Public Relations/PR">Public Relations/PR</option>
                <option value="Public Safety">Public Safety</option>
                <option value="Publishing Industry">Publishing Industry</option>
                <option value="Railroad Manufacture">Railroad Manufacture</option>
                <option value="Ranching">Ranching</option>
                <option value="Real Estate/Mortgage">Real Estate/Mortgage</option>
                <option value="Recreational Facilities/Services">Recreational Facilities/Services</option>
                <option value="Religious Institutions">Religious Institutions</option>
                <option value="Renewables/Environment">Renewables/Environment</option>
                <option value="Research Industry">Research Industry</option>
                <option value="Restaurants">Restaurants</option>
                <option value="Retail Industry">Retail Industry</option>
                <option value="Security/Investigations">Security/Investigations</option>
                <option value="Semiconductors">Semiconductors</option>
                <option value="Shipbuilding">Shipbuilding</option>
                <option value="Sporting Goods">Sporting Goods</option>
                <option value="Sports">Sports</option>
                <option value="Staffing/Recruiting">Staffing/Recruiting</option>
                <option value="Supermarkets">Supermarkets</option>
                <option value="Telecommunications">Telecommunications</option>
                <option value="Textiles">Textiles</option>
                <option value="Think Tanks">Think Tanks</option>
                <option value="Tobacco">Tobacco</option>
                <option value="Translation/Localization">Translation/Localization</option>
                <option value="Transportation">Transportation</option>
                <option value="Utilities">Utilities</option>
                <option value="Venture Capital/VC">Venture Capital/VC</option>
                <option value="Veterinary">Veterinary</option>
                <option value="Warehousing">Warehousing</option>
                <option value="Wholesale">Wholesale</option>
                <option value="Wine/Spirits">Wine/Spirits</option>
                <option value="Wireless">Wireless</option>
                <option value="Writing/Editing">Writing/Editing</option>
            </datalist>
            @error('previous_deal_sector.'.$i)
            <span class="text-danger small">This field is required</span>
            @enderror
        </div>
        <div class="col-md-2 mt-2 p-1">
            <label for="previous_deal_type_{{ $i }}" class="required">Deal Type<span class="text-danger">*</span></label>
            <select class="form-control" name="previous_deal_type[]" id="previous_deal_type_{{ $i }}" required>
                <option value="" disabled {{ (isset($previous_deal_types[$i]) && $previous_deal_types[$i]) ? '' : 'selected' }}>Select Deal Type</option>
                <option value="M&A" {{ (isset($previous_deal_types[$i]) && $previous_deal_types[$i] == 'M&A') ? 'selected' : '' }}>M&amp;A</option>
                <option value="Fundraising" {{ (isset($previous_deal_types[$i]) && $previous_deal_types[$i] == 'Fundraising') ? 'selected' : '' }}>Fundraising</option>
                <option value="IPO" {{ (isset($previous_deal_types[$i]) && $previous_deal_types[$i] == 'IPO') ? 'selected' : '' }}>IPO</option>
                <option value="Others" {{ (isset($previous_deal_types[$i]) && $previous_deal_types[$i] == 'Others') ? 'selected' : '' }}>Others</option>
            </select>
        </div>
        <div class="col-md-1 form-floating mt-2 p-1">
            @if($i == 0)
                <button type="button" class="btn btn-info mt-4" onclick="addPreviousDealField()">+</button>
            @else
                <button type="button" class="btn btn-danger mt-4" onclick="removeField(this)">-</button>
            @endif
        </div>
    </div>
    @endfor
</div>
<hr>
<h3 class="h5">How did you hear about Investor Dekho?</h3>
<div class="form-floating mb-3">
    <select 
        class="form-control @error('referral_source') is-invalid @enderror" 
        id="referral_source" 
        name="referral_source" 
        required
    >
        <option value="" disabled {{ old('referral_source') ? '' : 'selected' }}>Select Source</option>
        <option value="Friend/Family" {{ old('referral_source') == 'Friend/Family' ? 'selected' : '' }}>Friend/Family</option>
        <option value="Social Media (Facebook, Instagram, Twitter, etc.)" {{ old('referral_source') == 'Social Media (Facebook, Instagram, Twitter, etc.)' ? 'selected' : '' }}>Social Media (Facebook, Instagram, Twitter, etc.)</option>
        <option value="Online Search (Google, Bing, etc.)" {{ old('referral_source') == 'Online Search (Google, Bing, etc.)' ? 'selected' : '' }}>Online Search (Google, Bing, etc.)</option>
        <option value="Advertisement (TV, Radio, Print)" {{ old('referral_source') == 'Advertisement (TV, Radio, Print)' ? 'selected' : '' }}>Advertisement (TV, Radio, Print)</option>
        <option value="Email Newsletter" {{ old('referral_source') == 'Email Newsletter' ? 'selected' : '' }}>Email Newsletter</option>
        <option value="Event/Seminar" {{ old('referral_source') == 'Event/Seminar' ? 'selected' : '' }}>Event/Seminar</option>
        <option value="Professional Referral (Doctor, Lawyer, etc.)" {{ old('referral_source') == 'Professional Referral (Doctor, Lawyer, etc.)' ? 'selected' : '' }}>Professional Referral (Doctor, Lawyer, etc.)</option>
        <option value="Blog/Website" {{ old('referral_source') == 'Blog/Website' ? 'selected' : '' }}>Blog/Website</option>
        <option value="Direct Mail" {{ old('referral_source') == 'Direct Mail' ? 'selected' : '' }}>Direct Mail</option>
        <option value="Company Website" {{ old('referral_source') == 'Company Website' ? 'selected' : '' }}>Company Website</option>
    </select>
    <label for="referral_source">Referral Source <span class="text-danger">*</span></label>
    @error('referral_source')
        <span class="text-danger small">This field is required</span>
    @enderror
</div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary py-3 px-5 w-100">Submit</button>
    </form>
</div>

<script>
    function addPublicLinkField() {
        const container = document.getElementById('public-links-container');
        const newField = `
            <div class="row g-3 mt-2">
                <div class="col-sm-2"></div>
                <div class="col-md-4 mt-4">
                    <input type="url" class="form-control" name="public_links[]" placeholder="URL" required>
                    <label for="public_links"></label>
                </div>
                <div class="col-md-4 mt-4 ">
                    <select class="form-select" name="link_descriptions[]" required>
                        <option value="" disabled selected>Select Account</option>
                        <option value="Facebook">Facebook</option>
                        <option value="Twitter">Twitter</option>
                        <option value="LinkedIn">LinkedIn</option>
                        <option value="Others">Others</option>
                    </select>
                    <label for="link_descriptions"></label>
                </div>
                <div class="col-md-2 mt-4">
                    <button type="button" class="btn btn-danger mb-4" onclick="removeField(this)">-</button>
                </div>
            </div>`;
        container.insertAdjacentHTML('beforeend', newField);
    }

    function removeField(element) {
        element.closest('.row').remove();
    }

    function addPreviousDealField() {
        const container = document.getElementById('previous-deals-container');
        const newField = `
            <div class="row g-1 mb-1">
                <div class="col-md-3 form-group">
                <label for="previous_deal_year" class="required">Year</label>
                    <select class="form-control" name="previous_deal_year[]" required>
                        <option value="" disabled selected>Select Year</option>
                        <option value="2025">2025</option>
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                        <option value="2019">2019</option>
                        <option value="2018">2018</option>
                        <option value="2017">2017</option>
                        <option value="2016">2016</option>
                        <option value="2015">2015</option>
                        <option value="2014">2014</option>
                        <option value="2013">2013</option>
                        <option value="2012">2012</option>
                        <option value="2011">2011</option>
                        <option value="2010">2010</option>
                        <option value="2009">2009</option>
                        <option value="2008">2008</option>
                        <option value="2007">2007</option>
                        <option value="2006">2006</option>
                        <option value="2005">2005</option>
                        <option value="2004">2004</option>
                        <option value="2003">2003</option>
                        <option value="2002">2002</option>
                        <option value="2001">2001</option>
                        <option value="2000">2000</option>
                        <option value="1999">1999</option>
                        <option value="1998">1998</option>
                        <option value="1997">1997</option>
                        <option value="1996">1996</option>
                        <option value="1995">1995</option>
                        <option value="1994">1994</option>
                        <option value="1993">1993</option>
                        <option value="1992">1992</option>
                        <option value="1991">1991</option>
                        <option value="1990">1990</option>
                        <!-- Add more years -->
                    </select>
                    
                </div>
                <div class="col-md-3 form-group">
                     <label for="previous_deal_company" class="required">Company</label>
                    
                    <input type="text" class="form-control" name="previous_deal_company[]" placeholder="Company" required>
                   
                </div>
                <div class="col-md-3 form-group">
                 <label for="previous_deal_sector" class="required">Sector</label>
                    <input list="business-options" class="form-control spaced-input" id="previous_deal_sector" name="previous_deal_sector[]" required>
                   
                    <datalist id="business-options">
                        <option value="Accounting">Accounting</option>
                        <!-- Add more sectors -->
                    </datalist>
                </div>
                <div class="col-md-2 form-group">
                <label for="previous_deal_type" class="required">Deal Type</label>
                    <select class="form-control" name="previous_deal_type[]" required>
                        <option value="" disabled selected>Select Deal Type</option>
                        <option value="M&A">M&A</option>
                        <option value="Fundraising">Fundraising</option>
                        <option value="IPO">IPO</option>
                        <option value="Others">Others</option>
                    </select>
                    
                </div>
                <div class="col-md-1 form-floating mt-4">
                    <button type="button" class="btn btn-danger" onclick="removeField(this)">-</button>
                </div>
            </div>`;
        container.insertAdjacentHTML('beforeend', newField);
    }

    function fillConcernedPersonDetails() {
    const phoneField = document.getElementById('phone_number');
    const emailField = document.getElementById('email');
        const checkedbox = document.getElementById('concerned_person_is_me');
  
    checkedbox.addEventListener('change',function(){ 
               if(this.checked){
            @if(Auth::check())
                phoneField.value = "{{ Auth::user()->phone }}";
                emailField.value = "{{ Auth::user()->email }}";
             @else
              alert('Please login to fill the details');
                @endif           
            phoneField.readOnly = true;
            emailField.readOnly = true;
        }else{
            phoneField.value = '';
            emailField.value = '';
            phoneField.readOnly = false;
            emailField.readOnly = false;
        }
    });
}
// changes

  document.addEventListener('DOMContentLoaded', function() {
    const checkedbox = document.getElementById('concerned_person_is_me');
    const phoneField = document.getElementById('phone_number');
    const emailField = document.getElementById('email');
    if (checkedbox && checkedbox.checked) {
        phoneField.readOnly = true;
        emailField.readOnly = true;
    }
});

function removePublicLinkField(element) {
    element.closest('.row').remove();
}

</script>
@endsection
