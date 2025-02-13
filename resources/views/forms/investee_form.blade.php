@extends('layouts.app') <!-- Assuming you have a layout file for including CSS, JS, etc. -->

@section('content')



<style>
    .form-floating>.form-control:focus, .form-floating>.form-control:not(:placeholder-shown) {
    padding-top: .625rem;
    padding-bottom: .625rem;
    
   
}

 .text-danger{
        font-size: 12px;
    }
   


</style>

<div class="container">
   <div class="row p-2"  style="background: #a5bdc4;">
       <h2> Investee Form</h2>
   </div>
    
     
<form class="bg-light p-4" id="investeeForm" action="{{ route('form.submit') }}" method="POST" enctype="multipart/form-data" novalidate>

    @csrf
    <!-- Company Details Section -->
    <div class="row g-3">
        <div class="col-sm-2">
            <h3 class="mt-4" style="font-size: 22px; font-weight: 600;">Company Details</h3>
        </div>

        <div class="col-sm-2">
            <label id="labelinput" for="company_name" class="required">Company Name <span style="color:red;">*</span></label>
            <input
                type="text"
                class="form-control spaced-input @error('company_name') is-invalid @enderror"
                id="company_name"
                name="company_name"
                value="{{ old('company_name') }}"
                required
            >
            @error('company_name')
                <span class="text-danger">This Field is Required</span>
            @enderror
        </div>

        <div class="col-sm-2">
            <label id="labelinput" for="address" class="required">Address  <span style="color:red;">*</span></label>
            <input
                type="text"
                class="form-control spaced-input @error('address') is-invalid @enderror"
                id="address"
                name="address"
                value="{{ old('address') }}"
                required
            >
            @error('address')
                <span class="text-danger">This Field is Required</span>
            @enderror
        </div>

        <div class="col-sm-3">
            <label id="labelinput" for="nature_of_business" class="required">Nature of Business <span style="color:red;">*</span></label>
            <input
                list="business-options"
                class="form-control spaced-input @error('nature_of_business') is-invalid @enderror"
                id="nature_of_business"
                name="nature_of_business"
                value="{{ old('nature_of_business') }}"
                required
            >
            <datalist id="business-options">
                <!-- Add your business options here -->
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
                <!-- Add other options as needed -->
            </datalist>
            @error('nature_of_business')
                <span class="text-danger">This Field is Required</span>
            @enderror
        </div>
       <div class="col-sm-3">
    <label id="labelinput" for="incorporated_in" class="required">Incorporated In <span style="color:red;">*</span></label>
    <input 
        type="number" 
        class="form-control spaced-input @error('incorporated_in') is-invalid @enderror" 
        id="incorporated_in" 
        name="incorporated_in" 
        value="{{ old('incorporated_in') }}" 
        required
    >
    @error('incorporated_in')
        <span class="text-danger">This Field is Required</span>
    @enderror
</div>

    </div>
    <hr>

    <!-- Concerned Person Details Section -->
<div class="row g-3 mb-1">
    <div class="col-sm-2">
        <h3 class="mt-2" style="font-size: 12px; font-weight: 600;">Concerned Person Details</h3>
        <div class="mt-1">
            <input 
                type="checkbox" 
                class="form-check-input" 
                id="concerned_person_is_me" 
                onclick="fillConcernedPersonDetails()"
            >
            <label 
                class="form-check-label" 
                for="concerned_person_is_me" 
                style="color: red; font-size: 12px;"
            >
                Same as registered
            </label>
        </div>
    </div>

    <div class="col-sm-2">
        <label id="labelinput" for="concerned_person_name" class="required">Concerned Person <span style="color:red;">*</span></label>
        <input 
            type="text" 
            class="form-control spaced-input @error('concerned_person_name') is-invalid @enderror" 
            id="concerned_person_name" 
            name="concerned_person_name" 
            value="{{ old('concerned_person_name') }}" 
            required
        >
        @error('concerned_person_name')
            <span class="text-danger">This Field is Required</span>
        @enderror
    </div>

    <div class="col-md-2">
        <label id="labelinput" for="concerned_person_designation" class="required">Designation <span style="color:red;">*</span></label>
        <input 
            type="text" 
            class="form-control spaced-input @error('concerned_person_designation') is-invalid @enderror" 
            id="concerned_person_designation" 
            name="concerned_person_designation" 
            value="{{ old('concerned_person_designation') }}" 
            required
        >
        @error('concerned_person_designation')
            <span class="text-danger">This Field is Required</span>
        @enderror
    </div>

    <div class="col-md-3">
        <label id="labelinput" for="concerned_person_email" class="required">Email <span style="color:red;">*</span></label>
        <input 
            type="email" 
            class="form-control spaced-input @error('concerned_person_email') is-invalid @enderror" 
            id="concerned_person_email" 
            name="concerned_person_email" 
            value="{{ old('concerned_person_email') }}" 
            required
        >
        @error('concerned_person_email')
            <span class="text-danger">This Field is Required</span>
        @enderror
    </div>

    <div class="col-md-3">
        <label id="labelinput" for="concerned_person_phone" class="phone required">Phone <span style="color:red;">*</span></label>
        <input 
            type="number" 
            class="form-control spaced-input @error('concerned_person_phone') is-invalid @enderror" 
            id="concerned_person_phone" 
            name="concerned_person_phone" 
            value="{{ old('concerned_person_phone') }}" 
            required 
            maxlength="10" 
            oninput="this.value=this.value.slice(0, 10)"
        >
        @error('concerned_person_phone')
            <span class="text-danger">This Field is Required</span>
        @enderror
    </div>
</div>

    <hr>

    <!-- Company Links Section -->
                    
    <div class="row g-3">
    <div class="col-sm-2">
        <h3 class="mt-4" style="font-size: 22px; font-weight: 600;">Company Links</h3>
    </div>
    <div class="col-md-5">
        <label id="labelinput" for="company_website" class="required">Company Website <span style="color:red;">*</span></label>
        <input 
            type="url" 
            class="form-control spaced-input @error('website') is-invalid @enderror" 
            id="company_website" 
            name="website" 
            value="{{ old('website') }}" 
            required
        >
        @error('website')
            <span class="text-danger">This Field is Required</span>
        @enderror
    </div>
    <div class="col-md-5">
        <label id="labelinput" for="linkedin_link">LinkedIn <span style="color:red;">*</span></label>
        <input 
            type="url" 
            class="form-control spaced-input @error('linkedin') is-invalid @enderror" 
            id="linkedin_link" 
            name="linkedin" 
            value="{{ old('linkedin') }}" 
            required
        >
        @error('linkedin')
            <span class="text-danger">This Field is Required</span>
        @enderror
    </div>
</div>
<div class="row g-3 mt-1">
    <div class="col-sm-2">
        <h3 class="mt-2" style="font-size: 22px; font-weight: 600;">Other Links</h3>
    </div>
    <div class="col-sm-10" id="public-links-container">
        <div class="input-group mb-3">
            <input 
                class="form-control spaced-input @error('public_links.0') is-invalid @enderror" 
                type="url" 
                name="public_links[]" 
                placeholder="URL" 
                value="{{ old('public_links.0') }}"
            >
            
            <select 
                class="form-control spaced-input @error('link_descriptions.0') is-invalid @enderror" 
                name="link_descriptions[]" 
                required
            >
                <option value="" disabled {{ old('link_descriptions.0') ? '' : 'selected' }}>Select Account</option>
                <option value="Facebook" {{ old('link_descriptions.0') == 'Facebook' ? 'selected' : '' }}>Facebook</option>
                <option value="Twitter" {{ old('link_descriptions.0') == 'Twitter' ? 'selected' : '' }}>Twitter</option>
                <option value="Others" {{ old('link_descriptions.0') == 'Others' ? 'selected' : '' }}>Others</option>
            </select>
            
            <button 
                class="btn btn-info float-end" 
                style="margin-right: 8px;" 
                type="button" 
                onclick="addPublicLinkField()"
            >
                + Add More Links
            </button>
        </div>
        @error('public_links.0')
                <span class="text-danger">This Field is Required</span>
            @enderror
    </div>
</div>

<hr>
    <!-- Founder Details Section -->
    <div id="founder-details-container" class="row g-1">
    <div class="col-sm-2">
        <h3 class="mt-4" style="font-size: 22px; font-weight: 600;">Founder Details</h3>
    </div>

    <div class="col-md-2">
        <label id="labelinput" for="founder_name" class="required">Name <span style="color:red;">*</span></label>
        <input 
            type="text" 
            class="form-control @error('founder_name.0') is-invalid @enderror" 
            name="founder_name[]" 
            value="{{ old('founder_name.0') }}" 
            required
        >
        @error('founder_name.0')
            <span class="text-danger">This Field is Required</span>
        @enderror
    </div>
    <div class="col-md-2">
        <label id="labelinput" for="founder_position" class="required">Position</label>
        <select 
            class="form-control @error('founder_position.0') is-invalid @enderror" 
            name="founder_position[]" 
            required
        >
                <option value="" disabled selected>Select Position <span style="color:red;"></span></option>
                <option value="Chief Administrative Officer">Chief Administrative Officer</option>
                        <option value="Chief Analytics Officer">Chief Analytics Officer</option>
                        <option value="Chief Brand Officer">Chief Brand Officer</option>
                        <option value="Chief Business Development Officer">Chief Business Development Officer</option>
                        <option value="Chief Business Officer">Chief Business Officer</option>
                        <option value="Chief Commercial Officer">Chief Commercial Officer</option>
                        <option value="Chief Communications Officer">Chief Communications Officer</option>
                        <option value="Chief Compliance Officer">Chief Compliance Officer</option>
                        <option value="Chief Content Officer">Chief Content Officer</option>
                        <option value="Chief Creative Officer">Chief Creative Officer</option>
                        <option value="Chief Customer Officer">Chief Customer Officer</option>
                        <option value="Chief Data Officer">Chief Data Officer</option>
                        <option value="Chief Design Officer">Chief Design Officer</option>
                        <option value="Chief Digital Officer">Chief Digital Officer</option>
                        <option value="Chief Diversity Officer">Chief Diversity Officer</option>
                        <option value="Chief Executive Officer">Chief Executive Officer</option>
                        <option value="Chief Experience Officer">Chief Experience Officer</option>
                        <option value="Chief Financial Officer">Chief Financial Officer</option>
                        <option value="Chief Gaming Officer">Chief Gaming Officer</option>
                        <option value="Chief Genealogical Officer">Chief Genealogical Officer</option>
                        <option value="Chief Human Resources Officer">Chief Human Resources Officer</option>
                        <option value="Chief Information Officer">Chief Information Officer</option>
                        <option value="Chief Information Officer (Higher Education)">Chief Information Officer (Higher Education)</option>
                        <option value="Chief Information Security Officer">Chief Information Security Officer</option>
                        <option value="Chief Innovation Officer">Chief Innovation Officer</option>
                        <option value="Chief Investment Officer">Chief Investment Officer</option>
                        <option value="Chief Knowledge Officer">Chief Knowledge Officer</option>
                        <option value="Chief Learning Officer">Chief Learning Officer</option>
                        <option value="Chief Marketing Officer">Chief Marketing Officer</option>
                        <option value="Chief Operating Officer">Chief Operating Officer</option>
                        <option value="Chief Privacy Officer">Chief Privacy Officer</option>
                        <option value="Chief Process Officer">Chief Process Officer</option>
                        <option value="Chief Product Officer">Chief Product Officer</option>
                        <option value="Chief Reputation Officer">Chief Reputation Officer</option>
                        <option value="Chief Research Officer">Chief Research Officer</option>
                        <option value="Chief Restructuring Officer">Chief Restructuring Officer</option>
                        <option value="Chief Risk Officer">Chief Risk Officer</option>
                        <option value="Chief Science Officer">Chief Science Officer</option>
                        <option value="Chief Scientific Officer">Chief Scientific Officer</option>
                        <option value="Chief Security Officer">Chief Security Officer</option>
                        <option value="Chief Services Officer">Chief Services Officer</option>
                        <option value="Chief Strategy Officer">Chief Strategy Officer</option>
                        <option value="Chief Sustainability Officer">Chief Sustainability Officer</option>
                        <option value="Chief Technology Officer">Chief Technology Officer</option>
                        <option value="Chief Visibility Officer">Chief Visibility Officer</option>
                        <option value="Chief Visionary Officer">Chief Visionary Officer</option>
                        <option value="Chief Web Officer">Chief Web Officer</option>
                        <option value="General Manager">General Manager</option>
                        <option value="Manager">Manager</option>
                        <option value="Others">Others</option>
                        <option value="Secretary">Secretary</option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="Vice President">Vice President</option>
                <!-- Add other positions as required -->
            </select>
        @error('founder_position.0')
            <span class="text-danger">This Field is Required</span>
        @enderror
    </div>
    <div class="col-md-2">
        <label id="labelinput" for="founder_education" class="required">Highest Qualification <span style="color:red;">*</span></label>
        <input 
            type="text" 
            class="form-control @error('founder_education.0') is-invalid @enderror" 
            name="founder_education[]" 
            value="{{ old('founder_education.0') }}" 
            required
        >
        @error('founder_education.')
            <span class="text-danger">This Field is Required</span>
        @enderror
    </div>
    <div class="col-md-3">
        <label id="labelinput" for="founder_experience" class="required">Work Experience (In Years) <span style="color:red;">*</span></label>
        <input 
            type="number" 
            class="form-control @error('founder_experience.0') is-invalid @enderror" 
            name="founder_experience[]" 
            value="{{ old('founder_experience.0') }}" 
            required
        >
        @error('founder_experience.0')
            <span class="text-danger">This Field is Required</span>
        @enderror
    </div>
    <div class="col-md-1">
        <button class="btn btn-info float-end mt-4" type="button" onclick="addFounderField()">+</button>
    </div>
</div>
    <hr>

     <!-- Requirements of Fund Section -->
   <div id="funds-container" class="mb-4">
    <div class="heading-with-hr">
        <h3 class="mb-1" style="font-size: 22px; font-weight: 600;">Requirements of Fund</h3>
        <hr>
    </div>
    <div class="row mb-3 align-items-end">
        <div class="col-md-3">
            <label id="labelinput" for="fund_usage" class="required">Usage of Fund <span style="color:red;">*</span></label>
            <select 
                class="form-control spaced-input @error('fund_usage.0') is-invalid @enderror" 
                name="fund_usage[]" 
                required
            >
                <option value="" disabled {{ old('fund_usage.0') ? '' : 'selected' }}>Select Usage</option>
                <option value="Capex" {{ old('fund_usage.0') == 'Capex' ? 'selected' : '' }}>Capex</option>
                <option value="Opex" {{ old('fund_usage.0') == 'Opex' ? 'selected' : '' }}>Opex</option>
                <option value="Acquisition" {{ old('fund_usage.0') == 'Acquisition' ? 'selected' : '' }}>Acquisition</option>
                <option value="Debt Requirement" {{ old('fund_usage.0') == 'Debt Requirement' ? 'selected' : '' }}>Debt Requirement</option>
                <option value="Others" {{ old('fund_usage.0') == 'Others' ? 'selected' : '' }}>Others</option>
            </select>
            @error('fund_usage.0')
                <span class="text-danger d-block">This Field is Required</span>
            @enderror
        </div>

        <div class="col-md-8">
            <label id="labelinput" for="fund_requirement" class="required">Fund Requirement <span style="color:red;">*</span></label>
            <div class="input-group">
                <input 
                    class="form-control spaced-input @error('fund_requirement.0') is-invalid @enderror " 
                    type="number" 
                    name="fund_requirement[]" 
                    value="{{ old('fund_requirement.0') }}" 
                    required
                >
                
                <select 
                    class="form-select spaced-input @error('fund_unit.0') is-invalid @enderror" 
                    name="fund_unit[]" 
                    required
                >
                    <option value="crores" {{ old('fund_unit.0') == 'crores' ? 'selected' : '' }}>Cr</option>
                    <option value="lakhs" {{ old('fund_unit.0') == 'lakhs' ? 'selected' : '' }}>Lakh</option>
                </select>
               
            </div>
           
        </div>
         

        <div class="col-md-1 mt-3">
            <button class="btn btn-info float-end" type="button" onclick="addFundField()">+ </button>
        </div>
       
           @error('fund_requirement.0')
            <span class="text-danger d-block mt-1">This Field is Required</span>
        @enderror
        @error('fund_unit.0')
            <span class="text-danger d-block mt-1">This Field is Required</span>
        @enderror
    </div>
</div>

<div class="form-floating mb-1">
    <input 
        type="text" 
        class="form-control spaced-input" 
        id="total_fund_raised" 
        name="total_fund_raised" 
        value="{{ old('total_fund_raised') }}" 
        readonly
    >
    <label id="labelinput" for="fund_requirement" class="required">Total Fund Raised</label>
</div>



   <div id="previous-rounds-container" class="mb-4">
    <div class="row mb-3">
        <div class="heading-with-hr">
            <h3 class="mb-1" style="font-size: 22px; font-weight: 600;">Previous Rounds</h3>
            <hr>
        </div>
        <div class="col-md-2">
            <label id="labelinput" for="previous_rounds" class="required">Previous Round <span style="color:red;">*</span></label>
            <select 
                class="form-control spaced-input @error('previous_rounds.0') is-invalid @enderror" 
                name="previous_rounds[]" 
                required
            >
                <option value="" disabled {{ old('previous_rounds.0') ? '' : 'selected' }}>Select Round</option>
                <option value="Pre seed round" {{ old('previous_rounds.0') == 'Pre seed round' ? 'selected' : '' }}>Pre seed round</option>
                <option value="Seed Round" {{ old('previous_rounds.0') == 'Seed Round' ? 'selected' : '' }}>Seed Round</option>
                <option value="Series A round" {{ old('previous_rounds.0') == 'Series A round' ? 'selected' : '' }}>Series A round</option>
                <option value="Series B round" {{ old('previous_rounds.0') == 'Series B round' ? 'selected' : '' }}>Series B round</option>
                <option value="Series C round" {{ old('previous_rounds.0') == 'Series C round' ? 'selected' : '' }}>Series C round</option>
                <option value="Series D round" {{ old('previous_rounds.0') == 'Series D round' ? 'selected' : '' }}>Series D round</option>
                <option value="Series E and beyond" {{ old('previous_rounds.0') == 'Series E and beyond' ? 'selected' : '' }}>Series E and beyond</option>
            </select>
            @error('previous_rounds.0')
                <span class="text-danger">This Field is Required</span>
            @enderror
        </div>
        <div class="col-md-3">
            <label id="labelinput" for="investors" class="required">Investors <span style="color:red;">*</span></label>
            <input 
                type="text" 
                class="form-control spaced-input @error('investors.0') is-invalid @enderror" 
                name="investors[]" 
                value="{{ old('investors.0') }}" 
                required
            >
            @error('investors.0')
                <span class="text-danger">This Field is Required</span>
            @enderror
        </div>
        <div class="col-md-3">
            <label id="labelinput" for="amount_raised" class="required">Amount Raised (in cr) <span style="color:red;">*</span></label>
            <input 
                type="number" 
                class="form-control spaced-input @error('amount_raised.0') is-invalid @enderror" 
                name="amount_raised[]" 
                min="0" 
                step="0.01" 
                value="{{ old('amount_raised.0') }}" 
                required
            >
            @error('amount_raised.0')
                <span class="text-danger">This Field is Required</span>
            @enderror
        </div>
        <div class="col-md-3">
            <label id="labelinput" for="valuation" class="required">Valuation (in cr) <span style="color:red;">*</span></label>
            <input 
                type="number" 
                class="form-control spaced-input @error('valuation.0') is-invalid @enderror" 
                name="valuation[]" 
                value="{{ old('valuation.0') }}" 
                required
            >
            @error('valuation.0')
                <span class="text-danger">This Field is Required</span>
            @enderror
        </div>
        <div class="col-md-1">
            <button class="btn btn-info float-end mt-4" type="button" onclick="addPreviousRoundField()">+</button>
        </div>
    </div>
</div>
<hr>

<!-- Attachments Section -->
<div class="heading-with-hr">
    <h3 class="mb-1" style="font-size: 22px; font-weight: 600;">Attachments</h3>
    <hr>
</div>
<div class="mb-1">
    <label id="labelinput" for="pitch_deck" class="required" style="color: red;">Pitch Deck <span style="color:red;">*</span></label>
    <input 
        type="file" 
        class="form-control spaced-input @error('pitch_deck') is-invalid @enderror" 
        id="pitch_deck" 
        name="pitch_deck" 
        required
    >
    @error('pitch_deck')
        <span class="text-danger">This Field is Required</span>
    @enderror
</div>
<div class="mb-1">
    <label id="labelinput" for="financials" class="required" style="color:red;">Financials</label>
    <div id="financials-container">
        <div class="row mb-4 align-items-end">
            <div class="col-md-3">
                <label id="labelinput" for="fiscal_year" class="required">Fiscal Year <span style="color:red;">*</span></label>
                <select 
                    class="form-control spaced-input @error('fiscal_year.0') is-invalid @enderror" 
                    name="fiscal_year[]" 
                    required
                >
                    <option value="" disabled {{ old('fiscal_year.0') ? '' : 'selected' }}>Select Year</option>
                    <option value="2020" {{ old('fiscal_year.0') == '2020' ? 'selected' : '' }}>2020-2021</option>
                    <option value="2021" {{ old('fiscal_year.0') == '2021' ? 'selected' : '' }}>2021-2022</option>
                    <option value="2022" {{ old('fiscal_year.0') == '2022' ? 'selected' : '' }}>2022-2023</option>
                    <option value="2023" {{ old('fiscal_year.0') == '2023' ? 'selected' : '' }}>2023-2024</option>
                </select>
                @error('fiscal_year.0')
                    <span class="text-danger">This Field is Required</span>
                @enderror
            </div>
            <div class="col-md-8">
                <label id="labelinput" for="financials" class="required">Choose file <span style="color:red;">*</span></label>
                <input 
                    type="file" 
                    class="form-control spaced-input @error('financials.0') is-invalid @enderror" 
                    name="financials[]" 
                    accept=".pdf,.doc,.docx" 
                    required
                >
                @error('financials.0')
                    <span class="text-danger">This Field is Required</span>
                @enderror
            </div>
            <div class="col-md-1">
                <button class="btn btn-info float-end" type="button" onclick="addFinancialsField()">+ </button>
            </div>
        </div>
    </div>
</div>

<div class="mb-4">
    <label id="labelinput" for="other_attachment" style="color: red;">Other Attachment</label>
    <input 
        type="file" 
        class="form-control spaced-input @error('other_attachment') is-invalid @enderror" 
        id="other_attachment" 
        name="other_attachment"
    >
    @error('other_attachment')
        <span class="text-danger">This Field is Required</span>
    @enderror
</div>
<hr>

<!-- Referral Source Section -->
<div class="row mb-2 align-items-end bordered-row">
    <div class="heading-with-hr">
        <h3 class="mb-1" style="font-size: 22px; font-weight: 600;">How did you hear about Investor Dekho? <span style="color:red;">*</span></h3>
        <hr>
    </div>
    <div class="form-floating mb-4">
        <label id="labelinput" for="referral_source" class="required"></label>
        <select 
            class="form-control spaced-input @error('referral_source') is-invalid @enderror" 
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
        @error('referral_source')
            <span class="text-danger">This Field is Required</span>
        @enderror
    </div>
</div>


    <!-- CAPTCHA Section -->
   
    <!-- Terms and Conditions Section -->
    <div class="form-check mb-4">
        <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
        <label class="form-check-label" for="terms">I agree to the <a href="{{ route('terms') }}">Terms and Conditions</a></label>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary py-3 px-5 w-100">Submit</button>
</form>

</div>

<!-- Script for Auto-Fill Functionality -->
<script>
   document.getElementById('concerned_person_is_me').addEventListener('change', function() {
    const nameField = document.getElementById('concerned_person_name');
    const emailField = document.getElementById('concerned_person_email');
    const phoneField = document.getElementById('concerned_person_phone');

    if (this.checked) {
        // Auto-fill the fields with the registered user's details
        nameField.value = "{{ auth()->user()->name }}";
        emailField.value = "{{ auth()->user()->email }}";
        phoneField.value = "{{ auth()->user()->phone }}";

        // Disable the fields to prevent editing
        nameField.setAttribute('readonly', true);
        emailField.setAttribute('readonly', true);
        phoneField.setAttribute('readonly', true);
    } else {
        // Clear the fields and allow them to be edited again
        nameField.value = '';
        emailField.value = '';
        phoneField.value = '';

        // Enable the fields for editing
        nameField.removeAttribute('readonly');
        emailField.removeAttribute('readonly');
        phoneField.removeAttribute('readonly');
    }
});


// Function to add a new link field
function addPublicLinkField() {
    // Get the public links container
    const container = document.getElementById('public-links-container');

    // Create a new div for the input group with row structure to match Bootstrap columns
    const newRow = document.createElement('div');
    newRow.classList.add('row', 'g-0', 'mb-3');

    // Create the URL input field with the same col-sm-5 class
    const urlDiv = document.createElement('div');
    urlDiv.classList.add('col-sm-5');
    const urlInput = document.createElement('input');
    urlInput.type = 'url';
    urlInput.name = 'public_links[]';
    urlInput.classList.add('form-control', 'spaced-input');
    urlInput.placeholder = 'URL';

    // Create the select dropdown with the same col-sm-5 class
    const selectDiv = document.createElement('div');
    selectDiv.classList.add('col-sm-5');
    const select = document.createElement('select');
    select.name = 'link_descriptions[]';
    select.classList.add('form-control', 'spaced-input');
    select.required = true;

    // Add options to the select field
    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.disabled = true;
    defaultOption.selected = true;
    defaultOption.textContent = 'Select Account';

    const facebookOption = document.createElement('option');
    facebookOption.value = 'Facebook';
    facebookOption.textContent = 'Facebook';

    const twitterOption = document.createElement('option');
    twitterOption.value = 'Twitter';
    twitterOption.textContent = 'Twitter';

    const othersOption = document.createElement('option');
    othersOption.value = 'Others';
    othersOption.textContent = 'Others';

    select.appendChild(defaultOption);
    select.appendChild(facebookOption);
    select.appendChild(twitterOption);
    select.appendChild(othersOption);

    // Create the remove button with the col-sm-2 class to align with Add More Links
    const buttonDiv = document.createElement('div');
    buttonDiv.classList.add('col-sm-2', 'text-end'); // Align right for consistency with Add More Links
    const removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.classList.add('btn', 'btn-danger');
    removeButton.textContent = '×';
    removeButton.onclick = function() {
        removeLinkField(removeButton);
    };

    // Append all elements to the respective divs
    urlDiv.appendChild(urlInput);
    selectDiv.appendChild(select);
    buttonDiv.appendChild(removeButton);

    // Append all divs to the newRow
    newRow.appendChild(urlDiv);
    newRow.appendChild(selectDiv);
    newRow.appendChild(buttonDiv);

    // Append the new row to the container
    container.appendChild(newRow);
}

// Function to remove a link field
function removeLinkField(button) {
    const row = button.closest('.row');
    row.remove();  // Remove the parent row div
}



// Founder Field Adding functionality
    function addFounderField() {
    // Get the container that holds all the founder fields
    var container = document.getElementById('founder-details-container');

    // Create a new row div to hold the cloned fields
    var newRow = document.createElement('div');
    newRow.className = 'row g-1';

    // Define the HTML structure for the new fields
    newRow.innerHTML = `
        <div class="col-sm-2">
        <h3 class="mt-4" style="font-size: 22px; font-weight: 600;"></h3>
        </div>
        <div class="col-md-2">
            <label id="labelinput" for="founder_name" class="required">Name</label>
            <input type="text" class="form-control" name="founder_name[]" required>
        </div>
        <div class="col-md-2">
            <label id="labelinput" for="founder_position" class="required">Position</label>
            <select class="form-control" name="founder_position[]" required>
                <option value="" disabled selected>Select Position</option>
                <option value="Chief Administrative Officer">Chief Administrative Officer</option>
                <option value="Chief Analytics Officer">Chief Analytics Officer</option>
                <option value="Chief Brand Officer">Chief Brand Officer</option>
                <option value="Chief Business Development Officer">Chief Business Development Officer</option>
                <option value="Chief Business Officer">Chief Business Officer</option>
                <option value="Chief Commercial Officer">Chief Commercial Officer</option>
                <option value="Chief Communications Officer">Chief Communications Officer</option>
                <option value="Chief Compliance Officer">Chief Compliance Officer</option>
                <option value="Chief Content Officer">Chief Content Officer</option>
                <option value="Chief Creative Officer">Chief Creative Officer</option>
                <option value="Chief Customer Officer">Chief Customer Officer</option>
                <option value="Chief Data Officer">Chief Data Officer</option>
                <option value="Chief Design Officer">Chief Design Officer</option>
                <option value="Chief Digital Officer">Chief Digital Officer</option>
                <option value="Chief Diversity Officer">Chief Diversity Officer</option>
                <option value="Chief Executive Officer">Chief Executive Officer</option>
                <option value="Chief Experience Officer">Chief Experience Officer</option>
                <option value="Chief Financial Officer">Chief Financial Officer</option>
                <option value="Chief Gaming Officer">Chief Gaming Officer</option>
                <option value="Chief Genealogical Officer">Chief Genealogical Officer</option>
                <option value="Chief Human Resources Officer">Chief Human Resources Officer</option>
                <option value="Chief Information Officer">Chief Information Officer</option>
                <option value="Chief Information Officer (Higher Education)">Chief Information Officer (Higher Education)</option>
                <option value="Chief Information Security Officer">Chief Information Security Officer</option>
                <option value="Chief Innovation Officer">Chief Innovation Officer</option>
                <option value="Chief Investment Officer">Chief Investment Officer</option>
                <option value="Chief Knowledge Officer">Chief Knowledge Officer</option>
                <option value="Chief Learning Officer">Chief Learning Officer</option>
                <option value="Chief Marketing Officer">Chief Marketing Officer</option>
                <option value="Chief Operating Officer">Chief Operating Officer</option>
                <option value="Chief Privacy Officer">Chief Privacy Officer</option>
                <option value="Chief Process Officer">Chief Process Officer</option>
                <option value="Chief Product Officer">Chief Product Officer</option>
                <option value="Chief Reputation Officer">Chief Reputation Officer</option>
                <option value="Chief Research Officer">Chief Research Officer</option>
                <option value="Chief Restructuring Officer">Chief Restructuring Officer</option>
                <option value="Chief Risk Officer">Chief Risk Officer</option>
                <option value="Chief Science Officer">Chief Science Officer</option>
                <option value="Chief Scientific Officer">Chief Scientific Officer</option>
                <option value="Chief Security Officer">Chief Security Officer</option>
                <option value="Chief Services Officer">Chief Services Officer</option>
                <option value="Chief Strategy Officer">Chief Strategy Officer</option>
                <option value="Chief Sustainability Officer">Chief Sustainability Officer</option>
                <option value="Chief Technology Officer">Chief Technology Officer</option>
                <option value="Chief Visibility Officer">Chief Visibility Officer</option>
                <option value="Chief Visionary Officer">Chief Visionary Officer</option>
                <option value="Chief Web Officer">Chief Web Officer</option>
                <option value="General Manager">General Manager</option>
                <option value="Manager">Manager</option>
                <option value="Others">Others</option>
                <option value="Secretary">Secretary</option>
                <option value="Supervisor">Supervisor</option>
                <option value="Vice President">Vice President</option>
            </select>
        </div>
        <div class="col-md-2">
            <label id="labelinput" for="founder_education" class="required">Highest Qualification</label>
            <input type="text" class="form-control" name="founder_education[]" required>
        </div>
        <div class="col-md-3">
            <label id="labelinput" for="founder_experience" class="required">Work Experience (In Years)</label>
            <input type="number" class="form-control " name="founder_experience[]" required>
        </div>
        <div class="col-md-1">
            <button class="btn btn-danger float-end mt-4" type="button" onclick="removeFounderField(this)">×</button>
        </div>
    `;

    // Append the new row to the container
    container.appendChild(newRow);
}

// Function to remove founder fields
function removeFounderField(button) {
    // Find the row and remove it
    button.closest('.row').remove();
}


document.addEventListener('DOMContentLoaded', function () {
    // Attach the event listener to the existing fund fields
    document.querySelectorAll('input[name="fund_requirement[]"]').forEach(function(input) {
        input.addEventListener('input', calculateTotalFund);
    });

    // Function to calculate total fund raised
    function calculateTotalFund() {
        let total = 0;

        // Sum all values from fund_requirement[] inputs
        document.querySelectorAll('input[name="fund_requirement[]"]').forEach(function(input) {
            let value = parseFloat(input.value);
            if (!isNaN(value)) {
                total += value;
            }
        });

        // Update the total fund raised field
        document.getElementById('total_fund_raised').value = total.toFixed(2) + ' Cr';
    }

    // Add new fund fields dynamically with event listener
    window.addFundField = function () {
        const container = document.getElementById('funds-container');
        const newRow = document.createElement('div');
        newRow.className = 'row mb-3 align-items-end';

        newRow.innerHTML = `
            <div class="col-md-3">
                <label id="labelinput" for="fund_usage" class="required">Usage of Fund</label>
                <select class="form-control spaced-input" name="fund_usage[]" required>
                    <option value="" disabled selected>Select Usage</option>
                    <option value="Capex">Capex</option>
                    <option value="Opex">Opex</option>
                    <option value="Acquisition">Acquisition</option>
                    <option value="Debt Requirement">Debt Requirement</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            <div class="col-md-8">
                <label id="labelinput" for="fund_requirement" class="required">Fund Requirement</label>
                <div class="input-group">
                    <input class="form-control spaced-input" type="number" name="fund_requirement[]" required>
                    <select class="form-select spaced-input" name="fund_unit[]" required>
                        <option value="crores">Cr</option>
                        <option value="lakhs">Lakh</option>
                    </select>
                </div>
            </div>
            <div class="col-md-1 mt-3">
                <button class="btn btn-danger float-end" type="button" onclick="removeFundField(this)">×</button>
            </div>
        `;

        container.appendChild(newRow);

        // Attach event listener to the new fund_requirement input
        newRow.querySelector('input[name="fund_requirement[]"]').addEventListener('input', calculateTotalFund);
    };

    // Function to remove fund field and recalculate total
    window.removeFundField = function (button) {
        const row = button.closest('.row');
        row.remove();
        calculateTotalFund(); // Recalculate after removal
    };
});



document.addEventListener('DOMContentLoaded', function () {
    // Function to add a new previous round field set
    window.addPreviousRoundField = function () {
        const container = document.getElementById('previous-rounds-container');
        const newRow = document.createElement('div');
        newRow.className = 'row mb-3 align-items-end bordered-row';

        newRow.innerHTML = `
            <div class="col-md-2">
                <label id="labelinput" for="previous_rounds" class="required">Previous Round</label>
                <select class="form-control spaced-input" name="previous_rounds[]" required>
                    <option value="" disabled selected>Select Round</option>
                    <option value="Pre seed round">Pre seed round</option>
                    <option value="Seed Round">Seed Round</option>
                    <option value="Series A round">Series A round</option>
                    <option value="Series B round">Series B round</option>
                    <option value="Series C round">Series C round</option>
                    <option value="Series D round">Series D round</option>
                    <option value="Series E and beyond">Series E and beyond</option>
                </select>
            </div>
            <div class="col-md-3">
                <label id="labelinput" for="investors" class="required">Investors</label>
                <input type="text" class="form-control spaced-input" name="investors[]" required>
            </div>
            <div class="col-md-3">
                <label id="labelinput" for="amount_raised" class="required">Amount Raised (in cr)</label>
                <input type="number" class="form-control spaced-input" name="amount_raised[]" min="0" step="0.01" required>

            </div>
            <div class="col-md-3">
                <label id="labelinput" for="valuation" class="required">Valuation (in cr)</label>
                <input type="number" class="form-control spaced-input" name="valuation[]" required>
            </div>
            <div class="col-md-1">
                <button class="btn btn-danger float-end" type="button" onclick="removePreviousRoundField(this)">×</button>
            </div>
        `;

        container.appendChild(newRow);
    };

    // Function to remove a previous round field set
    window.removePreviousRoundField = function (button) {
        const row = button.closest('.row');
        row.remove();
    };
});


document.addEventListener('DOMContentLoaded', function () {
    // Function to add a new financials field set
    window.addFinancialsField = function () {
        const container = document.getElementById('financials-container');
        const newRow = document.createElement('div');
        newRow.className = 'row mb-4 align-items-end';

        newRow.innerHTML = `
            <div class="col-md-3">
                <label id="labelinput" for="financial_year" class="required">Fiscal Year</label>
                <select class="form-control spaced-input" name="financial_year[]" required>
                    <option value="" disabled selected>Select Year</option>
                    <option value="2020-2021">2020-2021</option>
                    <option value="2021-2022">2021-2022</option>
                    <option value="2022-2023">2022-2023</option>
                    <option value="2023-2024">2023-2024</option>
                    <option value="2024-2025">2024-2025</option>
                </select>
            </div>
            <div class="col-md-8">
                <label id="labelinput" for="financials" class="required">Choose file</label>
                <input type="file" class="form-control spaced-input" name="financials[]" accept=".pdf,.doc,.docx" required>
            </div>
            <div class="col-md-1">
                <button class="btn btn-danger float-end" type="button" onclick="removeFinancialsField(this)">×</button>
            </div>
        `;

        container.appendChild(newRow);
    };

    // Function to remove a financials field set
    window.removeFinancialsField = function (button) {
        const row = button.closest('.row');
        row.remove();
    };
});



document.getElementById('pitch_deck').addEventListener('change', function() {
        var file = this.files[0];
        var allowedExtensions = /(\.pdf|\.doc|\.docx)$/i;
        
        if (!allowedExtensions.exec(file.name)) {
            document.getElementById('file-error').innerText = 'Invalid file type. Only PDF, DOC, or DOCX files are allowed.';
            this.value = ''; // Clear the file input
        } else {
            document.getElementById('file-error').innerText = ''; // Clear the error message if the file is valid
        }
    });

</script>

@endsection
