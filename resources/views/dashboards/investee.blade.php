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
    <div class="container">
        <h1 style="font-size: 16px; color: grey;" class="mb-1 animated slideInDown">Welcome {{ Auth::user()->name }} </h1>
    </div>
</div>
          <div class="container">
                        <form class="form-control p-3 bg-light" id="searchForm" method="post" action="{{ route('investee.search') }}">
                            @csrf <!-- Protect the form with CSRF token -->
                            <div class="row g-3">
                                <!-- Sector Multi-select Dropdown -->
                                <div class="col-md-3 mb-3">
                                    <label for="sector"></label>
                                <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle form-control" type="button" id="sectorDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Startup Sector
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="sectorDropdown">
                            <div class="px-3 py-2">
                                <input type="text" class="form-control mb-2" id="sectorSearch" placeholder="Search sector" onkeyup="filterSectors()">
                                <div class="scrollable-menu" style="max-height: 200px; overflow-y: auto;">
                                    <ul id="sectorList">
                                        <div id="selected-filters-container" class="mb-3"></div>                      
                                        <!-- Sectors will be populated here by JavaScript -->
                                    </ul>
                                </div>
                            </div>
                        </ul>
                    </div>

                                </div>

                                <!-- Location Multi-select Dropdown -->
                                <div class="col-md-3 mb-3">
                                    <label for="location"></label>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle form-control" type="button" id="locationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            Location
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="locationDropdown">
                                            <div class="px-3 py-2">
                                                <input type="text" class="form-control mb-2" id="locationSearch" placeholder="Search location" onkeyup="filterLocations()">
                                                <div class="scrollable-menu" style="max-height: 200px; overflow-y: auto;">
                                                    <ul id="locationList">
                                                        @if (!empty($locations))
                                                            @foreach ($locations as $location)
                                                                <li class="dropdown-item">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="location[]" value="{{ $location->name }}" id="location_{{ $location->name }}">
                                                                        <label class="form-check-label" for="location_{{ $location->name }}">
                                                                            {{ $location->name }}
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        @else
                                                            <li>No locations available</li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Investment Size Multi-select Dropdown -->
                                <div class="col-md-3 mb-3">
                                    <label for="investment_size"></label>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle form-control" type="button" id="investmentSizeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            Select Investment Size
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="investmentSizeDropdown">
                                            <div class="px-3 py-2">
                                                <!-- <input type="text" class="form-control mb-2" id="investmentSizeSearch" placeholder="Search investment size"> -->
                                                <div class="scrollable-menu" style="max-height: 200px; overflow-y: auto;">
                                                    <li class="dropdown-item">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="investment_size[]" value="Below 10 Lakh" id="investment_size_10">
                                                            <label class="form-check-label" for="investment_size_10">Below 10 Lakh</label>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="investment_size[]" value="10-50 Lakh" id="investment_size_10_50">
                                                            <label class="form-check-label" for="investment_size_10_50">10-50 Lakh</label>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="investment_size[]" value="50 Lakh - 1 Crore" id="investment_size_50_100">
                                                            <label class="form-check-label" for="investment_size_50_100">50 Lakh - 1 Crore</label>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="investment_size[]" value="Above 1 Crore" id="investment_size_100_plus">
                                                            <label class="form-check-label" for="investment_size_100_plus">Above 1 Crore</label>
                                                        </div>
                                                    </li>
                                                </div>
                                            </div>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Investment Tenure Multi-select Dropdown -->
                                <div class="col-md-3 mb-3">
                                    <label for="investment_tenure"></label>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle form-control" type="button" id="investmentTenureDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            Select Tenure
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="investmentTenureDropdown">
                                            <div class="px-3 py-2">
                                                <!-- <input type="text" class="form-control mb-2" id="investmentTenureSearch" placeholder="Search tenure"> -->
                                                <div class="scrollable-menu" style="max-height: 200px; overflow-y: auto;">
                                                    <li class="dropdown-item">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="investment_tenure[]" value="0-1 years" id="tenure_less_1">
                                                            <label class="form-check-label" for="tenure_less_1">Less than 1 year</label>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="investment_tenure[]" value="1-3 years" id="tenure_1_3">
                                                            <label class="form-check-label" for="tenure_1_3">1-3 years</label>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="investment_tenure[]" value="3-5 years" id="tenure_3_5">
                                                            <label class="form-check-label" for="tenure_3_5">3-5 years</label>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="investment_tenure[]" value="More than 5 years" id="tenure_5_plus">
                                                            <label class="form-check-label" for="tenure_5_plus">More than 5 years</label>
                                                        </div>
                                                    </li>
                                                </div>
                                            </div>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Investor Type Multi-select Dropdown -->
                                <div class="col-md-3 mb-3">
                                    <label for="investor_type"></label>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle form-control" type="button" id="investorTypeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            Select Investor Type
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="investorTypeDropdown">
                                            <div class="px-3 py-2">
                                                <input type="text" class="form-control mb-2" id="investorTypeSearch" placeholder="Search investor type">
                                                <div class="scrollable-menu" style="max-height: 200px; overflow-y: auto;">
                                                    <li class="dropdown-item">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="investor_type[]" value="PE" id="type_private_equity">
                                                            <label class="form-check-label" for="type_private_equity">Private Equity</label>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="investor_type[]" value="Angel" id="type_angel_investor">
                                                            <label class="form-check-label" for="type_angel_investor">Angel Investor</label>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="investor_type[]" value="VC" id="type_venture_capitalist">
                                                            <label class="form-check-label" for="type_venture_capitalist">Venture Capitalist</label>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="investor_type[]" value="Family Office" id="type_corporate_investor">
                                                            <label class="form-check-label" for="type_corporate_investor">Corporate Investor</label>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="investor_type[]" value="Seed" id="type_Seed_investor">
                                                            <label class="form-check-label" for="type_Seed_investor">Seed Investor</label>
                                                        </div>
                                                    </li>
                                                </div>
                                            </div>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Sort Field -->
                                <div class="col-md-3 mb-3">
                                    <label style="font-weight: 500;" for="sort"></label>
                                    <select class="form-control" name="sort" id="idsortby">
                                        <option style="font-weight: 400;" value="" class="text-center dropdown">Sort By </option>
                                        <option style="font-weight: 40000;" value="A-Z">Investor Name (Ascending)</option>
                                        <option style="font-weight: 400;" value="Z-A">Investor Name (Descending)</option>
                                        <option style="font-weight: 400;" value="investment_size_asc">Investment Size (Low to High)</option>
                                        <option style="font-weight: 400;" value="investment_size_desc">Investment Size (High to Low)</option>
                                    </select>
                                </div>

                                <!-- Refresh Button -->
                                <div class="col-md-3 mt-3">
                                    <label style="font-weight: 500;" for="sort"></label>
                                    <button type="button" style="background: #198754; color: white;" class="btn btn-success form-control" id="searchNowButton">
                                        Search Now
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Showing 2 out of 10 Startups for 'investor' " need breadcrumb " -->

                        <div style="margin-top: -30px;" class="container">
                        <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('investee.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Investee Dashboard / Search Investors</li>
                        <!-- <li class="breadcrumb-item" id="selected-filters-container"></li> -->
                        </ol>
                    </nav>
                    <nav class="nav">
                        <li class="breadcrumb-item" id="selected-filters-container-list"></li> <!-- Dynamic filter labels will go here -->
                    
                    </nav>


                            <!-- Your search form -->

                            <!-- Display investor results -->
                            <div id="investorList">
                                @include('partials.investor_list', ['investors' => $investors]) 
                            
                                <!--  echo $investors; -->
                            
                                <!-- <pre>{{ print_r($investors, true) }}</pre> -->
                            </div>
                        </div>




        </div>



<script>
// Sector data array
const sectors = [
    'Accounting', 'Airlines/Aviation', 'Alternative Dispute Resolution', 'Alternative Medicine', 'Animation', 'Apparel/Fashion',
    'Architecture/Planning', 'Arts/Crafts', 'Automotive', 'Aviation/Aerospace', 'Banking/Mortgage', 'Biotechnology/Greentech',
    'Broadcast Media', 'Building Materials', 'Business Supplies/Equipment', 'Capital Markets/Hedge Fund/Private Equity',
    'Chemicals', 'Civic/Social Organization', 'Civil Engineering', 'Commercial Real Estate', 'Computer Games', 'Computer Hardware',
    'Computer Networking', 'Computer Software/Engineering', 'Construction', 'Consumer Goods', 'Education Management', 'Financial Services',
    'Food/Beverages', 'Fundraising', 'Government Administration', 'Health/Fitness', 'Hospital/Health Care', 'Human Resources/HR', 
    'Import/Export', 'Information Technology/IT', 'Insurance', 'Legal Services', 'Logistics/Procurement', 'Marketing/Advertising/Sales',
    'Media Production', 'Medical Equipment', 'Medical Practice', 'Mining/Metals', 'Non-Profit/Volunteering', 'Oil/Energy/Solar/Greentech',
    'Public Relations/PR', 'Real Estate/Mortgage', 'Retail Industry', 'Telecommunications', 'Transportation', 'Utilities', 'Warehousing', 'AI and ML',
    'Fin-Tech',
    'Food and Beverage',
    'Agriculture',
    'Healthcare & Life Sciences',
    'Sustainable Sectors',
    'IT',
    'Pharmaceuticals',
    'Mechanical Engineering',
    'Minerals Business',
    'Automotive',
    'Cosmetics',
    'SaaS',
    'Marketplaces',
    'HealthTech',
    'eCommerce',
    'EdTech',
    'Deep Tech',
    'Web3',
    'Extended Reality (XR)',
    'Augmented Reality (AR)',
    'Space',
    'IoT',
    'Analytics',
    'ClimateTech/CleanTech',
    'Hardware',
    'Financial Services',
    'Start-ups',
    'Alternative Investment Funds',
    'Consumer',
    'Enterprise Applications',
    'High Tech',
    'Transportation and Logistics Tech',
    'Environment Tech',
    'Crypto',
    'B2B2C',
    'Mobile Technology',
    'Insurtech',
    'Media and Entertainment',
    'Biotech',
    'Life Sciences',
    'Smart Hardware',
    'B2B Marketplaces',
    'vSaaS',
    'Software',
    'Digital Media',
    'APIs',
    'Blockchain',
    'Platforms',
    'Sustainability',
    'Community and Lifestyle',
    'Content and Publishing',
    'Design',
    'Technology',
    'Real Estate and Construction',
    'Aerospace',
    'Proptech',
    'Consumer Internet',
    'Social Media',
    'Virtual Reality',
    'Digital Health',
    'Chemicals',
    'NBFC',
    'BFSI',
    'Banks',
    'Building Materials',
    'Infra',
    'Capital Goods',
    'Adtech',
    'Apps',
    'Natural Health Products',
    'Retail',
    'Blockchain Startups',
    'Science and Engineering',
    'Energy',
    'Internet',
    'Mobile',
    'Big Data',
    'Cloud Computing',
    'Enterprise Software',
    'Advanced Manufacturing',
    'Autonomous Vehicles',
    'Semiconductor',
    'Personal Finance',
    'Micro Lending',
    'Agritech and Farming',
    'Digital Assets',
    'B2B Software',
    'Deep Tech and Fintech',
    'Gaming',
    'Hospitality Investment',
    'Business Support Services',
    'Data and Analytics',
    'Industrial Goods and Manufacturing',
    'Cyber Security',
    'Web3 + Gaming',
    'Cleantech',
    'Hydrogen',
    'Green Molecules',
    'CCUS',
    'Biosciences (Therapeutics, Diagnostics, Devices)',
    'Creative Economy',
    'Vertical SaaS',
    'Web3-focused Startups',
    'Logistics',
    'Financial Exchanges',
    'Trading Platform',
    'Nonprofits'
];

// Locations array
// const locations = [
//     'Adilabad', 'Agra', 'Ahmedabad', 'Bangalore', 'Chennai', 'Delhi', 'Gurgaon', 'Hyderabad', 'Kolkata', 'Mumbai', 'Noida', 'Pune', 'Surat'
// ];
const locations = [
    'Adilabad', 'Agra', 'Ahmedabad', 'Bangalore', 'Chennai', 'Delhi', 'Gurgaon', 'Hyderabad', 'Kolkata', 'Mumbai', 'Noida', 'Pune', 'Surat',
    'Bhopal', 'Jaipur', 'Lucknow', 'Indore', 'Nagpur', 'Kanpur', 'Varanasi', 'Ludhiana', 'Chandigarh', 'Coimbatore', 'Visakhapatnam', 'Rajkot',
    'Vadodara', 'Madurai', 'Mysuru', 'Bhubaneswar', 'Patna', 'Jammu', 'Kochi', 'Gwalior', 'Ranchi', 'Shimla', 'Dehradun', 'Kozhikode', 'Agartala',
    'Imphal', 'Srinagar', 'Shillong', 'Bokaro', 'Jamshedpur', 'Faridabad', 'Ambala', 'Udaipur', 'Jodhpur', 'Navi Mumbai', 'Dhanbad', 'Kolhapur',
    'Solapur', 'Tiruchirappalli', 'Mangalore', 'Thiruvananthapuram', 'Aligarh', 'Karnal', 'Haldwani', 'Raipur', 'Bilaspur', 'Hosur', 'Belgaum',
    'Chandrapur', 'Siliguri', 'Satna', 'Firozabad', 'Agraharam', 'Nanded', 'Rae Bareli', 'Kochi', 'Warangal', 'Bareilly', 'Guwahati', 'Nashik',
    'Bhubaneshwar', 'Jammu', 'Bikaner', 'Ajmer', 'Bihar Sharif', 'Sangli', 'Patiala', 'Vellore', 'Gurugram', 'Alappuzha', 'Tumkur', 'Karnataka'
];

let filterdata = [];




// function populateSectors() {

//     const sectorList = document.getElementById('sectorList');
//     sectors.forEach(sector => {
//         const li = document.createElement('li');
//         li.classList.add('dropdown-item');

//         const checkbox = document.createElement('input');
//         checkbox.type = 'checkbox';
//         checkbox.name = 'sector[]';
//         checkbox.value = sector;
//         checkbox.id = `sector_${sector}`;

//         checkbox.classList.add('form-check-input');

//         const label = document.createElement('label');
//         label.classList.add('form-check-label');
//         label.setAttribute('for', `sector_${sector}`);
//         label.textContent = sector;
//         li.appendChild(checkbox);
//         li.appendChild(label);

//         sectorList.appendChild(li);
//     });
//     // filterSectors();
// }


function populateSectors() {
    const sectorList = document.getElementById('sectorList');
    const selectedSectors = new Set([...new FormData(document.getElementById('searchForm')).getAll('sector[]')]);

    sectorList.innerHTML = ''; // clear existing

    sectors.forEach(sector => {
        const li = document.createElement('li');
        li.classList.add('dropdown-item');

        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.name = 'sector[]';
        checkbox.value = sector;
        checkbox.id = `sector_${sector}`;
        checkbox.classList.add('form-check-input');
        if (selectedSectors.has(sector)) checkbox.checked = true;

        const label = document.createElement('label');
        label.classList.add('form-check-label');
        label.setAttribute('for', `sector_${sector}`);
        label.textContent = sector;

        li.appendChild(checkbox);
        li.appendChild(label);
        sectorList.appendChild(li);
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
function fetchResults() {
    const formData = new FormData(document.getElementById('searchForm'));
    console.log("Form Data: ");
    fetch('{{ route("investee.search") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        document.getElementById('investorList').innerHTML = data;
        // Keep the selected options checked
        populateSectors();
        populateLocations();
    })
    .catch(error => console.error('Error:', error));
}

// Attach Events
document.addEventListener('DOMContentLoaded', function () {
    // populateSectors();
    populateSectors();
    populateLocations();

    document.getElementById('sectorSearch').addEventListener('keyup', filterSectors);
    document.getElementById('locationSearch').addEventListener('keyup', filterLocations);

    document.querySelectorAll('input[name="sector[]"]').forEach(input => {
        input.addEventListener('change', populateSectors);
    });

    document.querySelectorAll('input[name="location[]"]').forEach(input => {
        input.addEventListener('change', populateLocations);
    });

    document.getElementById('searchNowButton').addEventListener('click', function () {
        fetchResults();
    });
});

function filterInvestmentSize(){
    const input = document.getElementById('investmentSizeSearch').value.toLowerCase();
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

document.getElementById('investmentSizeSearch').addEventListener('keyup', filterInvestmentSize);

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

document.getElementById('investmentTenureSearch').addEventListener('keyup',filterTenure);

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
