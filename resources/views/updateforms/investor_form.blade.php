@extends('layouts.app')

@section('content')



                <style>
                    .required::after {
                        content: " *";
                        color: red;
                    }
                    
                    .g-3, .gy-3 {
    --bs-gutter-y: 0.51rem;
}
                    
                    #sectors_preferred_list {
    position: absolute;
    background-color: white;
    max-height: 200px;
    width: 100%;
    overflow-y: auto;
    border: 1px solid #ddd;
    z-index: 10;
    display: none;
    padding: 10px;
}
.form-group {
    position: relative; /* Ensures dropdown stays in the same place */
}

.text-danger{
    font-size: 12px;
}
#investorForm h3 {
    font-size: 24px; /* Moderate font size */
    font-weight: 400; /* Regular weight for a clean look */
    color: #555; /* Dark gray for a neutral tone */
    text-transform: none; /* Remove uppercase transformation */
    letter-spacing: 0.5px; /* Slight spacing for readability */
    margin-bottom: 15px; /* Space between heading and content */
    font-family: 'Arial', sans-serif; /* Simple, modern font */
}




                </style>





<div class="container">
    <div class="col-sm-12">
                    

    <form id="investorForm"
      action="{{ route('updateinvestorprofile') }}"
      method="POST"
      enctype="multipart/form-data"
      style="background: linear-gradient(135deg, #ffffff, #f0f0f0); 
             color: #2e2e2e; 
             padding: 40px; 
             border-radius: 16px; 
             box-shadow: 0 8px 40px 0 rgba(0,0,0,0.18), 0 1.5rem 3rem rgba(0,0,0,0.15);"
      novalidate>
    @csrf


                    <!-- Investor Profile Section -->

            <div class="row g-3 mb-1">
            <label style="font-size: 20px; font-weight: 600; color: #2C3E50; display: inline-block; padding: 8px 16px; background-color: #ECF0F1; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 2px 5px rgba(0, 0, 0, 0.1); text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s ease-in-out; text-align: center;" 
    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 16px rgba(0, 0, 0, 0.15), 0 4px 8px rgba(0, 0, 0, 0.1)';"
    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 8px rgba(0, 0, 0, 0.1), 0 2px 5px rgba(0, 0, 0, 0.1)';">
    Investor Registration Form
</label>




                    <div class="col-sm-2">
                        <label></label>
                        <h3 style="font-size: 22px; font-weight: 600;">Investor Profile</h3>
                    </div>
                   <div class="col-sm-2">
                        <label id="labelinput" for="investor_name" class="required">Investor Name</label>
                        <input
                            type="text"
                            class="form-control spaced-input @error('investor_name') is-invalid @enderror"
                            id="investor_name"
                            name="investor_name"
                            value="{{ old('investor_name', $investor->investor_name ?? '') }}"
                            required
                            pattern="^[a-zA-Z\s]+$"
                            title="Please enter a valid name (letters and spaces only)"
                            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                        >
                        @error('investor_name')
                            <span class="text-danger">This field is required</span>
                        @enderror
                    </div>













<div class="col-sm-3 form-group">
    <label id="labelinput" for="sectors_preferred" class="required">Sectors Preferred</label>

    @php
        $selectedSectors = old('sectors_preferred') ?? explode(',', $investor->sectors_preferred ?? '');
        $sectors = [
            'Accounting', 'Airlines/Aviation', 'Alternative Dispute Resolution', 'Alternative Medicine', 'Animation', 'Apparel/Fashion', 
            'Architecture/Planning', 'Arts/Crafts', 'Automotive', 'Aviation/Aerospace', 'Banking/Mortgage', 'Biotechnology/Greentech', 
            'Broadcast Media', 'Building Materials', 'Business Supplies/Equipment', 'Capital Markets/Hedge Fund/Private Equity', 
            'Chemicals', 'Civic/Social Organization', 'Civil Engineering', 'Commercial Real Estate', 'Computer Games', 
            'Computer Hardware', 'Computer Networking', 'Computer Software/Engineering', 'Computer/Network Security', 'Construction', 
            'Consumer Electronics', 'Consumer Goods', 'Consumer Services', 'Cosmetics', 'Dairy', 'Defense/Space', 'Design', 
            'E-Learning', 'Education Management', 'Electrical/Electronic Manufacturing', 'Entertainment/Movie Production', 
            'Environmental Services', 'Events Services', 'Executive Office', 'Facilities Services', 'Farming', 'Financial Services', 
            'Fine Art', 'Fishery', 'Food Production', 'Food/Beverages', 'Fundraising', 'Furniture', 'Gambling/Casinos', 
            'Glass/Ceramics/Concrete', 'Government Administration', 'Government Relations', 'Graphic Design/Web Design', 
            'Health/Fitness', 'Higher Education/Acadamia', 'Hospital/Health Care', 'Hospitality', 'Human Resources/HR', 
            'Import/Export', 'Individual/Family Services', 'Industrial Automation', 'Information Services', 'Information Technology/IT', 
            'Insurance', 'International Affairs', 'International Trade/Development', 'Internet', 'Investment Banking/Venture', 
            'Investment Management/Hedge Fund/Private Equity', 'Judiciary', 'Law Enforcement', 'Law Practice/Law Firms', 'Legal Services', 
            'Legislative Office', 'Leisure/Travel', 'Library', 'Logistics/Procurement', 'Luxury Goods/Jewelry', 'Machinery', 
            'Management Consulting', 'Maritime', 'Market Research', 'Marketing/Advertising/Sales', 'Mechanical or Industrial Engineering', 
            'Media Production', 'Medical Equipment', 'Medical Practice', 'Mental Health Care', 'Military Industry', 'Mining/Metals', 
            'Motion Pictures/Film', 'Museums/Institutions', 'Music', 'Nanotechnology', 'Newspapers/Journalism', 'Non-Profit/Volunteering', 
            'Oil/Energy/Solar/Greentech', 'Online Publishing', 'Other Industry', 'Outsourcing/Offshoring', 'Package/Freight Delivery', 
            'Packaging/Containers', 'Paper/Forest Products', 'Performing Arts', 'Pharmaceuticals', 'Philanthropy', 'Photography', 
            'Plastics', 'Political Organization', 'Primary/Secondary Education', 'Printing', 'Professional Training', 
            'Program Development', 'Public Relations/PR', 'Public Safety', 'Publishing Industry', 'Railroad Manufacture', 
            'Ranching', 'Real Estate/Mortgage', 'Recreational Facilities/Services', 'Religious Institutions', 'Renewables/Environment', 
            'Research Industry', 'Restaurants', 'Retail Industry', 'Security/Investigations', 'Semiconductors', 'Shipbuilding', 
            'Sporting Goods', 'Sports', 'Staffing/Recruiting', 'Supermarkets', 'Telecommunications', 'Textiles', 'Think Tanks', 
            'Tobacco', 'Translation/Localization', 'Transportation', 'Utilities', 'Venture Capital/VC', 'Veterinary', 'Warehousing', 
            'Wholesale', 'Wine/Spirits', 'Wireless', 'Writing/Editing'
        ];
    @endphp

    {{-- Readonly visible input --}}
    <input
        type="text"
        class="form-control spaced-input @error('sectors_preferred') is-invalid @enderror"
        id="sectors_preferred_input"
        placeholder="Select sectors"
        readonly
        onclick="toggleDropdown()"
        value="{{ implode(', ', $selectedSectors) }}"
    >
    @error('sectors_preferred')
        <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
    @enderror

    {{-- Checkbox dropdown --}}
    <div id="sectors_preferred_list" class="dropdown-list"
        style="display:none; max-height: 200px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; margin-top: 0px; max-width: 95%; background-color: white; z-index: 10; position: absolute;">
        @foreach($sectors as $sector)
            <label>
                <input
                    type="checkbox"
                    class="sector-checkbox"
                    value="{{ $sector }}"
                    {{ in_array($sector, $selectedSectors) ? 'checked' : '' }}
                > {{ $sector }}
            </label><br>
        @endforeach
    </div>

    {{-- Hidden fields for submission --}}
    <div id="sectors_preferred_hidden_container">
        @foreach($selectedSectors as $sector)
            <input type="hidden" name="sectors_preferred[]" value="{{ $sector }}">
        @endforeach
    </div>
</div>


















   <div class="col-sm-2">
    <label id="labelinput" for="address" class="required">Address</label>
    <input 
        type="text" 
        class="form-control spaced-input @error('address') is-invalid @enderror" 
        id="address" 
        name="address" 
        value="{{ old('address', $investor->address ?? '') }}" 
        required
    >
    @error('address')
        <span class="text-danger">{{ $message ?: 'This field is required' }}</span>
    @enderror
</div>


<div class="col-sm-3">
    @if(!empty($investor->investor_profile))
        <a href="{{ asset('storage/investor_profiles/' . $investor->investor_profile) }}" target="_blank">
            View Investor Profile
        </a>
    @endif
    <label id="labelinput" for="investor_profile">Investor Profile</label>
    <input 
        type="file" 
        class="form-control spaced-input @error('investor_profile') is-invalid @enderror" 
        id="investor_profile" 
        name="investor_profile"
        accept=".doc,.docx,.pdf,.ppt,.pptx,.jpg,.jpeg,.png"
        onchange="validateFileTypeinvestorprofile(this)"
    >
    @error('investor_profile')
        <span class="text-danger">{{ $message ?: 'This field is required' }}</span>
    @enderror
</div>


<hr>
<div class="row g-3 mb-4">
    <div class="col-sm-2">
        <h3 style="font-size: 22px; font-weight: 600;">Contact Details</h3>
        <input 
            type="checkbox" 
            class="form-check-input" 
            id="concerned_person_is_me" 
            name="concerned_person_is_me"
            value="1"
            {{ old('concerned_person_is_me') ? 'checked' : '' }}
            onclick="fillConcernedPersonDetails()"
        >
        <label class="form-check-label" for="concerned_person_is_me" style="font-size: 12px; color: red;">
            Same as registered person
        </label>
    </div>

    <div class="col-sm-3">
        <label id="labelinput" for="concerned_person_name" class="required">Concerned Person</label>
        <input 
            type="text" 
            class="form-control spaced-input @error('concerned_person_name') is-invalid @enderror" 
            id="concerned_person_name" 
            name="concerned_person_name" 
            value="{{ old('concerned_person_name', $contactDetails->concerned_person_name ?? '') }}" 
            required
            pattern="^[a-zA-Z\s]+$"
            title="Please enter a valid name (letters and spaces only)"
            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
            autocomplete="off"
        >
        @error('concerned_person_name')
            <span class="text-danger">This field is required</span>
        @enderror
    </div>

    <div class="col-sm-2">
        <label id="labelinput" for="concerned_person_designation" class="required">Designation</label>
        <input 
            type="text" 
            class="form-control spaced-input @error('concerned_person_designation') is-invalid @enderror" 
            id="concerned_person_designation" 
            name="concerned_person_designation" 
            value="{{ old('concerned_person_designation', $contactDetails->concerned_person_designation ?? '') }}" 
            required
            pattern="^[a-zA-Z\s]+$"
            title="Please enter a valid designation (letters and spaces only)"
            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
            autocomplete="off"
        >
        @error('concerned_person_designation')
            <span class="text-danger">This field is required</span>
        @enderror
    </div>

    <div class="col-sm-2">
        <label id="labelinput" for="concerned_person_phone" class="required">Phone No.</label>
        <input 
            type="text" 
            class="form-control spaced-input @error('concerned_person_phone') is-invalid @enderror" 
            id="concerned_person_phone" 
            name="concerned_person_phone" 
            maxlength="20" 
            pattern="^\+?[0-9]{7,20}$"
            oninput="this.value = this.value.replace(/(?!^\+)[^0-9]/g, '')" 
            value="{{ old('concerned_person_phone', $contactDetails->concerned_person_phone ?? '') }}" 
            required
        >
        @error('concerned_person_phone')
            <span class="text-danger">This field is required</span>
        @enderror
    </div>

    <div class="col-sm-3">
        <label id="labelinput" for="email" class="required">Email</label>
        <input 
            type="email" 
            class="form-control spaced-input @error('email') is-invalid @enderror" 
            id="email" 
            name="email" 
            value="{{ old('email', $contactDetails->email ?? '') }}" 
            required
        >
        <div id="email_error" class="text-danger small"></div>
        @error('email')
            <span class="text-danger">This field is required</span>
        @enderror
    </div>
</div>

                  <!-- <div class="row g-3 mb-4">
                        <div class="col-sm-2">
                            <h3 style="font-size: 22px; font-weight: 600;">Contact Details</h3>
                            <input 
                                type="checkbox" 
                                class="form-check-input" 
                                id="concerned_person_is_me" 
                                name="concerned_person_is_me"
                                value="1"
                                {{ old('concerned_person_is_me') ? 'checked' : '' }}
                                onclick="fillConcernedPersonDetails()"
                            >
                            <label class="form-check-label" for="concerned_person_is_me" style="font-size: 12px; color: red;">Same as registered person</label>
                        </div>
                        <div class="col-sm-3">
                            <label id="labelinput" for="concerned_person_name" class="required">Concerned Person</label>
                            <input 
                                type="text" 
                                class="form-control spaced-input @error('concerned_person_name') is-invalid @enderror" 
                                id="concerned_person_name" 
                                name="concerned_person_name" 
                                value="{{ old('concerned_person_name') }}" 
                                required
                                pattern="^[a-zA-Z\s]+$"
                                title="Please enter a valid name (letters and spaces only)"
                                oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                                autocomplete="off"
                            >
                            @error('concerned_person_name')
                                <span class="text-danger">This field is required</span>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label id="labelinput" for="concerned_person_designation" class="required">Designation</label>
                            <input 
                                type="text" 
                                class="form-control spaced-input @error('concerned_person_designation') is-invalid @enderror" 
                                id="concerned_person_designation" 
                                name="concerned_person_designation" 
                                value="{{ old('concerned_person_designation') }}" 
                                required
                                pattern="^[a-zA-Z\s]+$"
                                title="Please enter a valid designation (letters and spaces only)"
                                oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                                autocomplete="off"
                            >
                            @error('concerned_person_designation')
                                <span class="text-danger">This field is required</span>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label id="labelinput" for="concerned_person_phone" class="required">Phone No.</label>
                            <input 
                                type="text" 
                                class="form-control spaced-input @error('concerned_person_phone') is-invalid @enderror" 
                                id="concerned_person_phone" 
                                name="concerned_person_phone" 
                                maxlength="20" 
                                pattern="^\+?[0-9]{7,20}$"
                                oninput="this.value = this.value.replace(/(?!^\+)[^0-9]/g, '')" 
                                value="{{ old('concerned_person_phone') }}" 
                                required
                            >
                            @error('concerned_person_phone')
                                <span class="text-danger">This field is required</span>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <label id="labelinput" for="email" class="required">Email</label>
                            <input 
                                type="email" 
                                class="form-control spaced-input @error('email') is-invalid @enderror" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required
                            >
                            <div id="email_error" class="text-danger small"></div>
                            @error('email')
                                <span class="text-danger">This field is required</span>
                            @enderror
                        </div>
                    </div> -->


                 <div class="row g-3 mb-3 bordered-row">
                <div class="col-sm-2">
                    <label></label>
                    <h3 style="font-size: 22px; font-weight: 600;">Public Links</h3>
                </div>

 <!-- <pre>
    {!! json_encode($publicLinks->map(function($item) {
        return [
            'url' => $item->url,
            'link_description' => $item->link_description,
        ];
    }), JSON_PRETTY_PRINT) !!}
</pre> -->

   <div id="public-links-container" class="col-sm-10">
    @php
        // Retrieve old input or fallback to DB values
        $urls = old('public_links') ?? $publicLinks->pluck('url')->toArray();
        $descriptions = old('link_descriptions') ?? $publicLinks->pluck('link_description')->toArray();
        $count = max(count($urls), 1);
    @endphp

    @for ($i = 0; $i < $count; $i++)
        <div class="public-link-row d-flex align-items-start mb-2">
            <div class="form-group flex-grow-1 mr-2" style="max-width: 520px;">
                <label for="public_links" class="{{ $i == 0 ? 'required' : '' }}">{{ $i == 0 ? 'URL' : '' }}</label>
                <input 
                    type="url" 
                    class="form-control spaced-input @error("public_links.$i") is-invalid @enderror" 
                    name="public_links[]" 
                    placeholder="Enter URL" 
                    value="{{ $urls[$i] ?? '' }}" 
                    required
                >
                @error("public_links.$i")
                    <span class="text-danger">This field is required</span>
                @enderror
            </div>

            <div class="form-group flex-grow-1 mr-2">
                <label for="link_descriptions" class="{{ $i == 0 ? 'required' : '' }}">{{ $i == 0 ? 'Select Account' : '' }}</label>
                <select 
                    class="form-control spaced-input @error("link_descriptions.$i") is-invalid @enderror" 
                    name="link_descriptions[]" 
                    required
                >
                    @foreach(['Facebook', 'Twitter/X', 'Instagram', 'LinkedIn', 'Others'] as $option)
                        <option value="{{ $option }}" {{ ($descriptions[$i] ?? '') == $option ? 'selected' : '' }}>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
                @error("link_descriptions.$i")
                    <span class="text-danger">This field is required</span>
                @enderror
            </div>

            <div class="form-group">
                @if ($i == 0)
                    <button type="button" class="btn btn-info add-btn mt-4" onclick="addPublicLinkField(this)"> + Add More Links</button>
                @else
                    <button type="button" class="btn btn-danger remove-btn mt-4" onclick="removePublicLinkField(this)">Remove</button>
                @endif
            </div>
        </div>
    @endfor
</div>



                    <!-- Investment Details Section -->
                <div class="row g-3 mb-4">
    <div class="heading-with-hr">
        <h3 style="font-size: 22px; font-weight: 600;">Investment Details</h3>
        <hr>
    </div>

    {{-- Invest In --}}
    <div class="col-sm-3 form-group">
        <label for="invest_in" class="required">Invest In</label>
        <select 
            class="form-control spaced-input @error('invest_in') is-invalid @enderror" 
            id="invest_in" 
            name="invest_in" 
            required
        >
            @php $selectedInvestIn = old('invest_in') ?? $investmentDetails->invest_in ?? ''; @endphp
            <option value="listed shares" {{ $selectedInvestIn == 'listed shares' ? 'selected' : '' }}>Listed shares</option>
            <option value="unlisted shares" {{ $selectedInvestIn == 'unlisted shares' ? 'selected' : '' }}>Unlisted shares</option>
            <option value="both" {{ $selectedInvestIn == 'both' ? 'selected' : '' }}>Both</option>
        </select>
        @error('invest_in')
            <span class="text-danger">This field is required</span>
        @enderror
    </div>

    {{-- Investor Type --}}
    <div class="col-sm-3 form-group">
        <label for="investor_type" class="required">Investor Type</label>
        <select 
            class="form-control spaced-input @error('investor_type') is-invalid @enderror" 
            id="investor_type" 
            name="investor_type" 
            required
        >
            @php $selectedType = old('investor_type') ?? $investmentDetails->investor_type ?? ''; @endphp
            <option value="Angel Investor" {{ $selectedType == 'Angel Investor' ? 'selected' : '' }}>Angel Investor</option>
            <option value="Private Equity" {{ $selectedType == 'Private Equity' ? 'selected' : '' }}>Private Equity</option>
            <option value="Venture Capital" {{ $selectedType == 'Venture Capital' ? 'selected' : '' }}>Venture Capital</option>
            <option value="Family Office" {{ $selectedType == 'Family Office' ? 'selected' : '' }}>Family Office</option>
        </select>
        @error('investor_type')
            <span class="text-danger">This field is required</span>
        @enderror
    </div>

    {{-- Investment Size --}}
    <div class="col-sm-3 form-group">
        <label for="investment_size" class="required">Avg. Investment Size</label>
        <select 
            class="form-control spaced-input @error('investment_size') is-invalid @enderror" 
            id="investment_size" 
            name="investment_size" 
            required
        >
            @php $selectedSize = old('investment_size') ?? $investmentDetails->investment_size ?? ''; @endphp
            <option value="10 cr" {{ $selectedSize == '10 cr' ? 'selected' : '' }}>Less than 10 Cr</option>
            <option value="10-50 Cr" {{ $selectedSize == '10-50 Cr' ? 'selected' : '' }}>10 - 50 Cr</option>
            <option value="50-100 Cr" {{ $selectedSize == '50-100 Cr' ? 'selected' : '' }}>50 - 100 Cr</option>
            <option value=">100+ Cr" {{ $selectedSize == '>100+ Cr' ? 'selected' : '' }}>More than 100 Cr</option>
        </select>
        @error('investment_size')
            <span class="text-danger">This field is required</span>
        @enderror
    </div>

    {{-- Investment Tenure --}}
    <div class="col-sm-3 form-group">
        <label for="investment_tenure" class="required">Avg. Investment Tenure</label>
        <select 
            class="form-control spaced-input @error('investment_tenure') is-invalid @enderror" 
            id="investment_tenure" 
            name="investment_tenure" 
            required
        >
            @php $selectedTenure = old('investment_tenure') ?? $investmentDetails->investment_tenure ?? ''; @endphp
            <option value="1 Years" {{ $selectedTenure == '1 Years' ? 'selected' : '' }}>Less than 1 year</option>
            <option value="3 Years" {{ $selectedTenure == '3 Years' ? 'selected' : '' }}>1 - 3 years</option>
            <option value="5 Years" {{ $selectedTenure == '5 Years' ? 'selected' : '' }}>3 - 5 years</option>
            <option value="7 Years" {{ $selectedTenure == '7 Years' ? 'selected' : '' }}>5 - 7 years</option>
        </select>
        @error('investment_tenure')
            <span class="text-danger">This field is required</span>
        @enderror
    </div>
</div>














































































































                    <!-- Previous Investments Section -->
                         <div class="row g-3 bordered-row">
                            <div class="heading-with-hr">
                                <h3 style="font-size: 22px; font-weight: 600;">Previous Investments</h3>
                                <hr>
                            </div>
                            <!-- Previous Investments Section -->
                            <div id="previous-investments-container">

                                <!-- @php
                                    $previousInvestmentYears = old('previous_investment_year', []);
                                    $previousInvestmentCompanies = old('previous_investment_company', []);
                                    $sectors = old('sector', []);
                                    $count = max(count($previousInvestmentCompanies), 1);
                                @endphp
                                 -->

                                 @php
    if (old('previous_investment_company')) {
        $previousInvestmentYears = old('previous_investment_year');
        $previousInvestmentCompanies = old('previous_investment_company');
        $sectors = old('sector');
    } else {
        $previousInvestmentYears = $previousInvestments->pluck('previous_investment_year')->toArray();
        $previousInvestmentCompanies = $previousInvestments->pluck('previous_investment_company')->toArray();
        $sectors = $previousInvestments->pluck('sector')->toArray();
    }

    $count = max(count($previousInvestmentCompanies), 1);
@endphp

                            @for( $i =0; $i< $count; $i++)
                                <div class="row g-3 previous-investment-row">
                                    <div class="col-sm-3 form-group">
                                        <label id="labelinput" for="previous_investment_year" class="{{$i==0 ? 'required' : '' }}">{{ $i == 0 ? 'Year' : ''}}</label>
                                        <select 
                                            class="form-control spaced-input @error('previous_investment_year.' . $i) is-invalid @enderror" 
                                            id="previous_investment_year" 
                                            name="previous_investment_year[]" 
                                            required
                                            value="{{ $previousInvestmentYears[$i] ?? '' }}"
                                            >
                                            <option value="" {{ !isset($previousInvestmentYears[$i]) || $previousInvestmentYears[$i] == '' ? 'selected' : ''}}>Select Year</option>
                                            @for ($year = 2000; $year <= 2024; $year++)
                                                <option value="{{ $year }}" {{ ($previousInvestmentYears[$i] ?? '') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                            @endfor
                                        </select>

                                        @error('previous_investment_year.' . $i)
                                            <span class="text-danger">This field is required</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label id="labelinput" for="previous_investment_company" class="{{$i==0 ? 'required' : '' }}">{{ $i == 0 ? 'Company' : ''}}</label>
                                        <input 
                                            type="text" 
                                            class="form-control spaced-input @error('previous_investment_company.' . $i) is-invalid @enderror" 
                                            id="previous_investment_company" 
                                            name="previous_investment_company[]" 
                                            value="{{ $previousInvestmentCompanies[$i] ?? '' }}" 
                                            required
                                        >
                                        @error('previous_investment_company.' . $i)
                                            <span class="text-danger">This field is required</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label id="labelinput" for="sector" class="{{$i==0 ? 'required' : '' }}">{{ $i == 0 ? 'Sector' : ''}}</label>
                                        <select 
                                            class="form-control spaced-input @error('sector.' . $i) is-invalid @enderror" 
                                            id="sector" 
                                            name="sector[]" 
                                            required
                                        >
                                            <!-- @if ($i == 0)
                                                <option value="" selected hidden>Select Sector</option>
                                            @endif -->
                                            <!-- <option value="" {{ empty($sectors[$i]) ? 'selected' : '' }}>Select Sector</option> -->
                                            <option value="" {{ !isset($sectors[$i]) || $sectors[$i] == '' ? 'selected' : '' }}>Select Sector</option>

                                            @php
                                                $sectorOptions = [
                                                    'Accounting', 'Airlines/Aviation', 'Alternative Dispute Resolution', 'Alternative Medicine', 'Animation', 'Apparel/Fashion', 
                                                    'Architecture/Planning', 'Arts/Crafts', 'Automotive', 'Aviation/Aerospace', 'Banking/Mortgage', 'Biotechnology/Greentech', 
                                                    'Broadcast Media', 'Building Materials', 'Business Supplies/Equipment', 'Capital Markets/Hedge Fund/Private Equity', 
                                                    'Chemicals', 'Civic/Social Organization', 'Civil Engineering', 'Commercial Real Estate', 'Computer Games', 
                                                    'Computer Hardware', 'Computer Networking', 'Computer Software/Engineering', 'Computer/Network Security', 'Construction', 
                                                    'Consumer Electronics', 'Consumer Goods', 'Consumer Services', 'Cosmetics', 'Dairy', 'Defense/Space', 'Design', 
                                                    'E-Learning', 'Education Management', 'Electrical/Electronic Manufacturing', 'Entertainment/Movie Production', 
                                                    'Environmental Services', 'Events Services', 'Executive Office', 'Facilities Services', 'Farming', 'Financial Services', 
                                                    'Fine Art', 'Fishery', 'Food Production', 'Food/Beverages', 'Fundraising', 'Furniture', 'Gambling/Casinos', 
                                                    'Glass/Ceramics/Concrete', 'Government Administration', 'Government Relations', 'Graphic Design/Web Design', 
                                                    'Health/Fitness', 'Higher Education/Acadamia', 'Hospital/Health Care', 'Hospitality', 'Human Resources/HR', 
                                                    'Import/Export', 'Individual/Family Services', 'Industrial Automation', 'Information Services', 'Information Technology/IT', 
                                                    'Insurance', 'International Affairs', 'International Trade/Development', 'Internet', 'Investment Banking/Venture', 
                                                    'Investment Management/Hedge Fund/Private Equity', 'Judiciary', 'Law Enforcement', 'Law Practice/Law Firms', 'Legal Services', 
                                                    'Legislative Office', 'Leisure/Travel', 'Library', 'Logistics/Procurement', 'Luxury Goods/Jewelry', 'Machinery', 
                                                    'Management Consulting', 'Maritime', 'Market Research', 'Marketing/Advertising/Sales', 'Mechanical or Industrial Engineering', 
                                                    'Media Production', 'Medical Equipment', 'Medical Practice', 'Mental Health Care', 'Military Industry', 'Mining/Metals', 
                                                    'Motion Pictures/Film', 'Museums/Institutions', 'Music', 'Nanotechnology', 'Newspapers/Journalism', 'Non-Profit/Volunteering', 
                                                    'Oil/Energy/Solar/Greentech', 'Online Publishing', 'Other Industry', 'Outsourcing/Offshoring', 'Package/Freight Delivery', 
                                                    'Packaging/Containers', 'Paper/Forest Products', 'Performing Arts', 'Pharmaceuticals', 'Philanthropy', 'Photography', 
                                                    'Plastics', 'Political Organization', 'Primary/Secondary Education', 'Printing', 'Professional Training', 
                                                    'Program Development', 'Public Relations/PR', 'Public Safety', 'Publishing Industry', 'Railroad Manufacture', 
                                                    'Ranching', 'Real Estate/Mortgage', 'Recreational Facilities/Services', 'Religious Institutions', 'Renewables/Environment', 
                                                    'Research Industry', 'Restaurants', 'Retail Industry', 'Security/Investigations', 'Semiconductors', 'Shipbuilding', 
                                                    'Sporting Goods', 'Sports', 'Staffing/Recruiting', 'Supermarkets', 'Telecommunications', 'Textiles', 'Think Tanks', 
                                                    'Tobacco', 'Translation/Localization', 'Transportation', 'Utilities', 'Venture Capital/VC', 'Veterinary', 'Warehousing', 
                                                    'Wholesale', 'Wine/Spirits', 'Wireless', 'Writing/Editing'
                                                ];
                                            @endphp
                                            @foreach($sectorOptions as $option)
                                                <option value="{{ $option }}" {{ (isset($sectors[$i]) && $sectors[$i] == $option) ? 'selected' : '' }}>{{ $option }}</option>
                                            @endforeach
                                        </select>
                                        
                                        @error('sector.' . $i)
                                            <span class="text-danger">This field is required</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        @if ($i == 0)
                                            <button type="button" class="btn btn-info mt-4" onclick="addPreviousInvestmentField(this)">+ Add More</button>
                                        @else
                                            <button type="button" class="btn btn-danger mt-4" onclick="removePreviousInvestmentField(this)">×</button>
                                        @endif
                                    </div>
                                </div>
                                @endfor
                        </div>    






















































































@php
    $selectedReferral = old('referral_source') ?? ($referral->referral_source ?? '');
@endphp

<!-- Referral and Guidance Section -->
<div class="row g-3">
    <div class="heading-with-hr">
        <h3 style="font-size: 22px; font-weight: 600;">How did you hear about Investor Dekho?</h3>
        <hr>
    </div>
    <div class="form-floating">
        <label id="labelinput" for="referral_source" class="required">Referral Source</label>
        <select class="form-control spaced-input @error('referral_source') is-invalid @enderror" id="referral_source" name="referral_source" required>
            <option value="" disabled {{ $selectedReferral == '' ? 'selected' : '' }}>Select Source</option>
            @foreach([
                'Friend/Family',
                'Social Media (Facebook, Instagram, Twitter/X, etc.)',
                'Online Search (Google, Bing, etc.)',
                'Advertisement (TV, Radio, Print)',
                'Email Newsletter',
                'Event/Seminar',
                'Professional Referral (Doctor, Lawyer, etc.)',
                'Blog/Website',
                'Direct Mail',
                'Company Website'
            ] as $option)
                <option value="{{ $option }}" {{ $selectedReferral === $option ? 'selected' : '' }}>
                    {{ $option }}
                </option>
            @endforeach
        </select>
        @error('referral_source')
            <span class="text-danger">This field is required</span>
        @enderror 
    </div>
</div>


                   
                   
                    
                     <div class="form-check mb-4">
                        <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" id="terms" name="terms" value="1" {{ old('terms') ? 'checked' : ''}} required>
                        <label class="form-check-label" for="terms">
                            I agree to the 
                            <a href="{{ route('terms') }}" target="_blank" rel="noopener">Terms and Conditions</a>
                        </label>
                        @error('terms')
                            <span class="text-danger">You must agree to the Terms and Conditions</span>
                        @enderror
                    </div>

                    <button type="submit" id="submitbutton" class="btn btn-primary py-3 px-5 w-100">Submit</button>
    </form>
</div>
</div>
        </div>

<script>
   

    function toggleDropdown() {
        const dropdown = document.getElementById('sectors_preferred_list');
        dropdown.style.display = dropdown.style.display === 'none' || dropdown.style.display === '' ? 'block' : 'none';
    }

    document.addEventListener('DOMContentLoaded', () => {
        const checkboxes = document.querySelectorAll('.sector-checkbox');
        const selectedInput = document.getElementById('sectors_preferred_input');
        const hiddenContainer = document.getElementById('sectors_preferred_hidden_container');

        function updateSelections() {
            const selected = Array.from(checkboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.value);

            // Show in the readonly input
            selectedInput.value = selected.join(', ');

            // Remove previous hidden inputs
            hiddenContainer.innerHTML = '';

            // Create new hidden inputs
            selected.forEach(value => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'sectors_preferred[]';
                input.value = value;
                hiddenContainer.appendChild(input);
            });
        }

        // Attach change listener to all checkboxes
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelections);
        });

        // Run on page load (e.g. old values restored)
        updateSelections();
    });



    // Close dropdown if clicking outside
    document.addEventListener('click', function (e) {
        if (!document.getElementById('sectors_preferred_input').contains(e.target) && 
            !document.getElementById('sectors_preferred_list').contains(e.target)) {
            document.getElementById('sectors_preferred_list').style.display = 'none';
        }
    });

//    function addPublicLinkField(button) {
//     // Create a new public link field without changing the + button to - button
//     const newField = `
//         <div class="public-link-row d-flex align-items-start">
//             <div class="form-group flex-grow-1 mr-2" style="max-width: 520px;">
//                 <label for="public_links" class=""></label>
//                 <input type="url" class="form-control spaced-input" name="public_links[]" placeholder="Enter URL" required>
//             </div>
//             <div class="form-group flex-grow-1 mr-2">
//                 <label for="link_descriptions" class=""></label>
//                 <select class="form-control spaced-input" name="link_descriptions[]" required>
//                     <option value="Facebook">Facebook</option>
//                     <option value="Twitter">Twitter</option>
//                     <option value="Instagram">Instagram</option>
//                     <option value="LinkedIn">LinkedIn</option>
//                     <option value="Others">Others</option>
//                 </select>
//             </div>
//             <div class="form-group">
//             <button type="button"
//             class="btn btn-danger remove-btn"
//             style="font-size: 20px; padding: 5px 15px;"
//             onclick="removePublicLinkField(this)">-</button>
//         </div>

//         </div>`;

//     // Append the new field to the container
//     document.getElementById('public-links-container').insertAdjacentHTML('beforeend', newField);
// }
function addPublicLinkField(button) {
    const newField = `
        <div class="public-link-row d-flex align-items-start mb-2">
            <div class="form-group flex-grow-1 mr-2" style="max-width: 520px;">
                <label for="public_links"></label>
                <input 
                    type="url" 
                    class="form-control spaced-input" 
                    name="public_links[]" 
                    placeholder="Enter URL" 
                    required
                >
            </div>
            <div class="form-group flex-grow-1 mr-2">
                <label for="link_descriptions"></label>
                <select 
                    class="form-control spaced-input" 
                    name="link_descriptions[]" 
                    required
                >
                    <option value="Facebook">Facebook</option>
                    <option value="Twitter/X">Twitter/X</option>
                    <option value="Instagram">Instagram</option>
                    <option value="LinkedIn">LinkedIn</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            <div class="form-group">
                <button 
                    type="button" 
                    class="btn btn-danger remove-btn mt-4" 
                    onclick="removePublicLinkField(this)">Remove</button>
            </div>
        </div>
    `;

    document.getElementById('public-links-container').insertAdjacentHTML('beforeend', newField);
}

function removePublicLinkField(button) {
    // Remove the row containing this button
    button.closest('.public-link-row').remove();
}




   function toggleOtherField() {
    const otherField = document.getElementById('other_field');
    const otherGuidanceContainer = document.getElementById('other_guidance'); // This will hold the checkboxes
 
    if (document.getElementById('others_checkbox').checked) {
        // Show the field
        otherField.style.display = 'block';

        // Clear previous checkboxes
        otherGuidanceContainer.innerHTML = '';

        // Array of service categories
        const serviceCategories = [
            'Equity Funding', 'Debt Funding', 'Mergers & Acquisitions', 'Pitchdeck Making',
            'Pitching to Investors', 'IPO Planning', 'IPO Listing', 'Issuance of Bonus Shares',
            'Issuance of Rights Issue', 'Employee Stock Options (ESOP) Planning', 'Patent', 'Trademark', 'Design Registration', 
            'DSC', 'Online Listing', 'Income Tax Return', 'GST, TDS, PF, ESI, PT, Customs', 'MCA & ROC Works', 
            'Appointment & Resignation of Directors', 'Annual Return', 'Company Registration', 'Udyog Aadhar & GST Registration', 
            'Importer-Exporter Code', 'Loan Proposal', 'CMA Data', 'Accounting', 'Subsidy', 'Tax Planning', 
            'Capital Re-Structuring', 'Project Report', 'TEV Study', 'Structured Finance', 
            'Preparation of Share and Warrants', 'Subscription Agreement (SWSA)', 'Preparation of Share Holders\' Agreement (SHA)', 
            'Due Diligence'
        ];

        // Dynamically create checkboxes for each category
        serviceCategories.forEach(category => {
            const checkboxDiv = document.createElement('div');
            checkboxDiv.classList.add('form-check'); // Add Bootstrap styling

            const checkbox = document.createElement('input');
            checkbox.classList.add('form-check-input');
            checkbox.type = 'checkbox';
            checkbox.name = 'other_guidance[]';
            checkbox.value = category;
            checkbox.id = category.replace(/\s+/g, '_').toLowerCase(); // Replace spaces with underscores for ID

            const label = document.createElement('label');
            label.classList.add('form-check-label');
            label.setAttribute('for', checkbox.id);
            label.textContent = category;

            // Append the checkbox and label to the div
            checkboxDiv.appendChild(checkbox);
            checkboxDiv.appendChild(label);

            // Append the div to the container
            otherGuidanceContainer.appendChild(checkboxDiv);
        });
    } else {
        // Hide the field if "Others" is unchecked
        otherField.style.display = 'none';
    }
}



    function fillConcernedPersonDetails() {
        const nameField = document.getElementById('concerned_person_name');
        const designationField = document.getElementById('concerned_person_designation');
        const phoneField = document.getElementById('concerned_person_phone');
        const emailField = document.getElementById('email');

        if (document.getElementById('concerned_person_is_me').checked) {
            // Fill in with the logged-in user details if necessary (use appropriate server-side user details here)
            nameField.value = "{{ Auth::user()->name }}";
            emailField.value = "{{ Auth::user()->email }}";
            phoneField.value = "{{ Auth::user()->phone }}";
            // designationField.value = "{{ Auth::user()->designation ?? '' }}";  // Assuming user model has these field
            const userDesignation = @json(Auth::user()->designation ?? null);
            if (userDesignation) {
                designationField.value = userDesignation;
            }


            nameField.readOnly = true;
            designationField.readOnly = false;
            phoneField.readOnly = true;
            emailField.readOnly = true;
        } else {
            nameField.value = '';
            emailField.value = '';
            phoneField.value = '';
            designationField.value = '';

            nameField.readOnly = false;
            designationField.readOnly = false;
            phoneField.readOnly = false;
            emailField.readOnly = false;
        }
    }
    
     document.addEventListener('DOMContentLoaded', function () {
        if (document.getElementById('concerned_person_is_me').checked) {
            fillConcernedPersonDetails();
        }
    });

    function removePreviousInvestmentField(button) {
    const container = document.getElementById('previous-investments-container');
    const allRows = container.querySelectorAll('.previous-investment-row');

    if (allRows.length > 1) {
        button.closest('.previous-investment-row').remove();
    } else {
        alert('At least one entry is required.');
    }
}

    
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const emailvalue = document.getElementById('email');
        const form = document.querySelector('form');
        const emailError = document.getElementById('email_error');
        //real time email validation
          const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;


          emailvalue.addEventListener('input', function () {
            if(!emailPattern.test(emailvalue.value.trim())){
                emailError.textContent = "Please enter a valid email address.e.g.,demo@gmail.com";
            }else{
                emailError.textContent = "";
            }
          });
        // Real-time email validation
        emailvalue.addEventListener('change', function () {
            if (!emailPattern.test(emailvalue.value.trim())) {
                emailError.textContent = 'Please enter a valid email address. e.g.,demo@gmail.com';
            } else {
                emailError.textContent = '';
            }
        });
        // Form submission validation
        form.addEventListener('submit', function (event) {
            if (!emailPattern.test(emailvalue.value.trim())) {
                event.preventDefault(); // Prevent form submission
                alert('Please enter a valid email address. e.g.,demo@gmail.com');
                emailvalue.focus(); // Set focus back to the email field
            }
            if (emailvalue.value.trim() === '') {
                event.preventDefault(); // Prevent form submission
                alert('Email field cannot be empty.');
            }

    });
    });
</script>

<script>

     document.addEventListener('DOMContentLoaded', function (){
        let 
    })
</script>
<script>
    function validateFileTypeinvestorprofile(input) {
        // If called from form submit, input will be the event, not the input element
        if (input && input.target && input.target.type === 'submit') {
            input = document.getElementById('investor_profile');
        }
        const allowedExtensions = /(\.doc|\.docx|\.pdf|\.ppt|\.pptx|\.jpg|\.jpeg|\.png)$/i;
        if (input && input.value && !allowedExtensions.exec(input.value)) {
            alert('Invalid file type. Please upload a DOC, DOCX, PDF, PPT, PPTX, JPG, JPEG, or PNG file.');
            input.value = '';
            return false;
        }
        return true;
    }

    document.addEventListener('DOMContentLoaded', function () {
        let fileInput = document.getElementById('investor_profile');
        if (fileInput) {
            fileInput.addEventListener('change', function () {
                validateFileTypeinvestorprofile(fileInput);
            });
        }

        let form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function (e) {
                if (!validateFileTypeinvestorprofile(fileInput)) {
                    e.preventDefault();
                }
            });
        }
    });
</script>

<script>
    function showError(input, message) {
        input.setCustomValidity(message); // key to trigger HTML5 error tooltip
        input.reportValidity();           // show native tooltip
        input.classList.add('is-invalid');
    }

    function clearError(input) {
        input.setCustomValidity('');      // reset native validation
        input.classList.remove('is-invalid');
    }

    function validateAllLinks() {
        const publicLinks = document.querySelectorAll('input[name="public_links[]"]');
        const descriptions = document.querySelectorAll('select[name="link_descriptions[]"]');

        let isValid = true;

        publicLinks.forEach((input, i) => {
            const link = input.value.trim();
            const descInput = descriptions[i];
            if (!descInput) return;
            const desc = descInput.value.trim();

            clearError(input);
            clearError(descInput);

           


            // Facebook: Allow profiles, pages, groups, usernames
            if (
                link && desc === 'Facebook' &&
                !/^https?:\/\/(www\.)?facebook\.com\/[a-zA-Z0-9.\-_/]+\/?$/.test(link)
            ) {
                showError(input, 'Valid Facebook URL required, e.g., https://facebook.com/yourpage');
                isValid = false;
            }

            // Twitter/X: Allow usernames, orgs, etc.
            if (
                link && desc === 'Twitter/X' &&
                !/^https?:\/\/(www\.)?(twitter\.com|x\.com)\/[a-zA-Z0-9_]+\/?$/.test(link)
            ) {
                showError(input, 'Valid Twitter/X URL required, e.g., https://x.com/yourhandle');
                isValid = false;
            }


            // Instagram: Allow personal and business profiles
            if (
                link && desc === 'Instagram' &&
                !/^https?:\/\/(www\.)?instagram\.com\/[a-zA-Z0-9._]+\/?$/.test(link)
            ) {
                showError(input, 'Valid Instagram URL required, e.g., https://instagram.com/yourprofile');
                isValid = false;
            }

            // LinkedIn: Allow personal profiles, companies, schools, groups, posts, etc.
            if (
                link && desc === 'LinkedIn' &&
                !/^https?:\/\/(www\.)?linkedin\.com\/(in|company|school|groups|showcase|events|posts|feed)\/[a-zA-Z0-9\-_/]+\/?$/.test(link)
            ) {
                showError(input, 'Valid LinkedIn URL required, e.g., https://linkedin.com/company/yourcompany');
                isValid = false;
            }

        });

        return isValid;
    }

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('investorForm');

        form.addEventListener('submit', function (e) {
            const isCustomValid = validateAllLinks();

            if (!isCustomValid) {
                // Let native HTML5 validation + custom errors block submission
                e.preventDefault();
            }
            // Don't call form.submit() manually — let native HTML5 handle it if valid
        });

        document.getElementById('public-links-container').addEventListener('input', function (e) {
            if (e.target.name === 'public_links[]') {
                validateAllLinks();
            }
        });

        document.getElementById('public-links-container').addEventListener('change', function (e) {
            if (e.target.name === 'link_descriptions[]') {
                validateAllLinks();
            }
        });
    });
</script>


<script>
    function addPreviousInvestmentField() {
        const container = document.getElementById('previous-investments-container');

        const sectors = [          
                                                'Accounting', 'Airlines/Aviation', 'Alternative Dispute Resolution', 'Alternative Medicine', 'Animation', 'Apparel/Fashion', 
                                                'Architecture/Planning', 'Arts/Crafts', 'Automotive', 'Aviation/Aerospace', 'Banking/Mortgage', 'Biotechnology/Greentech', 
                                                'Broadcast Media', 'Building Materials', 'Business Supplies/Equipment', 'Capital Markets/Hedge Fund/Private Equity', 
                                                'Chemicals', 'Civic/Social Organization', 'Civil Engineering', 'Commercial Real Estate', 'Computer Games', 
                                                'Computer Hardware', 'Computer Networking', 'Computer Software/Engineering', 'Computer/Network Security', 'Construction', 
                                                'Consumer Electronics', 'Consumer Goods', 'Consumer Services', 'Cosmetics', 'Dairy', 'Defense/Space', 'Design', 
                                                'E-Learning', 'Education Management', 'Electrical/Electronic Manufacturing', 'Entertainment/Movie Production', 
                                                'Environmental Services', 'Events Services', 'Executive Office', 'Facilities Services', 'Farming', 'Financial Services', 
                                                'Fine Art', 'Fishery', 'Food Production', 'Food/Beverages', 'Fundraising', 'Furniture', 'Gambling/Casinos', 
                                                'Glass/Ceramics/Concrete', 'Government Administration', 'Government Relations', 'Graphic Design/Web Design', 
                                                'Health/Fitness', 'Higher Education/Acadamia', 'Hospital/Health Care', 'Hospitality', 'Human Resources/HR', 
                                                'Import/Export', 'Individual/Family Services', 'Industrial Automation', 'Information Services', 'Information Technology/IT', 
                                                'Insurance', 'International Affairs', 'International Trade/Development', 'Internet', 'Investment Banking/Venture', 
                                                'Investment Management/Hedge Fund/Private Equity', 'Judiciary', 'Law Enforcement', 'Law Practice/Law Firms', 'Legal Services', 
                                                'Legislative Office', 'Leisure/Travel', 'Library', 'Logistics/Procurement', 'Luxury Goods/Jewelry', 'Machinery', 
                                                'Management Consulting', 'Maritime', 'Market Research', 'Marketing/Advertising/Sales', 'Mechanical or Industrial Engineering', 
                                                'Media Production', 'Medical Equipment', 'Medical Practice', 'Mental Health Care', 'Military Industry', 'Mining/Metals', 
                                                'Motion Pictures/Film', 'Museums/Institutions', 'Music', 'Nanotechnology', 'Newspapers/Journalism', 'Non-Profit/Volunteering', 
                                                'Oil/Energy/Solar/Greentech', 'Online Publishing', 'Other Industry', 'Outsourcing/Offshoring', 'Package/Freight Delivery', 
                                                'Packaging/Containers', 'Paper/Forest Products', 'Performing Arts', 'Pharmaceuticals', 'Philanthropy', 'Photography', 
                                                'Plastics', 'Political Organization', 'Primary/Secondary Education', 'Printing', 'Professional Training', 
                                                'Program Development', 'Public Relations/PR', 'Public Safety', 'Publishing Industry', 'Railroad Manufacture', 
                                                'Ranching', 'Real Estate/Mortgage', 'Recreational Facilities/Services', 'Religious Institutions', 'Renewables/Environment', 
                                                'Research Industry', 'Restaurants', 'Retail Industry', 'Security/Investigations', 'Semiconductors', 'Shipbuilding', 
                                                'Sporting Goods', 'Sports', 'Staffing/Recruiting', 'Supermarkets', 'Telecommunications', 'Textiles', 'Think Tanks', 
                                                'Tobacco', 'Translation/Localization', 'Transportation', 'Utilities', 'Venture Capital/VC', 'Veterinary', 'Warehousing', 
                                                'Wholesale', 'Wine/Spirits', 'Wireless', 'Writing/Editing'
                                           ];
        let sectorOptions = `<option value="" selected>Select Sector</option>`;
        
        sectors.forEach(sector => {
            sectorOptions += `<option value="${sector}">${sector}</option>`;
        });

        const currentYear = new Date().getFullYear();
        let yearOptions = `<option value="" selected>Select Year</option>`;
        for (let year = 2000; year <= currentYear; year++) {
            yearOptions += `<option value="${year}">${year}</option>`;
        }

        const newRow = document.createElement('div');
        newRow.className = 'row g-3 previous-investment-row';
        newRow.innerHTML = `
            <div class="col-sm-3 form-group">
                <label class="required">Year</label>
                <select class="form-control" name="previous_investment_year[]" required>
                    ${yearOptions}
                </select>
                <div class="text-danger d-none year-error">This field is required</div>
            </div>
            <div class="col-sm-3 form-group">
                <label class="required">Company</label>
                <input type="text" class="form-control" name="previous_investment_company[]" required>
            </div>
            <div class="col-sm-3 form-group">
                <label class="required">Sector</label>
                <select class="form-control" name="sector[]" required>
                    ${sectorOptions}
                </select>
                <div class="text-danger d-none sector-error">This field is required</div>
            </div>
            <div class="col-sm-3 form-group">
                <button type="button" class="btn btn-danger mt-4" onclick="removePreviousInvestmentField(this)">×</button>
            </div>
        `;
        container.appendChild(newRow);

    }

    function removePreviousInvestmentField(button) {
        const row = button.closest('.previous-investment-row');
        row.remove();
    }
</script>



<!-- <script>
document.querySelector('form').addEventListener('submit', function (e) {
    let isValid = true;

    document.querySelectorAll('.previous-investment-row').forEach(row => {
        // YEAR
        const year = row.querySelector('select[name="previous_investment_year[]"]');
        const yearError = row.querySelector('.year-error');
       if (year.value === "" || year.selectedIndex === 0) {
            year.classList.add('is-invalid');
            yearError.classList.remove('d-none');
            isValid = false;
        } else {
            year.classList.remove('is-invalid');
            yearError.classList.add('d-none');
        }

        // SECTOR
        const sector = row.querySelector('select[name="sector[]"]');
        const sectorError = row.querySelector('.sector-error');
        if (!sector.value) {
            sector.classList.add('is-invalid');
            sectorError.classList.remove('d-none');
            isValid = false;
        } else {
            sector.classList.remove('is-invalid');
            sectorError.classList.add('d-none');
        }

        // COMPANY (optional client-side)
        const company = row.querySelector('input[name="previous_investment_company[]"]');
        if (!company.value.trim()) {
            company.classList.add('is-invalid');
            isValid = false;
        } else {
            company.classList.remove('is-invalid');
        }
    });

    if (!isValid) {
        e.preventDefault(); // Prevent form submission
    }
});
</script> -->


<script>
document.addEventListener('DOMContentLoaded', function () {
    const phonePattern = /^\+?[0-9]{7,20}$/;

    // Define all phone inputs you want to validate
    const phoneInputs = [
        {
            input: document.getElementById('phone_number'),
            formIds: ['form', 'investmentBankerForm']
        },
        {
            input: document.getElementById('concerned_person_phone'),
            formIds: ['investorForm']
        }
    ];

    phoneInputs.forEach(({ input, formIds }) => {
        if (!input) return;

        // Create and insert error container
        const errorContainer = document.createElement('div');
        errorContainer.className = 'text-danger small mt-1';
        input.parentNode.appendChild(errorContainer);

        // Real-time validation
        input.addEventListener('input', function () {
            input.value = input.value.replace(/(?!^\+)[^0-9]/g, '');
            const value = input.value.trim();

            if (!phonePattern.test(value)) {
                errorContainer.textContent = "Enter a valid phone number (7 to 20 digits, optional +).";
            } else {
                errorContainer.textContent = "";
            }
        });

        // Form submit validation
        formIds.forEach(id => {
            const form = document.getElementById(id);
            if (form) {
                form.addEventListener('submit', function (event) {
                    const value = input.value.trim();
                    if (!phonePattern.test(value)) {
                        event.preventDefault();
                        errorContainer.textContent = "Enter a valid phone number (7 to 20 digits, optional +).";
                        input.focus();
                    } else {
                        errorContainer.textContent = "";
                    }
                });
            }
        });
    });
});
</script>

@endsection
