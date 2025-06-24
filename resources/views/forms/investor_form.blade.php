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
      action="{{ route('form.investor.submit') }}"
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
        value="{{ old('investor_name') }}"
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
    <input
        type="text"
        class="form-control spaced-input {{ $errors->has('sectors_preferred') ? 'is-invalid' : '' }}"
        id="sectors_preferred_input"
        placeholder="Select sectors"
        readonly
        onclick="toggleDropdown()"
        value="{{ old('sectors_preferred') ? implode(', ', old('sectors_preferred')) : '' }}"
    >
    
    @error('sectors_preferred')
        <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
    @enderror

    <div id="sectors_preferred_list" class="dropdown-list"
        style="display:none; max-height: 200px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; margin-top: 0px; max-width: 95%; background-color: white; z-index: 10; position: absolute;">
        @php
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

        @foreach($sectors as $sector)
            <label>
                <input
                    type="checkbox"
                    class="sector-checkbox"
                    value="{{ $sector }}"
                    {{ old('sectors_preferred') && in_array($sector, old('sectors_preferred')) ? 'checked' : '' }}
                > 
                {{ $sector }}
            </label><br>
        @endforeach
    </div>

    {{-- Container for dynamic hidden inputs --}}
    <div id="sectors_preferred_hidden_container">
        @if(old('sectors_preferred'))
            @foreach(old('sectors_preferred') as $sector)
                <input type="hidden" name="sectors_preferred[]" value="{{ $sector }}">
            @endforeach
        @endif
    </div>
</div>










<!-- 
                   <div class="col-sm-3 form-group">
                    <label id="labelinput" for="sectors_preferred" class="required">Sectors Preferred</label>
                    <input
                        type="text"
                        class="form-control spaced-input {{ $errors->has('sectors_preferred') ? 'is-invalid' : '' }}""
                        id="sectors_preferred_input"
                        placeholder="Select sectors"
                        readonly
                        onclick="toggleDropdown()"
                        value="{{ old('sectors_preferred') ? implode(', ', old('sectors_preferred')) : '' }}"
                    >
                    @error('sectors_preferred')
                        <span class="text-danger">This field is required</span>
                    @enderror
                    <div id="sectors_preferred_list" class="dropdown-list" style="display:none; max-height: 200px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; margin-top: 0px; max-width: 95%; background-color: white; z-index: 10;">
                        @php
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
                        @foreach($sectors as $sector)
                            <label>
                                <input
                                    type="checkbox"
                                    class="sector-checkbox"
                                    value="{{ $sector }}"
                                    {{ old('sectors_preferred') && in_array($sector, old('sectors_preferred')) ? 'checked' : '' }}
                                > 
                                {{ $sector }}
                            </label><br>
                        @endforeach
                    </div>
                    <input type="hidden" id="sectors_preferred_hidden" class="" name="sectors_preferred[]" value="{{ old('sectors_preferred') ? implode(',', old('sectors_preferred')) : '' }}">

                  

                     @if($errors->has('sectors_preferred'))
                            <span class="text-danger" style="font-size: 13px;">{{ $errors->first('sectors_preferred') }}</span>
                     @endif
                   </div>

 -->




















    <div class="col-sm-2">
    <label id="labelinput" for="Address" class="required">Address</label>
    <input 
        type="text" 
        class="form-control spaced-input @error('address') is-invalid @enderror" 
        id="Address" 
        name="address" 
        value="{{ old('address') }}" 
        required
    >
    @error('address')
        <span class="text-danger">This field is required</span>
    @enderror
</div>
<div class="col-sm-3">
    <label id="labelinput" for="investor_profile">Investor Profile</label>
    <input 
        type="file" 
        class="form-control spaced-input @error('investor_profile') is-invalid @enderror" 
        id="investor_profile" 
        name="investor_profile"
        required
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
        <label class="form-check-label" for="concerned_person_is_me" style="font-size: 9px; color: red;">Same as registered person</label>
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
</div>


                 <div class="row g-3 mb-3 bordered-row">
    <div class="col-sm-2">
        <label></label>
        <h3 style="font-size: 22px; font-weight: 600;">Public Links</h3>
    </div>

    <!-- <div id="public-links-container" class="col-sm-10">
        <div class="public-link-row d-flex align-items-start">
            <div class="form-group flex-grow-1 mr-2">
                <label for="public_links" class="required">URL</label>
                <div>
                    <input 
                        type="url" 
                        class="form-control spaced-input @error('public_links.*') is-invalid @enderror" 
                        name="public_links[]" 
                        placeholder="Enter URL" 
                        value="{{ old('public_links.0') }}" 
                        required
                    >
                </div>
                @error('public_links.*')
                    <div class="mt-1">
                        <span class="text-danger">This field is required</span>
                    </div>
                @enderror
            </div>
            <div class="form-group flex-grow-1 mr-2">
                <label for="link_descriptions" class="required">Select Account</label>
                <div>
                    <select 
                        class="form-control spaced-input @error('link_descriptions.*') is-invalid @enderror" 
                        name="link_descriptions[]" 
                        required
                    >
                        <option value="Facebook" {{ old('link_descriptions.0') == 'Facebook' ? 'selected' : '' }}>Facebook</option>
                        <option value="Twitter" {{ old('link_descriptions.0') == 'Twitter' ? 'selected' : '' }}>Twitter</option>
                        <option value="Instagram" {{ old('link_descriptions.0') == 'Instagram' ? 'selected' : '' }}>Instagram</option>
                        <option value="LinkedIn" {{ old('link_descriptions.0') == 'LinkedIn' ? 'selected' : '' }}>LinkedIn</option>
                        <option value="Others" {{ old('link_descriptions.0') == 'Others' ? 'selected' : '' }}>Others</option>
                    </select>
                </div>
                @error('link_descriptions.*')
                    <div class="mt-1">
                        <span class="text-danger">This field is required</span>
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-info add-btn mt-4" onclick="addPublicLinkField(this)">+</button>
            </div>
        </div>
    </div> -->

    <div id="public-links-container" class="col-sm-10">
    @php
        $publicLinks = old('public_links', []);
        $linkDescriptions = old('link_descriptions', []);
        $count = max(count($publicLinks), 1);
    @endphp

    @for ($i = 0; $i < $count; $i++)
        <div class="public-link-row d-flex align-items-start mb-2">
            <div class="form-group flex-grow-1 mr-2">
                <label for="public_links" class="{{ $i == 0 ? 'required' : '' }}">{{ $i == 0 ? 'URL' : '' }}</label>
                <input 
                    type="url" 
                    class="form-control spaced-input @error("public_links.$i") is-invalid @enderror" 
                    name="public_links[]" 
                    placeholder="Enter URL" 
                    value="{{ $publicLinks[$i] ?? '' }}" 
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
                    @foreach(['Facebook', 'Twitter', 'Instagram', 'LinkedIn', 'Others'] as $option)
                        <option value="{{ $option }}" {{ ($linkDescriptions[$i] ?? '') == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
                @error("link_descriptions.$i")
                    <span class="text-danger">This field is required</span>
                @enderror
            </div>

            <div class="form-group">
                @if ($i == 0)
                    <button type="button" class="btn btn-info add-btn mt-4" onclick="addPublicLinkField(this)">+</button>
                @else
                    <button type="button" class="btn btn-danger remove-btn mt-4" onclick="removePublicLinkField(this)">-</button>
                @endif
            </div>
        </div>
    @endfor
</div>

</div>



                    <!-- Investment Details Section -->
                  <div class="row g-3 mb-4">
    <div class="heading-with-hr">
        <h3 style="font-size: 22px; font-weight: 600;">Investment Details</h3>
        <hr>
    </div>
    <div class="col-sm-3 form-group">
        <label id="labelinput" for="invest_in" class="required">Invest In</label>
        <select 
            class="form-control spaced-input @error('invest_in') is-invalid @enderror" 
            id="invest_in" 
            name="invest_in" 
            required
        >
            <option value="listed shares" {{ old('invest_in') == 'listed shares' ? 'selected' : '' }}>Listed shares</option>
            <option value="unlisted shares" {{ old('invest_in') == 'unlisted shares' ? 'selected' : '' }}>Unlisted shares</option>
            <option value="both" {{ old('invest_in') == 'both' ? 'selected' : '' }}>Both</option>
        </select>
        @error('invest_in')
            <span class="text-danger">This field is required</span>
        @enderror
    </div>
    <div class="col-sm-3 form-group">
        <label id="labelinput" for="investor_type" class="required">Investor Type</label>
        <select 
            class="form-control spaced-input @error('investor_type') is-invalid @enderror" 
            id="investor_type" 
            name="investor_type" 
            required
        >
            <option value="Angel Investor" {{ old('investor_type') == 'Angel Investor' ? 'selected' : '' }}>Angel Investor</option>
            <option value="Private Equity" {{ old('investor_type') == 'Private Equity' ? 'selected' : '' }}>Private Equity</option>
            <option value="Venture Capital" {{ old('investor_type') == 'Venture Capital' ? 'selected' : '' }}>Venture Capital</option>
            <option value="Family Office" {{ old('investor_type') == 'Family Office' ? 'selected' : '' }}>Family Office</option>
        </select>
        @error('investor_type')
            <span class="text-danger">This field is required</span>
        @enderror
    </div>
    <div class="col-sm-3 form-group">
        <label id="labelinput" for="investment_size" class="required">Avg. Investment Size</label>
        <select 
            class="form-control spaced-input @error('investment_size') is-invalid @enderror" 
            id="investment_size" 
            name="investment_size" 
            required
        >
            <option value="10 cr" {{ old('investment_size') == '10 cr' ? 'selected' : '' }}>Less than 10 Cr</option>
            <option value="10-50 Cr" {{ old('investment_size') == '10-50 Cr' ? 'selected' : '' }}>10 - 50 Cr</option>
            <option value="50-100 Cr" {{ old('investment_size') == '50-100 Cr' ? 'selected' : '' }}>50 - 100 Cr</option>
            <option value=">100+ Cr" {{ old('investment_size') == '>100+ Cr' ? 'selected' : '' }}>More than 100 Cr</option>
        </select>
        @error('investment_size')
            <span class="text-danger">This field is required</span>
        @enderror
    </div>
    <div class="col-sm-3 form-group">
        <label id="labelinput" for="investment_tenure" class="required">Avg. Investment Tenure</label>
        <select 
            class="form-control spaced-input @error('investment_tenure') is-invalid @enderror" 
            id="investment_tenure" 
            name="investment_tenure" 
            required
        >
            <option value="1 Years" {{ old('investment_tenure') == '1 Years' ? 'selected' : '' }}>Less than 1 year</option>
            <option value="3 Years" {{ old('investment_tenure') == '3 Years' ? 'selected' : '' }}>1 - 3 years</option>
            <option value="5 Years" {{ old('investment_tenure') == '5 Years' ? 'selected' : '' }}>3 - 5 years</option>
            <option value="7 Years" {{ old('investment_tenure') == '7 Years' ? 'selected' : '' }}>5 - 7 years</option>
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

                        @php
                            $previousInvestmentYears = old('previous_investment_year', []);
                            $previousInvestmentCompanies = old('previous_investment_company', []);
                            $sectors = old('sector', []);
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
                                        @if ($i == 0)
                                            <option value="" disabled selected>Select Sector</option>
                                        @endif
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

























<!-- 
                            @if (old('previous_investment_year') && is_array(old('previous_investment_year')))
                                @foreach (old('previous_investment_year') as $index => $year)
                                    <div class="row g-3 previous-investment-row">
                                        <div class="col-sm-3 form-group">
                                            <label id="labelinput" for="previous_investment_year" class="required">Year</label>
                                            <select 
                                                class="form-control spaced-input @error('previous_investment_year.' . $index) is-invalid @enderror" 
                                                id="previous_investment_year" 
                                                name="previous_investment_year[]"
                                                required
                                            >
                                                @for ($yr = 2000; $yr <= 2024; $yr++)
                                                    <option value="{{ $yr }}" {{ $year == $yr ? 'selected' : '' }}>{{ $yr }}</option>
                                                @endfor
                                            </select>
                                            @error('previous_investment_year.' . $index)
                                                <span class="text-danger">This field is required</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-3 form-group">
                                            <label id="labelinput" for="previous_investment_company" class="required">Company</label>
                                            <input 
                                                type="text" 
                                                class="form-control spaced-input @error('previous_investment_company.' . $index) is-invalid @enderror" 
                                                id="previous_investment_company" 
                                                name="previous_investment_company[]" 
                                                value="{{ old('previous_investment_company.' . $index) }}" 
                                                required
                                            >
                                            @error('previous_investment_company.' . $index)
                                                <span class="text-danger">This field is required</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-3 form-group">
                                            <label id="labelinput" for="sector" class="required">Sector</label>
                                            <input 
                                                type="text" 
                                                class="form-control spaced-input @error('sector.' . $index) is-invalid @enderror" 
                                                id="sector" 
                                                name="sector[]" 
                                                value="{{ old('sector.' . $index) }}" 
                                                required
                                            >
                                            @error('sector.' . $index)
                                                <span class="text-danger">This field is required</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-3 form-group">
                                            <button type="button" class="btn btn-danger mt-4" onclick="removePreviousInvestmentField(this)">×</button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                              
                                <div class="row g-3 previous-investment-row">
                                    <div class="col-sm-3 form-group">
                                        <label id="labelinput" for="previous_investment_year" class="required">Year</label>
                                        <select 
                                            class="form-control spaced-input" 
                                            id="previous_investment_year" 
                                            name="previous_investment_year[]"
                                            required
                                        >
                                            @for ($year = 2000; $year <= 2024; $year++)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label id="labelinput" for="previous_investment_company" class="required">Company</label>
                                        <input 
                                            type="text" 
                                            class="form-control spaced-input" 
                                            id="previous_investment_company" 
                                            name="previous_investment_company[]" 
                                            required
                                        >
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label id="labelinput" for="sector" class="required">Sector</label>
                                        <input 
                                            type="text" 
                                            class="form-control spaced-input" 
                                            id="sector" 
                                            name="sector[]" 
                                            required
                                        >
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <button type="button" class="btn btn-info mt-4" onclick="addPreviousInvestmentField(this)">+ Add More</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    -->





























































































                    <!-- Referral and Guidance Section -->
                    <div class="row g-3">
                        <div class="heading-with-hr">
                            <h3 style="font-size: 22px; font-weight: 600;">How did you hear about Investor Dekho?</h3>
                            <hr>
                        </div>
                        <div class="form-floating">
                            <label id="labelinput" for="referral_source" class="required">Referral Source</label>
                            <select class="form-control spaced-input @error('referral_source') is-invalid @enderror" id="referral_source" name="referral_source" required>
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
                            @error('referral_source')
                                <span class="text-danger">This Field is required</span>
                            @enderror 
                        </div>
                    </div>

                    <!-- Guidance Needed Section -->
                    <!-- <div class="row g-3 mb-4 bordered-row">
                        <div class="heading-with-hr">
                            <h3 class="required" style="font-size: 22px; font-weight: 600;">How can we guide you in fund raise?</h3>
                            <hr>
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="capital_raise" name="guidance_needed[]" value="Capital Raise">
                                <label class="form-check-label" for="capital_raise">Capital Raise</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="valuation_modelling" name="guidance_needed[]" value="Valuation and Financial Modelling">
                                <label class="form-check-label" for="valuation_modelling">Valuation and Financial Modelling</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="ma_advisory" name="guidance_needed[]" value="M&A Advisory">
                                <label class="form-check-label" for="ma_advisory">M&A Advisory</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="pitch_deck" name="guidance_needed[]" value="Pitch deck Preparation">
                                <label class="form-check-label" for="pitch_deck">Pitch deck Preparation</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="investor_pitching" name="guidance_needed[]" value="Investor Pitching">
                                <label class="form-check-label" for="investor_pitching">Investor Pitching</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="na" name="guidance_needed[]" value="NA">
                                <label class="form-check-label" for="na">NA</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="others_checkbox" name="guidance_needed[]" value="Others" onclick="toggleOtherField()">
                                <label class="form-check-label" for="others_checkbox">Others</label>
                            </div>
                        </div>
                        <div class="form-group mb-3" id="other_field" style="display: none;">
                            <label id="labelinput" for="other_guidance">Please specify (Others)</label>
                            <div id="other_guidance" style="max-height: 200px; overflow-y: auto; border: 1px solid #ddd; padding: 10px;">
                               
                            </div>
                        </div>
                    </div> -->

                    <!-- Submit Button -->

                     <!-- <div class="form-check mb-4">
                        <input type="checkbox" class="form-check-input" id="terms" name="terms" value="1" {{ old('terms') ? 'checked' : ''}} required>
                        <label class="form-check-label" for="terms">
                            I agree to the 
                            <a href="{{ route('terms') }}" target="_blank" rel="noopener">Terms and Conditions</a>
                        </label>
                    </div> -->
                    
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

   function addPublicLinkField(button) {
    // Create a new public link field without changing the + button to - button
    const newField = `
        <div class="public-link-row d-flex align-items-start">
            <div class="form-group flex-grow-1 mr-2" style="max-width: 522px;">
                <label for="public_links" class=""></label>
                <input type="url" class="form-control spaced-input" name="public_links[]" placeholder="Enter URL" required>
            </div>
            <div class="form-group flex-grow-1 mr-2">
                <label for="link_descriptions" class=""></label>
                <select class="form-control spaced-input" name="link_descriptions[]" required>
                    <option value="Facebook">Facebook</option>
                    <option value="Twitter">Twitter</option>
                    <option value="Instagram">Instagram</option>
                    <option value="LinkedIn">LinkedIn</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            <div class="form-group">
    <button type="button"
            class="btn btn-danger remove-btn"
            style="font-size: 20px; padding: 5px 15px;"
            onclick="removePublicLinkField(this)">-</button>
</div>

        </div>`;

    // Append the new field to the container
    document.getElementById('public-links-container').insertAdjacentHTML('beforeend', newField);
}

function removePublicLinkField(button) {
    // Remove the row containing this button
    button.closest('.public-link-row').remove();
}


    // Function to add new investment fields
    function addPreviousInvestmentField() {
        const container = document.getElementById('previous-investments-container');
        const newField = `
            <div class="row g-3 mb-1 investment-row">
                <div class="col-sm-3 form-group">
                    <label id="labelinput" for="previous_investment_year" class="required">Year</label>
                    <select class="form-control spaced-input" id="previous_investment_year" name="previous_investment_year[]" required>
                        @for($year = 2000; $year <= 2024; $year++)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-sm-3 form-group">
                    <label id="labelinput" for="previous_investment_company" class="required">Company</label>
                    <input type="text" class="form-control spaced-input" id="previous_investment_company" name="previous_investment_company[]" required>
                </div>
                <div class="col-sm-3 form-group">
                    <label id="labelinput" for="sector" class="required">Sector</label>
                    <select class="form-control spaced-input" id="sector" name="sector[]" required>
                        <option value="" disabled selected>Select Sector</option>
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
                    </select>
                </div>
                <div class="col-sm-1 form-group">
                    <button type="button" class="btn btn-danger mt-4" onclick="removeField(this)">x</button>
                </div>
            </div>`;
        container.insertAdjacentHTML('beforeend', newField);
    }

    // Function to remove the investment fields
    function removeField(element) {
        element.closest('.investment-row').remove();
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
    input.classList.add('is-invalid');
    let error = input.parentElement.querySelector('.text-danger');
    if (!error) {
        error = document.createElement('span');
        error.className = 'text-danger';
        input.parentElement.appendChild(error);
    }
    error.textContent = message;
}

function clearError(input) {
    input.classList.remove('is-invalid');
    const error = input.parentElement.querySelector('.text-danger');
    if (error) error.remove();
}

function validateAllLinks(showAlert = false) {
    const publicLinks = document.querySelectorAll('input[name="public_links[]"]');
    const descriptions = document.querySelectorAll('select[name="link_descriptions[]"]');

    let isValid = true;
    let scrolled = false;

    publicLinks.forEach((input, i) => {
        const link = input.value.trim();
        const desc = descriptions[i]?.value.trim();

        clearError(input);
        clearError(descriptions[i]);

        // Pair validation: both filled or both empty
        if ((link && !desc) || (!link && desc)) {
            if (!link) showError(input, 'URL is required');
            if (!desc) showError(descriptions[i], 'Account type is required');
            isValid = false;
        }

        // First row always required if more than one
        if (publicLinks.length > 1 && i === 0 && (!link || !desc)) {
            if (!link) showError(input, 'URL is required');
            if (!desc) showError(descriptions[i], 'Account type is required');
            isValid = false;
        }

        // URL Pattern Check
        if (link && desc === 'Facebook' && !/^https?:\/\/(www\.)?facebook\.com\/[a-zA-Z0-9._-]+\/?$/.test(link)) {
            showError(input, 'Valid Facebook URL required, e.g., https://facebook.com/yourprofile');
            isValid = false;
        }
        if (link && desc === 'Twitter' && !/^https?:\/\/(www\.)?(twitter\.com|x\.com)\/[a-zA-Z0-9_]+\/?$/.test(link)) {
            showError(input, 'Valid Twitter/X URL required, e.g., https://twitter.com/yourhandle or https://x.com/yourhandle');
            isValid = false;
        }
        if (link && desc === 'Instagram' && !/^https?:\/\/(www\.)?instagram\.com\/[a-zA-Z0-9._]+\/?$/.test(link)) {
            showError(input, 'Valid Instagram URL required, e.g., https://instagram.com/yourprofile');
            isValid = false;
        }
        if (link && desc === 'LinkedIn' && !/^https?:\/\/(www\.)?linkedin\.com\/(in|company)\/[a-zA-Z0-9\-_%]+\/?$/.test(link)) {
            showError(input, 'Valid LinkedIn URL required, e.g., https://linkedin.com/in/yourprofile or https://linkedin.com/company/yourcompany');
            isValid = false;
        }

        // Scroll to first invalid
        if (!isValid && !scrolled && input.classList.contains('is-invalid')) {
            input.scrollIntoView({ behavior: 'smooth', block: 'center' });
            scrolled = true;
        }
    });

    if (!isValid && showAlert) {
        alert('Please fix the highlighted errors before submitting.');
    }

    return isValid;
}

    // Ensure the validation blocks submission
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        const formid= document.getElementById('submitbutton');
        formid.addEventListener('submit', function (e) {
            if (!validateAllLinks(true)) {
                e.preventDefault();
            }
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

@endsection
