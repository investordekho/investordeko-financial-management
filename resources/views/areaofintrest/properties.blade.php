@extends('layouts.app')

@section('content')

<style>
    
            .bg-light {
            --bs-bg-opacity: 1;
            background-color: #e8eaed !important;
            border: 0px;
        }

        .g-3, .gy-3 {
            --bs-gutter-y: -1.30rem;
        }

        .mt-3 {
            margin-top: -1.30rem !important;
        }

        .breadcrumb {
            display: flex;
            flex-wrap: wrap;
            padding: 0 0;
            margin-bottom: 1rem;
            list-style: none;
            padding: 20px;
            background: #e8eaed;
            color: #198754;
        }

        #locationDropdown, #sectorDropdown, #investmentSizeDropdown, #investmentTenureDropdown, #investorTypeDropdown, #idsortby {
            color: #198754;
            background-color: #ffffff;
            font-family: robot;
            font-weight: 400;
            font-size: 18px;
            border: 0px;
        }
</style>
    <div class="container-fluid page-header mb-1 wow fadeIn" data-wow-delay="0.1s">
        <!-- Two tab for investee and investor dashboard -->

        @if (Auth::user()->category_id == 3 || Auth::user()->category_id == 4)
        <style>
            .dashboard-tabs-container {
                margin-top: 20px;
                background: rgba(255, 255, 255, 0.6);
                border-radius: 16px;
                padding: 15px;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
                backdrop-filter: blur(10px);
            }

            .dashboard-tabs .nav-link {
                color: #198754;
                background-color: transparent;
                border: none;
                border-radius: 12px;
                margin: 0 8px;
                transition: all 0.3s ease;
                font-weight: 500;
            }

            .dashboard-tabs .nav-link.active {
                background-color: #198754;
                color: #fff;
                font-weight: 600;
                box-shadow: 0 4px 10px rgba(25, 135, 84, 0.3);
            }

            .dashboard-tabs .nav-link:hover {
                background-color: rgba(25, 135, 84, 0.1);
                color: #198754;
            }

            @media (max-width: 576px) {
                .dashboard-tabs .nav-link {
                    display: block;
                    margin-bottom: 10px;
                }
            }
        </style>

        <!-- <div class="container dashboard-tabs-container">
            <ul class="nav nav-tabs justify-content-center dashboard-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a 
                        class="nav-link {{ request()->routeIs('investee.dashboard') ? 'active' : '' }}" 
                        id="investee-tab" 
                        href="{{ route('investee.dashboard') }}" 
                        role="tab" 
                        aria-controls="investee" 
                        aria-selected="{{ request()->routeIs('investee.dashboard') ? 'true' : 'false' }}"
                    >
                        Investee Dashboard
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a 
                        class="nav-link {{ request()->routeIs('investor.dashboard') ? 'active' : '' }}" 
                        id="investor-tab" 
                        href="{{ route('investor.dashboard') }}" 
                        role="tab" 
                        aria-controls="investor" 
                        aria-selected="{{ request()->routeIs('investor.dashboard') ? 'true' : 'false' }}"
                    >
                        Investor Dashboard
                    </a>
                </li>
            </ul>
        </div> -->
        <!-- 1 -->
        <!-- 2 -->


        @endif


            

        <div class="container" style="margin-top: 20px; margin-bottom: 20px;">
            <h1 style="font-size: 16px; color: grey;" class="mb-1 animated slideInDown">Welcome {{ Auth::user()->name }} </h1>
        </div>
    </div>
      <div class="container my-4">
  <div class="card shadow-lg border-0 subscription-card p-4">
    <h4 class="fw-bold text-success mb-3">
      <i class="bi bi-funnel-fill me-2"></i> Customize Your Subscription
    </h4>

    <form id="searchForm" method="post" action="{{ route('sectorintresteddata') }}">
      @csrf

     
      <div class="filter-section mb-3">
        <h6 class="fw-semibold text-dark">
          <i class="bi bi-diagram-3-fill text-success me-1"></i> Startup Sector
        </h6>
        <div class="scrollable-box">
         
            @foreach([
              'Accounting', 'Adtech', 'Advanced Manufacturing', 'Aerospace', 'Agriculture',
              'Agritech and Farming', 'AI and ML', 'Airlines/Aviation', 'Alternative Dispute Resolution',
              'Alternative Investment Funds', 'Alternative Medicine', 'Analytics', 'Animation',
              'APIs', 'Apparel/Fashion', 'Apps', 'Architecture/Planning', 'Arts/Crafts', 'Augmented Reality (AR)',
              'Autonomous Vehicles', 'Automotive', 'Aviation/Aerospace', 'B2B Marketplaces', 'B2B Software',
              'B2B2C', 'Banks', 'Banking/Mortgage', 'BFSI', 'Big Data', 'Biotech', 'Biotechnology/Greentech',
              'Blockchain', 'Blockchain Startups', 'Broadcast Media', 'Building Materials',
              'Business Support Services', 'Business Supplies/Equipment', 'Capital Goods',
              'Capital Markets/Hedge Fund/Private Equity', 'CCUS', 'Chemicals', 'Civic/Social Organization',
              'Civil Engineering', 'Cleantech', 'ClimateTech/CleanTech', 'Cloud Computing',
              'Commercial Real Estate', 'Community and Lifestyle', 'Computer Games', 'Computer Hardware',
              'Computer Networking', 'Computer Software/Engineering', 'Consumer', 'Consumer Goods',
              'Consumer Internet', 'Content and Publishing', 'Cosmetics', 'Creative Economy',
              'Crypto', 'Cyber Security', 'Data and Analytics', 'Deep Tech', 'Deep Tech and Fintech',
              'Design', 'Digital Assets', 'Digital Health', 'Digital Media', 'eCommerce', 'EdTech',
              'Education Management', 'Energy', 'Enterprise Applications', 'Enterprise Software',
              'Environment Tech', 'Extended Reality (XR)', 'Fashion', 'Fin-Tech', 'Financial Exchanges',
              'Financial Services', 'Food and Beverage', 'Food/Beverages', 'Fundraising', 'Gaming',
              'Government Administration', 'Green Molecules', 'Hardware', 'Health/Fitness',
              'Healthcare & Life Sciences', 'HealthTech', 'High Tech', 'Hospital/Health Care',
              'Hospitality Investment', 'Human Resources/HR', 'Hydrogen', 'Import/Export',
              'Industrial Goods and Manufacturing', 'Information Technology/IT', 'Infra',
              'Insurtech', 'Insurance', 'Internet', 'IoT', 'IT', 'Legal Services', 'Life Sciences',
              'Logistics', 'Logistics/Procurement', 'Marketing/Advertising/Sales', 'Marketplaces',
              'Mechanical Engineering', 'Media and Entertainment', 'Media Production',
              'Medical Equipment', 'Medical Practice', 'Micro Lending', 'Minerals Business',
              'Mining/Metals', 'Mobile', 'Mobile Technology', 'NBFC', 'Natural Health Products',
              'Non-Profit/Volunteering', 'Nonprofits', 'Oil/Energy/Solar/Greentech',
              'Personal Finance', 'Pharmaceuticals', 'Platforms', 'Proptech', 'Public Relations/PR',
              'Real Estate and Construction', 'Real Estate/Mortgage', 'Retail', 'Retail Industry',
              'SaaS', 'Science and Engineering', 'Semiconductor', 'Smart Hardware', 'Social Media',
              'Software', 'Space', 'Start-ups', 'Sustainability', 'Sustainable Sectors',
              'Technology', 'Telecommunications', 'Trading Platform', 'Transportation',
              'Transportation and Logistics Tech', 'Utilities', 'vSaaS', 'Vertical SaaS',
              'Virtual Reality', 'Warehousing', 'Web3', 'Web3 + Gaming', 'Web3-focused Startups'
            ] as $sector)
              <div class="form-check">
                <input class="form-check-input filter-checkbox" type="checkbox" name="sector[]" value="{{ $sector }}" id="{{ \Illuminate\Support\Str::slug($sector, '_') }}">
                <label class="form-check-label" for="{{ \Illuminate\Support\Str::slug($sector, '_') }}">{{ $sector }}</label>
              </div>
            @endforeach
        </div>
      </div>

      
      <!-- Location Dropdown -->
              <div class="filter-section mb-3">
                <h6 class="fw-semibold text-dark">
                  <i class="bi bi-diagram-3-fill text-success me-1"></i> Location
                </h6>
                <div class="scrollable-box">
                  @foreach([
                     'Adilabad', 'Agartala', 'Agra', 'Agraharam', 'Ahmedabad', 'Aizawl', 'Ajmer', 'Alappuzha', 
                      'Aligarh', 'Allahabad', 'Alwar', 'Ambala', 'Amravati', 'Amritsar', 'Andaman and Nicobar Islands', 
                      'Andhra Pradesh', 'Arunachal Pradesh', 'Asansol', 'Assam', 'Aurangabad', 'Bangalore', 'Bareilly', 
                      'Belgaum', 'Bellary', 'Bhilai', 'Bhopal', 'Bhubaneswar', 'Bhubaneshwar', 'Bihar', 'Bihar Sharif', 
                      'Bilaspur', 'Bikaner', 'Bokaro', 'Calicut', 'Chandigarh', 'Chandrapur', 'Chhattisgarh', 'Chennai', 
                      'Coimbatore', 'Cuttack', 'Dadra and Nagar Haveli and Daman and Diu', 'Daman', 'Darbhanga', 'Dehradun', 
                      'Delhi', 'Dhanbad', 'Dharamshala', 'Dindigul', 'Durgapur', 'Erode', 'Faridabad', 'Firozabad', 'Goa', 
                      'Gorakhpur', 'Gujarat', 'Gulbarga', 'Guntur', 'Gurgaon', 'Gurugram', 'Guwahati', 'Gwalior', 'Haldwani', 
                      'Haryana', 'Hisar', 'Himachal Pradesh', 'Hosur', 'Hubli-Dharwad', 'Hyderabad', 'Imphal', 'Indore', 
                      'Itanagar', 'Jabalpur', 'Jaipur', 'Jalandhar', 'Jammu', 'Jammu and Kashmir', 'Jamshedpur', 'Jhansi', 
                      'Jharkhand', 'Jodhpur', 'Kakinada', 'Kalaburagi', 'Kalyan-Dombivli', 'Kanpur', 'Karnal', 'Karnataka', 
                      'Kashmir', 'Karur', 'Kerala', 'Kochi', 'Kolhapur', 'Kolkata', 'Kollam', 'Kota', 'Kozhikode', 'Ladakh', 
                      'Lakshadweep', 'Leh', 'Lucknow', 'Ludhiana', 'Madurai', 'Madhya Pradesh', 'Maharashtra', 'Malappuram', 
                      'Manipur', 'Mangalore', 'Meerut', 'Meghalaya', 'Mizoram', 'Moradabad', 'Mumbai', 'Mysuru', 'Nagaland', 
                      'Nagpur', 'Nanded', 'Nashik', 'Navi Mumbai', 'New Delhi', 'Noida', 'Odisha', 'Panjim', 'Patiala', 
                      'Patna', 'Pimpri-Chinchwad', 'Pondicherry', 'Puducherry', 'Punjab', 'Pune', 'Raebareli', 'Raipur', 
                      'Rajahmundry', 'Rajkot', 'Ranchi', 'Rajasthan', 'Rourkela', 'Saharanpur', 'Salem', 'Sambalpur', 
                      'Sangli', 'Satna', 'Secunderabad', 'Shimla', 'Shillong', 'Siliguri', 'Solapur', 'Srinagar', 'Surat', 
                      'Tamil Nadu', 'Telangana', 'Tenali', 'Thane', 'Thanjavur', 'Thiruvananthapuram', 'Thrissur', 
                      'Tiruchirappalli', 'Tirunelveli', 'Tirupati', 'Tripura', 'Tumkur', 'Udaipur', 'Uttar Pradesh', 
                      'Uttarakhand', 'Vadodara', 'Varanasi', 'Vasai-Virar', 'Vellore', 'Vijayawada', 'Visakhapatnam', 
                      'Warangal', 'West Bengal'
                    ] as $location)
                    <div class="form-check">
                      <input class="form-check-input filter-checkbox" type="checkbox" name="location[]" value="{{ $location }}" id="{{ \Illuminate\Support\Str::slug($location, '_') }}">
                      <label class="form-check-label" for="{{ \Illuminate\Support\Str::slug($location, '_') }}">{{ $location }}</label>
                    </div>
                  @endforeach
                </div>
              </div>

         
     
      

      <!-- Investment Size -->
      <div class="filter-section mb-3">
        <h6 class="fw-semibold text-dark">
          <i class="bi bi-cash-stack text-success me-1"></i> Investment Size
        </h6>
        <div class="scrollable-box">
          <div class="form-check">
            <input class="form-check-input filter-checkbox" type="checkbox" name="investment_size[]" value="<1000000" id="size_below_10">
            <label class="form-check-label" for="size_below_10">Below 10 Lakh</label>
          </div>
          <div class="form-check">
            <input class="form-check-input filter-checkbox" type="checkbox" name="investment_size[]" value="1000000-5000000" id="size_10_50">
            <label class="form-check-label" for="size_10_50">10–50 Lakh</label>
          </div>
          <div class="form-check">
            <input class="form-check-input filter-checkbox" type="checkbox" name="investment_size[]" value="5000000-10000000" id="size_50_100">
            <label class="form-check-label" for="size_50_100">50 Lakh – 1 Crore</label>
          </div>
          <div class="form-check">
            <input class="form-check-input filter-checkbox" type="checkbox" name="investment_size[]" value=">10000000" id="size_100_plus">
            <label class="form-check-label" for="size_100_plus">Above 1 Crore</label>
          </div>
        </div>
      </div>

      <!-- Tenure -->
      <div class="filter-section mb-3">
        <h6 class="fw-semibold text-dark">
          <i class="bi bi-clock-history text-success me-1"></i> Tenure
        </h6>
        <div class="scrollable-box">
          <div class="form-check">
            <input class="form-check-input filter-checkbox" type="checkbox" name="investment_tenure[]" value="0-1 years" id="tenure_1">
            <label class="form-check-label" for="tenure_1">Less than 1 year</label>
          </div>
          <div class="form-check">
            <input class="form-check-input filter-checkbox" type="checkbox" name="investment_tenure[]" value="1-3 years" id="tenure_2">
            <label class="form-check-label" for="tenure_2">1–3 years</label>
          </div>
          <div class="form-check">
            <input class="form-check-input filter-checkbox" type="checkbox" name="investment_tenure[]" value="3-5 years" id="tenure_3">
            <label class="form-check-label" for="tenure_3">3–5 years</label>
          </div>
          <div class="form-check">
            <input class="form-check-input filter-checkbox" type="checkbox" name="investment_tenure[]" value="More than 5 years" id="tenure_4">
            <label class="form-check-label" for="tenure_4">More than 5 years</label>
          </div>
        </div>
      </div>

      <!-- Investor Type -->
      <div class="filter-section mb-3">
        <h6 class="fw-semibold text-dark">
          <i class="bi bi-person-badge-fill text-success me-1"></i> Investor Type
        </h6>
        <div class="scrollable-box">
          <div class="form-check">
            <input class="form-check-input filter-checkbox" type="checkbox" name="investor_type[]" value="Angel" id="inv_angel">
            <label class="form-check-label" for="inv_angel">Angel Investor</label>
          </div>
          <div class="form-check">
            <input class="form-check-input filter-checkbox" type="checkbox" name="investor_type[]" value="Family Office" id="inv_family">
            <label class="form-check-label" for="inv_family">Family Office</label>
          </div>
          <div class="form-check">
            <input class="form-check-input filter-checkbox" type="checkbox" name="investor_type[]" value="PE" id="inv_pe">
            <label class="form-check-label" for="inv_pe">Private Equity</label>
          </div>
          <div class="form-check">
            <input class="form-check-input filter-checkbox" type="checkbox" name="investor_type[]" value="Seed" id="inv_seed">
            <label class="form-check-label" for="inv_seed">Seed Investor</label>
          </div>
          <div class="form-check">
            <input class="form-check-input filter-checkbox" type="checkbox" name="investor_type[]" value="VC" id="inv_vc">
            <label class="form-check-label" for="inv_vc">Venture Capitalist</label>
          </div>
        </div>
      </div>

      <!-- Selected Filters -->
      <div id="selected-filters-container" class="mt-3"></div>

      <!-- Actions -->
      <div class="d-flex justify-content-between mt-4">
        <button type="reset" class="btn btn-outline-secondary rounded-pill px-4">Reset</button>
        <button type="submit" class="btn btn-success rounded-pill px-4 fw-bold">
          <i class="bi bi-search-heart me-1"></i> Apply Filters
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Styles -->
<style>
.subscription-card {
  background: #fff;
  border-radius: 20px;
}
.filter-section h6 {
  font-size: 1rem;
  margin-bottom: 0.5rem;
}
.scrollable-box {
  max-height: 180px;
  overflow-y: auto;
  border: 1px solid #e8eaed;
  border-radius: 10px;
  padding: 0.5rem 0.75rem;
  background: #f9f9f9;
}
.scrollable-box::-webkit-scrollbar {
  width: 6px;
}
.scrollable-box::-webkit-scrollbar-thumb {
  background: #c1e1c1;
  border-radius: 10px;
}
.filter-chip {
  display: inline-block;
  background: #e8f5e9;
  color: #198754;
  padding: 5px 12px;
  margin: 4px;
  border-radius: 20px;
  font-size: 0.9rem;
  cursor: pointer;
  transition: background 0.2s;
}
.filter-chip:hover {
  background: #c8e6c9;
}
</style>

<!-- JS for showing selected filters -->
<script>
document.querySelectorAll('.filter-checkbox').forEach(cb => {
  cb.addEventListener('change', function() {
    let container = document.getElementById('selected-filters-container');
    container.innerHTML = '';
    document.querySelectorAll('.filter-checkbox:checked').forEach(selected => {
      let chip = document.createElement('span');
      chip.classList.add('filter-chip');
      chip.innerHTML = selected.value + ' &times;';
      chip.onclick = () => {
        selected.checked = false;
        chip.remove();
      };
      container.appendChild(chip);
    });
    
    
    
  });
});
</script>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">




<script>

    document.addEventListener('DOMContentLoaded', function () {
        // Initialize the selected filters object       
        let selectedFilters = {
            // sector: [],
            // location: [],
            // investment_size: [],
            // investment_tenure: [],
            // investor_type: [],
            // sort: '',
        };
    });
    // Sector data array
    const sectors = [
    'Accounting', 'Adtech', 'Advanced Manufacturing', 'Aerospace', 'Agriculture',
    'Agritech and Farming', 'AI and ML', 'Airlines/Aviation', 'Alternative Dispute Resolution',
    'Alternative Investment Funds', 'Alternative Medicine', 'Analytics', 'Animation',
    'APIs', 'Apparel/Fashion', 'Apps', 'Architecture/Planning', 'Arts/Crafts', 'Augmented Reality (AR)',
    'Autonomous Vehicles', 'Automotive', 'Aviation/Aerospace', 'B2B Marketplaces', 'B2B Software',
    'B2B2C', 'Banks', 'Banking/Mortgage', 'BFSI', 'Big Data', 'Biotech', 'Biotechnology/Greentech',
    'Blockchain', 'Blockchain Startups', 'Broadcast Media', 'Building Materials',
    'Business Support Services', 'Business Supplies/Equipment', 'Capital Goods',
    'Capital Markets/Hedge Fund/Private Equity', 'CCUS', 'Chemicals', 'Civic/Social Organization',
    'Civil Engineering', 'Cleantech', 'ClimateTech/CleanTech', 'Cloud Computing',
    'Commercial Real Estate', 'Community and Lifestyle', 'Computer Games', 'Computer Hardware',
    'Computer Networking', 'Computer Software/Engineering', 'Consumer', 'Consumer Goods',
    'Consumer Internet', 'Content and Publishing', 'Cosmetics', 'Creative Economy',
    'Crypto', 'Cyber Security', 'Data and Analytics', 'Deep Tech', 'Deep Tech and Fintech',
    'Design', 'Digital Assets', 'Digital Health', 'Digital Media', 'eCommerce', 'EdTech',
    'Education Management', 'Energy', 'Enterprise Applications', 'Enterprise Software',
    'Environment Tech', 'Extended Reality (XR)', 'Fashion', 'Fin-Tech', 'Financial Exchanges',
    'Financial Services', 'Food and Beverage', 'Food/Beverages', 'Fundraising', 'Gaming',
    'Government Administration', 'Green Molecules', 'Hardware', 'Health/Fitness',
    'Healthcare & Life Sciences', 'HealthTech', 'High Tech', 'Hospital/Health Care',
    'Hospitality Investment', 'Human Resources/HR', 'Hydrogen', 'Import/Export',
    'Industrial Goods and Manufacturing', 'Information Technology/IT', 'Infra',
    'Insurtech', 'Insurance', 'Internet', 'IoT', 'IT', 'Legal Services', 'Life Sciences',
    'Logistics', 'Logistics/Procurement', 'Marketing/Advertising/Sales', 'Marketplaces',
    'Mechanical Engineering', 'Media and Entertainment', 'Media Production',
    'Medical Equipment', 'Medical Practice', 'Micro Lending', 'Minerals Business',
    'Mining/Metals', 'Mobile', 'Mobile Technology', 'NBFC', 'Natural Health Products',
    'Non-Profit/Volunteering', 'Nonprofits', 'Oil/Energy/Solar/Greentech',
    'Personal Finance', 'Pharmaceuticals', 'Platforms', 'Proptech', 'Public Relations/PR',
    'Real Estate and Construction', 'Real Estate/Mortgage', 'Retail', 'Retail Industry',
    'SaaS', 'Science and Engineering', 'Semiconductor', 'Smart Hardware', 'Social Media',
    'Software', 'Space', 'Start-ups', 'Sustainability', 'Sustainable Sectors',
    'Technology', 'Telecommunications', 'Trading Platform', 'Transportation',
    'Transportation and Logistics Tech', 'Utilities', 'vSaaS', 'Vertical SaaS',
    'Virtual Reality', 'Warehousing', 'Web3', 'Web3 + Gaming', 'Web3-focused Startups'
    ];


    // Locations array
    // const locations = [
    //     'Adilabad', 'Agra', 'Ahmedabad', 'Bangalore', 'Chennai', 'Delhi', 'Gurgaon', 'Hyderabad', 'Kolkata', 'Mumbai', 'Noida', 'Pune', 'Surat'
    // ];
    const locations = [
        'Adilabad', 'Agartala', 'Agra', 'Agraharam', 'Ahmedabad', 'Aizawl', 'Ajmer', 'Alappuzha', 
        'Aligarh', 'Allahabad', 'Alwar', 'Ambala', 'Amravati', 'Amritsar', 'Andaman and Nicobar Islands', 
        'Andhra Pradesh', 'Arunachal Pradesh', 'Asansol', 'Assam', 'Aurangabad', 'Bangalore', 'Bareilly', 
        'Belgaum', 'Bellary', 'Bhilai', 'Bhopal', 'Bhubaneswar', 'Bhubaneshwar', 'Bihar', 'Bihar Sharif', 
        'Bilaspur', 'Bikaner', 'Bokaro', 'Calicut', 'Chandigarh', 'Chandrapur', 'Chhattisgarh', 'Chennai', 
        'Coimbatore', 'Cuttack', 'Dadra and Nagar Haveli and Daman and Diu', 'Daman', 'Darbhanga', 'Dehradun', 
        'Delhi', 'Dhanbad', 'Dharamshala', 'Dindigul', 'Durgapur', 'Erode', 'Faridabad', 'Firozabad', 'Goa', 
        'Gorakhpur', 'Gujarat', 'Gulbarga', 'Guntur', 'Gurgaon', 'Gurugram', 'Guwahati', 'Gwalior', 'Haldwani', 
        'Haryana', 'Hisar', 'Himachal Pradesh', 'Hosur', 'Hubli-Dharwad', 'Hyderabad', 'Imphal', 'Indore', 
        'Itanagar', 'Jabalpur', 'Jaipur', 'Jalandhar', 'Jammu', 'Jammu and Kashmir', 'Jamshedpur', 'Jhansi', 
        'Jharkhand', 'Jodhpur', 'Kakinada', 'Kalaburagi', 'Kalyan-Dombivli', 'Kanpur', 'Karnal', 'Karnataka', 
        'Kashmir', 'Karur', 'Kerala', 'Kochi', 'Kolhapur', 'Kolkata', 'Kollam', 'Kota', 'Kozhikode', 'Ladakh', 
        'Lakshadweep', 'Leh', 'Lucknow', 'Ludhiana', 'Madurai', 'Madhya Pradesh', 'Maharashtra', 'Malappuram', 
        'Manipur', 'Mangalore', 'Meerut', 'Meghalaya', 'Mizoram', 'Moradabad', 'Mumbai', 'Mysuru', 'Nagaland', 
        'Nagpur', 'Nanded', 'Nashik', 'Navi Mumbai', 'New Delhi', 'Noida', 'Odisha', 'Panjim', 'Patiala', 
        'Patna', 'Pimpri-Chinchwad', 'Pondicherry', 'Puducherry', 'Punjab', 'Pune', 'Raebareli', 'Raipur', 
        'Rajahmundry', 'Rajkot', 'Ranchi', 'Rajasthan', 'Rourkela', 'Saharanpur', 'Salem', 'Sambalpur', 
        'Sangli', 'Satna', 'Secunderabad', 'Shimla', 'Shillong', 'Siliguri', 'Solapur', 'Srinagar', 'Surat', 
        'Tamil Nadu', 'Telangana', 'Tenali', 'Thane', 'Thanjavur', 'Thiruvananthapuram', 'Thrissur', 
        'Tiruchirappalli', 'Tirunelveli', 'Tirupati', 'Tripura', 'Tumkur', 'Udaipur', 'Uttar Pradesh', 
        'Uttarakhand', 'Vadodara', 'Varanasi', 'Vasai-Virar', 'Vellore', 'Vijayawada', 'Visakhapatnam', 
        'Warangal', 'West Bengal'
    ];




    let filterdata = [];

    document.addEventListener('DOMContentLoaded', function () {
        const dropdownMenu = document.querySelector('#investmentSizeDropdown + .dropdown-menu');

        dropdownMenu.querySelectorAll('input, label').forEach(el => {
            el.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function (){
        const investmenttenuareDropDown = document.querySelector('#investmentTenureDropdown + .dropdown-menu');
        investmenttenuareDropDown.querySelectorAll('input,label').forEach(el => {
            el.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        })
    })


    document.addEventListener('DOMContentLoaded', function () {
        // Prevent Bootstrap from closing the dropdown on checkbox or input click
        document.querySelectorAll('.dropdown-menu').forEach(function (dropdownMenu) {
            dropdownMenu.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        });
    });

    function populateSectors() {
        const sectorList = document.getElementById('sectorList');
        const selectedSectors = new Set([...new FormData(document.getElementById('searchForm')).getAll('sector[]')]);

        sectorList.innerHTML = ''; // clear existing

        sectors.forEach(sector => {
            const li = document.createElement('li');
            li.classList.add('dropdown-item');

            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.style.marginRight = '10px';
            checkbox.style.marginLeft = '-25px';
            checkbox.name = 'sector[]';
            checkbox.value = sector;
            checkbox.id = `sector_${sector}`;
            checkbox.classList.add('form-check-input');
            if (selectedSectors.has(sector)) checkbox.checked = true;

            const label = document.createElement('label');
            label.classList.add('form-check-label');
            label.setAttribute('for', `sector_${sector}`);
            label.textContent = sector;
            
            checkbox.addEventListener('click', e => e.stopPropagation());
            label.addEventListener('click', e => e.stopPropagation());
            li.addEventListener('click', e => e.stopPropagation());
            
            li.appendChild(checkbox);
            li.appendChild(label);
            sectorList.appendChild(li);

            checkbox.addEventListener('change', () => {
                updateSelectedFilters();
                
            });

        });
    }



    function filterSectors() {
        const input =document.getElementById('sectorSearch').value.toLowerCase();
        const listItems = document.querySelectorAll('#sectorList .dropdown-item');

        Array.from(listItems).forEach(item => {
            const sectorName = item.textContent.toLowerCase();
            if(sectorName.includes(input)){
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // document.getElementById('sectorSearch').addEventListener('keyup',filterSectors);

    // filterSectors();
    // Filter Sectors
    // function filterSectors() {
    //     const input = document.getElementById('sectorSearch').value.toLowerCase();
    //     const items = document.querySelectorAll('#sectorList .dropdown-item');

    //     items.forEach(item => {
    //         item.style.display = item.textContent.toLowerCase().includes(input) ? '' : 'none';
    //     });
    // }

    // Render Locations Dropdown
    function populateLocations() {
        const locationList = document.getElementById('locationList');
        const selectedLocations = new Set([...new FormData(document.getElementById('searchForm')).getAll('location[]')]);
        locationList.innerHTML = '';

        locations.forEach((location, index) => {
            const listItem = document.createElement('li');
            listItem.classList.add('dropdown-item');
            listItem.innerHTML = `
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="location[]" value="${location}" id="location_${index}" ${selectedLocations.has(location) ? 'checked' : ''}>
                    <label class="form-check-label" for="location_${index}">${location}</label>
                </div>
            `;
            locationList.appendChild(listItem);

            // Add event listener to stop propagation
            listItem.querySelector('input').addEventListener('click', e => e.stopPropagation());
            listItem.querySelector('label').addEventListener('click', e => e.stopPropagation());
            listItem.addEventListener('click', e => e.stopPropagation());   
            
        });
        
    }

    // Filter Locations
    function filterLocations() {
        const input = document.getElementById('locationSearch').value.toLowerCase();
        const items = document.querySelectorAll('#locationList .dropdown-item');

        items.forEach(item => {
            item.style.display = item.textContent.toLowerCase().includes(input) ? '' : 'none';
        });
    }

    // Function to reset filters
    function resetFilters() {
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => checkbox.checked = false);

    }


    // Fetch Results
    // function fetchResults() {
    //     const formData = new FormData(document.getElementById('searchForm'));
    //     console.log("Form Data: ");
    //     fetch('{{ route("investee.search") }}', {
    //         method: 'POST',
    //         headers: {
    //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    //         },
    //         body: formData
    //     })
    //     .then(response => response.text())
    //     .then(data => {
    //         console.log(data);
    //         document.getElementById('investorList').innerHTML = data;
    //         // Keep the selected options checked
    //         populateSectors();
    //         populateLocations();
    //         updateBreadcrumb();
    //         updateSelectedFilters();
    //         console.log("Selected Filters: ", selectedFilters);
    //         updateSelectedFilters();
    //         console.log("Selected Filters after update: ", selectedFilters);
    //         updateBreadcrumb();
    //         console.log("Breadcrumb updated with selected filters.");
    //         console.log("Selected Filters after breadcrumb update: ", selectedFilters);
    //         console.log("Selected Filters after fetch: ", selectedFilters);
        
    //     })
    //     .catch(error => console.error('Error:', error));
    // }

    // Attach Events
    document.addEventListener('DOMContentLoaded', function () {
        // populateSectors();
        populateSectors();
        populateLocations();

        document.getElementById('sectorSearch').addEventListener('keyup', filterSectors);
        document.getElementById('locationSearch').addEventListener('keyup', filterLocations);

        // document.querySelectorAll('input[name="sector[]"]').forEach(input => {
        //     input.addEventListener('change', populateSectors);
        // });

        // document.querySelectorAll('input[name="location[]"]').forEach(input => {
        //     input.addEventListener('change', populateLocations);
        // });

        document.getElementById('searchNowButton').addEventListener('click', function () {
            fetchResults();
            updateSelectedFilters();
        });
    });



    // const input = document.getElementById('investmentSizeSearch').value.toLowerCase();


    function filterInvestmentSize(){
    
        const items = document.querySelectorAll('.dropdown-menu .dropdown-item');

        items.forEach(item => {
            const dropdownvalue = item.textContent.toLowerCase();
            if(dropdownvalue.includes(input)){
                item.style.display = '' ;
            }else{
                item.style.display = 'none';
            }
        })
    }


    function filterTenure() {
        const input = document.getElementById('investmentTenureSearch').value.toLowerCase();
        const dropdownMenu = document.querySelector('#investmentTenureDropdown').nextElementSibling; // Get the sibling element (dropdown-menu)
        const items = dropdownMenu.querySelectorAll('.dropdown-item'); // Select all dropdown items inside the menu

        // const items = document.querySelectorAll('.dropdown-menu .dropdown-item');

        items.forEach(item => {
            const dropdownvalues = item.textContent.toLowerCase();
            if(dropdownvalues.includes(input)){
                item.style.display = '';
            }
            else{
                item.style.display = 'none';
            }
        })
    }



    function filterinvestorType(){
        const input = document.getElementById('investorTypeSearch').value.toLowerCase();
        const tenure = document.querySelector('#investorTypeSearch').nextElementSibling;
        const items = tenure.querySelectorAll('.dropdown-item');

        items.forEach(item => {
            const dropdownvalues = item.textContent.toLowerCase();
            if(dropdownvalues.includes(input)){
                item.style.display = '';
            }
            else{
                item.style.display = 'none';
            }
        })
    }

    document.getElementById('investorTypeSearch').addEventListener('keyup',filterinvestorType);

    document.querySelectorAll('.dropdown-menu').forEach(menu => {
        menu.addEventListener('click', function (e) {
            e.stopPropagation(); // Stops the dropdown from closing
        });
    });

    function updateBreadcrumb() {
        const container = document.getElementById('selected-filters-container-investee');
        container.innerHTML= '';
        Object.keys(selectedFilters).forEach(key => {
            if (Array.isArray(selectedFilters[key])){
                selectedFilters[key].forEach(value => addFilterToBreadcrumb(key,value));
            } else {
                addFilterToBreadcrumb(key,selectedFilters[key]);
            }
        });
    }

    function addFilterToBreadcrumb (name , label) {
        if(!label || label.trim() === "") return;

        const container = document.getElementById('selected-filters-container-investee');
        const elementinvestee = document.createElement('span');
        elementinvestee.className = 'badge bg-secondary me-2 mb-2';
        elementinvestee.innerHTML = `${label} <button type="button" class="btn-close btn-close-white ms-1" aria-label="Close"></button>`;
        container.appendChild(elementinvestee);

        
    
    const closeButton = elementinvestee.querySelector('.btn-close');
        if (closeButton) {
            closeButton.addEventListener('click', function() {
                removeFilter(name, label);
            });
        }
        

    }

    function removeFilter(name, label) {
        // Remove the filter from the selectedFilters object
        document.querySelectorAll(`input[name="${name}[]"]`).forEach(el=> {
            if (el.value === label) {
                el.checked = false; // Uncheck the checkbox
            }
        });
        // remove selected sort value of investment size
        if (name === 'sort') {
            document.getElementById('idsortby').value = ''; // Reset the sort dropdown
            // Remove the sort label from breadcrumb
            const container = document.getElementById('selected-filters-container-investee');
            const badges = container.querySelectorAll('.badge');
            badges.forEach(badge => {
                if (badge.textContent.trim().startsWith(label)) {
                    badge.remove();
                }
            });
        }

        // Update the breadcrumb display
        updateSelectedFilters();

        // Re-fetch results after removing the filter
        fetchResults();
    }

    function updateSelectedFilters() {
        selectedFilters = {
            sector: [],
            location: [],
            investment_size: [],
            investment_tenure: [],
            investor_type: [],
            sort: '',
        };
        document.querySelectorAll('input[name="location[]"]:checked').forEach(el => selectedFilters['location'].push(el.value));
        document.querySelectorAll('input[name="sector[]"]:checked').forEach(el => selectedFilters['sector'].push(el.value));
        document.querySelectorAll('input[name="investment_size[]"]:checked').forEach(el => selectedFilters['investment_size'].push(el.value));
        document.querySelectorAll('input[name="investment_tenure[]"]:checked').forEach(el => selectedFilters['investment_tenure'].push(el.value));
        document.querySelectorAll('input[name="investor_type[]"]:checked').forEach(el => selectedFilters['investor_type'].push(el.value));
        selectedFilters['sort'] = document.getElementById('idsortby')?.value || '';
        // updateBreadcrumb();
        // console.log(selectedFilters);

    


    }


</script>

 <!-- jQuery (necessary for various plugins like Owl Carousel, WOW.js, and others) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Owl Carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- WOW.js (for animations) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

    <!-- Waypoints (required for CounterUp) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>

    <!-- CounterUp (correct CDN for version 2.1.0) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery.counterup@2.1.0/jquery.counterup.min.js"></script>
@endsection
