@extends('layouts.app')

@section('content')

<style>
   .scrollable-menu {
    max-height: 250px;  /* Set the max height of the scrollable area */
    overflow-y: auto;   /* Enable vertical scrolling when content exceeds the max height */
    overflow-x: hidden; /* Prevent horizontal scrolling */
    padding-right: 10px; /* Add some padding to avoid scrollbar overlap */
}

.nav-tabs .nav-link {
    margin-bottom: -1px;
    background: #dee2e6;
    border: 1px solid transparent;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    color: black;
}

#searchBox, #locationDropdown, #natureOfBusinessDropdown, #incorporatedDropdown, #fundUsageDropdown, #sectorDropdown, #locationDropdown, #investmentSizeDropdown, #investmentTenureDropdown,#investorTypeDropdown {
    color: #593131;
    background-color: #ffffff;
    font-family: robot;
    font-weight: 400;
    font-size: 18px;
    border: 0px;
}
    
    .container {
            --bs-gutter-x: 0rem;
    padding: 5px;
    }
    
</style>
<div class="container">
   




    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs" id="bankerTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="investee-data-tab" data-bs-toggle="tab" href="#investee-data" role="tab" aria-controls="investee-data" aria-selected="true">Investee List</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="investor-data-tab" data-bs-toggle="tab" href="#investor-data" role="tab" aria-controls="investor-data" aria-selected="false">Investor List</a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="bankerTabsContent">
        <!-- Investee Data Tab -->
        <div class="tab-pane fade show active" id="investee-data" role="tabpanel" aria-labelledby="investee-data-tab">
            
         
           <form id="searchForm" class="form-control p-3 bg-light">
        <div class="row-g-1">
            <div class="col-md-12">
                <div class="search-box p-1 bg-light rounded shadow-sm">
               
                    <input type="text" class="form-control" id="searchBox" name="searchBox" placeholder="Eg. Company Name, Sector, Location">
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <!-- Location Multi-select Dropdown -->
            <div class="col-md-2">
                <div class="filter-box">
                  
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle form-control mt-4" type="button" id="locationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Location
                        </button>
                        <ul style="padding-left: 0px;" id="locationList" class="dropdown-menu scrollable-menu">
                            <div class="px-3 py-2">
                                <input type="text" class="form-control mb-2" id="locationSearch" placeholder="Search location" onkeyup="filterLocations()">
                                <ul style="padding-left: 0px;">
                                    @foreach ($locations as $location)
                                    <li class="dropdown-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="location[]" value="{{ $location->name }}" id="location_{{ $location->name }}">
                                            <label class="form-check-label" for="location_{{ $location->name }}">{{ $location->name }}</label>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Nature of Business Multi-select Dropdown -->
            <div class="col-md-3 mt-4">
                <div class="filter-box">
                   
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle form-control" type="button" id="natureOfBusinessDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Sector
                        </button>
                        <ul id="sectorList" class="dropdown-menu scrollable-menu">
                            <div class="px-3 py-2">
                                <input type="text" class="form-control mb-2" id="sectorSearch" placeholder="Search sector" onkeyup="filterSectors()">
                                <ul>
                                    @foreach ($sectors as $sector)
                                        <li class="dropdown-item">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="nature_of_business[]" value="{{ $sector->sectors_name }}" id="sector_{{ $sector->sectors_name }}">
                                                <label class="form-check-label" for="sector_{{ $sector->sectors_name }}">{{ $sector->sectors_name }}</label>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Incorporated In Multi-select Dropdown -->
            <div class="col-md-3 mt-4">
                <div class="filter-box">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle form-control" type="button" id="incorporatedDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Incorporated Year
                        </button>
                        <ul id="incorporatedList" class="dropdown-menu scrollable-menu">
                            <div class="px-3 py-2">
                                <input type="text" class="form-control mb-2" id="incorporatedSearch" placeholder="Search year">
                                <ul>
                                   <li class="dropdown-item">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2024" id="incorporated_2024">
        <label class="form-check-label" for="incorporated_2024">2024</label>
    </div>
</li>
<li class="dropdown-item">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2023" id="incorporated_2023">
        <label class="form-check-label" for="incorporated_2023">2023</label>
    </div>
</li>
<li class="dropdown-item">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2022" id="incorporated_2022">
        <label class="form-check-label" for="incorporated_2022">2022</label>
    </div>
</li>
<li class="dropdown-item">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2021" id="incorporated_2021">
        <label class="form-check-label" for="incorporated_2021">2021</label>
    </div>
</li>
<li class="dropdown-item">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2020" id="incorporated_2020">
        <label class="form-check-label" for="incorporated_2020">2020</label>
    </div>
</li>

                                    <!-- Add more years similarly -->
                                </ul>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Usage of Fund Multi-select Dropdown -->
            <div class="col-md-2 mt-4">
                <div class="filter-box">
                  
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle form-control" type="button" id="fundUsageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                           Usage of Fund
                        </button>
                        <ul id="fundUsageList" class="dropdown-menu scrollable-menu">
                            <div class="px-3 py-2">
                                <input type="text" class="form-control mb-2" id="fundUsageSearch" placeholder="Search fund usage">
                                <ul style="padding-left: 0px;">
                                    <li class="dropdown-item">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="fund_usage[]" value="Acquisition" id="fund_acquisition">
        <label class="form-check-label" for="fund_acquisition">Acquisition</label>
    </div>
</li>
<li class="dropdown-item">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="fund_usage[]" value="Capex" id="fund_capex">
        <label class="form-check-label" for="fund_capex">Capex</label>
    </div>
</li>
<li class="dropdown-item">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="fund_usage[]" value="Debt Requirement" id="fund_debt">
        <label class="form-check-label" for="fund_debt">Debt Requirement</label>
    </div>
</li>
<li class="dropdown-item">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="fund_usage[]" value="Opex" id="fund_opex">
        <label class="form-check-label" for="fund_opex">Opex</label>
    </div>
</li>
<li class="dropdown-item">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="fund_usage[]" value="Other" id="fund_other">
        <label class="form-check-label" for="fund_other">Other</label>
    </div>
</li>

                                    <!-- Add more fund usage options -->
                                </ul>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-2 mt-4 text-center">
                <button type="button" class="btn btn-success" onclick="fetchResults()">Search Now</button>
            </div>
        </div>

    </form>
    <div style="margin-top: -30px; padding-left: 10px; padding-down: 10px;" class="container">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('investee.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Search Results</li>
        <li class="breadcrumb-item" id="selected-filters-container"></li> <!-- Dynamic filter labels will go here -->
    </ol>
</nav>

<!-- Investee List Section -->
<div class="container">
    <div class="row mt-4" id="filtered-investees">
        <!-- Dynamic Content Fetched from AJAX -->
    </div>
    
    </div>
    
</div>



</div>


          





    <!-- Investor Data Tab -->
<div class="tab-pane fade" id="investor-data" role="tabpanel" aria-labelledby="investor-data-tab">
    
    <!-- Filter Form for Investor -->
    <form class="form-control bg-light p-4" id="searchForm" method="POST" action="{{ route('filter.banker.investees') }}">
        @csrf <!-- Protect the form with CSRF token -->
        <div class="row g-1">
            <!-- Sector Multi-select Dropdown -->
            <div class="col-md-3 mb-3">
              
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle form-control" type="button" id="sectorDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Select Sector
                    </button>
                    
                              <ul id="sectorList" class="dropdown-menu scrollable-menu">
                            <div class="px-3 py-2">
                                <input type="text" class="form-control mb-2" id="sectorSearch" placeholder="Search sector" onkeyup="filterSectors()">
                                <ul>
                                    @foreach ($sectors as $sector)
                                    <li class="dropdown-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="nature_of_business[]" value="{{ $sector->name }}" id="sector_{{ $sector->name }}">
                                            <label class="form-check-label" for="sector_{{ $sector->sectors_name}}">{{ $sector->sectors_name }}</label>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </ul>
                </div>
            </div>

            <!-- Location Multi-select Dropdown -->
            <div class="col-md-3 mb-3">
             
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle form-control" type="button" id="locationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Select Location
                    </button>
                     <ul id="locationList" class="dropdown-menu scrollable-menu">
                            <div class="px-3 py-2">
                                <input type="text" class="form-control mb-2" id="locationSearch" placeholder="Search location" onkeyup="filterLocations()">
                                <ul>
                                    @foreach ($locations as $location)
                                    <li class="dropdown-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="location[]" value="{{ $location->name }}" id="location_{{ $location->name }}">
                                            <label class="form-check-label" for="location_{{ $location->name }}">{{ $location->name }}</label>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </ul>
                </div>
            </div>

            <!-- Investment Size Multi-select Dropdown -->
            <div class="col-md-3 mb-3">
              
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle form-control" type="button" id="investmentSizeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Select Investment Size
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="investmentSizeDropdown">
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
                    </ul>
                </div>
            </div>

            <!-- Investment Tenure Multi-select Dropdown -->
            <div class="col-md-3 mb-3">
              
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle form-control" type="button" id="investmentTenureDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Select Tenure
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="investmentTenureDropdown">
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="investment_tenure[]" value="Less than 1 year" id="tenure_less_1">
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
                    </ul>
                </div>
            </div>

            <!-- Investor Type Multi-select Dropdown -->
            <div class="col-md-3 mb-3">
                
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle form-control" type="button" id="investorTypeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Select Investor Type
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="investorTypeDropdown">
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="investor_type[]" value="Private Equity" id="type_private_equity">
                                <label class="form-check-label" for="type_private_equity">Private Equity</label>
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="investor_type[]" value="Angel Investor" id="type_angel_investor">
                                <label class="form-check-label" for="type_angel_investor">Angel Investor</label>
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="investor_type[]" value="Venture Capitalist" id="type_venture_capitalist">
                                <label class="form-check-label" for="type_venture_capitalist">Venture Capitalist</label>
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="investor_type[]" value="Family Office" id="type_family_office">
                                <label class="form-check-label" for="type_family_office">Family Office</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Sort Field -->
            <div class="col-md-3 mb-3">
             
                <select class="form-control border border-1 border-dark" name="sort">
                    <option style="font-weight: 400;" value="">Sort By</option>
                    <option style="font-weight: 400;" value="A-Z">Investor Name (Ascending)</option>
                    <option style="font-weight: 400;" value="Z-A">Investor Name (Descending)</option>
                    <option style="font-weight: 400;" value="investment_size_asc">Investment Size (Low to High)</option>
                    <option style="font-weight: 400;" value="investment_size_desc">Investment Size (High to Low)</option>
                </select>
            </div>

            <!-- Refresh Button -->
            <div class="col-md-2 mt-1">
                <label></label>
                <button type="button" class="btn btn-success" onclick="fetchInvestorResults()">Search Investors</button>
            </div>
        </div>
    </form>
    
    <div id="filtered-investors">
    @if(isset($investors) && $investors->count() > 0)
        @php
            $isSubscribed = $subscriber && $subscriber->is_subscribed;
            $visibleInvestorCount = $isSubscribed ? $investors->count() : min($investors->count(), 3);
        @endphp

        @foreach($investors->take($visibleInvestorCount) as $investor)
            <div class="col-md-12 mb-4">
                <div class="investor-entry p-3 rounded shadow-sm" style="background-color: #f8f9fa; color: black; border: 1px solid #ccc;">
                    <div class="row">
                        <!-- Profile Image -->
                        <div class="col-md-2 d-flex justify-content-center align-items-center">
                            <img src="{{ asset('uploads/' . ($investor->profile_image ?? 'default_image.png')) }}" class="img-fluid rounded-circle" alt="Investor Logo" style="width: 90px; height: 90px;">
                        </div>

                        <!-- Investor Name and Location -->
                        <div class="col-md-6">
                            <h3 class="nameE {{ !$isSubscribed ? 'blurred-content' : '' }}">
                                {{ $investor->name ?? 'Unknown Investor' }}
                            </h3>
                            <p class="mt-2 {{ !$isSubscribed ? 'blurred-content' : '' }}" style="font-size: 18px;">
                                <i class="bi bi-geo-alt-fill" style="color: #5e6469;"></i> {{ $investor->location }} |
                                <i>Investor since {{ $investor->created_at->format('Y') ?? 'N/A' }}</i>
                            </p>
                        </div>

                        <!-- Personalised Note Button -->
                        <div class="col-md-4 d-flex justify-content-end align-items-center">
                            <button class="btn btn-success">📝 Personalised Note</button>
                        </div>
                    </div>

                    <hr>

                    <!-- Information Section -->
                    <div class="row text-center">
                        <!-- Investment Type -->
                        <div class="col-md-4">
                            <strong><i class="bi bi-briefcase-fill" style="color: #5e6469;"></i> Investment Type:</strong>
                            <p class="{{ !$isSubscribed ? 'blurred-content' : '' }}">{{ $investor->investment_type ?? 'N/A' }}</p>
                        </div>

                        <!-- Investment Size -->
                        <div class="col-md-4">
                            <strong><i class="bi bi-cash-stack" style="color: #5e6469;"></i> Investment Size:</strong>
                            <p class="{{ !$isSubscribed ? 'blurred-content' : '' }}">{{ $investor->investment_size ?? 'N/A' }} Cr</p>
                        </div>

                        <!-- Investment Tenure -->
                        <div class="col-md-4">
                            <strong><i class="bi bi-calendar-fill" style="color: #5e6469;"></i> Investment Tenure:</strong>
                            <p class="{{ !$isSubscribed ? 'blurred-content' : '' }}">{{ $investor->investment_tenure ?? 'N/A' }} Years</p>
                        </div>
                    </div>

                    <hr>

                    <!-- Sectors Preferred -->
                    <div class="row">
                        <div class="col-md-12">
                            <strong>Sector Preferred:</strong>
                            <p class="{{ !$isSubscribed ? 'blurred-content' : '' }}">{{ $investor->sector_preferred ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
</div>

            <!-- Display Investor Data -->

        @endforeach

        <!-- Subscription Prompt for Unsubscribed Users -->
        @if (!$isSubscribed && $investors->count() > 3)
            <div class="col-md-12 text-center">
                <p style="color: black;">Get access to information on all the investors.</p>
                <p style="color: black;">The full list is available only for subscribers. Upgrade to a full subscription and get all the benefits of this unique platform. 🚀</p>
                <a href="{{ route('subscription') }}" class="btn btn-dark text-white">Subscribe Now</a>
            </div>
        @endif
    @else
       
    @endif
</div>
</div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function () {
    let selectedFilters = {}; // Object to store selected filters and their labels

    // Function to fetch results based on form input
    function fetchResults() {
        var formData = new FormData(document.getElementById('searchForm'));

        // Add the searchBox value to the formData
        var searchBoxValue = document.getElementById('searchBox').value;
        formData.append('searchBox', searchBoxValue); // Ensure searchBox value is included

        fetch('{{ route("filter.banker.investees") }}', { // Ensure this route is correct for investee search
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token
            },
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('filtered-investees').innerHTML = data || '<p class="no-results">No results found.</p>';
            updateBreadcrumb(); // Update the breadcrumb after search results
        })
        .catch(error => console.error('Error fetching results:', error));
    }

    // Function to update breadcrumb with selected filters
    function updateBreadcrumb() {
        const container = document.getElementById('selected-filters-container');
        container.innerHTML = ''; // Clear the breadcrumb

        // Add each selected filter to the breadcrumb
        Object.keys(selectedFilters).forEach(key => {
            addFilterToBreadcrumb(key, selectedFilters[key]);
        });

        // Add searchBox value to the breadcrumb if it's not empty
        let searchBoxValue = document.getElementById('searchBox').value;
        if (searchBoxValue) {
            addFilterToBreadcrumb('searchBox', searchBoxValue); // Add searchBox filter
        }
    }

    // Function to add filter to the breadcrumb
    function addFilterToBreadcrumb(name, label) {
        const container = document.getElementById('selected-filters-container');

        // Create a span element for the filter
        const filterElement = document.createElement('span');
        filterElement.className = 'badge bg-secondary me-2';
        filterElement.innerHTML = `${label} <button type="button" class="btn-close btn-close-white ms-1" aria-label="Close"></button>`;

        // Add the filter label to the breadcrumb
        container.appendChild(filterElement);

        // Add an event listener to the cross button to remove the filter
        filterElement.querySelector('.btn-close').addEventListener('click', function () {
            removeFilter(name, label);
        });

        // Store the filter in selectedFilters
        selectedFilters[name] = label;
    }

    // Function to remove a filter from the breadcrumb and uncheck it
    function removeFilter(name, value) {
        // Remove the filter from the selected filters object
        delete selectedFilters[name];

        // If the filter is from the searchBox, clear the searchBox input
        if (name === 'searchBox') {
            document.getElementById('searchBox').value = ''; // Clear the search box
        } else {
            // Uncheck the corresponding checkbox for other filters
            const filterElement = document.querySelector(`input[name="${name}[]"][value="${value}"]`);
            if (filterElement) {
                filterElement.checked = false; // Uncheck the filter
            }
        }

        updateSelectedFilters(); // Update selected filters after removal
        fetchResults(); // Fetch updated results
    }

    // Attach fetchResults function to the "Search Now" button
    document.querySelector('.btn-success').addEventListener('click', function () {
        updateSelectedFilters();  // Update the selected filters
        fetchResults();  // Fetch results
    });

    // Function to update selected filters based on checkboxes
    function updateSelectedFilters() {
        selectedFilters = {}; // Clear previous selected filters

        // Capture selected locations
        document.querySelectorAll('input[name="location[]"]:checked').forEach(el => {
            selectedFilters['location'] = el.value;
        });

        // Capture selected sectors (nature of business)
        document.querySelectorAll('input[name="nature_of_business[]"]:checked').forEach(el => {
            selectedFilters['nature_of_business'] = el.value;
        });

        // Capture selected incorporated years
        document.querySelectorAll('input[name="incorporated_in[]"]:checked').forEach(el => {
            selectedFilters['incorporated_in'] = el.value;
        });

        // Capture selected fund usages
        document.querySelectorAll('input[name="fund_usage[]"]:checked').forEach(el => {
            selectedFilters['fund_usage'] = el.value;
        });

        // Capture searchBox value
        const searchBoxValue = document.getElementById('searchBox').value;
        if (searchBoxValue) {
            selectedFilters['searchBox'] = searchBoxValue; // Add searchBox to selected filters
        }
    }

    // Filter logic for sector search (dropdown)
    document.getElementById('sectorSearch').addEventListener('keyup', function () {
        var searchValue = this.value.toLowerCase();
        document.querySelectorAll('#sectorList .form-check').forEach(function (item) {
            var label = item.querySelector('label').innerText.toLowerCase();
            item.style.display = label.includes(searchValue) ? '' : 'none';
        });
    });

    // Filter logic for location search (dropdown)
    document.getElementById('locationSearch').addEventListener('keyup', function () {
        var searchValue = this.value.toLowerCase();
        document.querySelectorAll('#locationList .form-check').forEach(function (item) {
            var label = item.querySelector('label').innerText.toLowerCase();
            item.style.display = label.includes(searchValue) ? '' : 'none';  // Ensure this updates properly
        });
    });

    // Trigger the initial fetch to load the default results
    fetchResults();
});



// Function to fetch Investor results
function fetchInvestorResults() {
    var location = [];
    $('input[name="location[]"]:checked').each(function() {
        location.push($(this).val());
    });

    var natureOfBusiness = [];
    $('input[name="nature_of_business[]"]:checked').each(function() {
        natureOfBusiness.push($(this).val());
    });

    var investmentSize = [];
    $('input[name="investment_size[]"]:checked').each(function() {
        investmentSize.push($(this).val());
    });

    var investmentTenure = [];
    $('input[name="investment_tenure[]"]:checked').each(function() {
        investmentTenure.push($(this).val());
    });

    var investorType = [];
    $('input[name="investor_type[]"]:checked').each(function() {
        investorType.push($(this).val());
    });

    var sort = $('select[name="sort"]').val();

    $.ajax({
        url: "{{ route('filter.banker.investors') }}",
        method: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            location: location,
            nature_of_business: natureOfBusiness,
            investment_size: investmentSize,
            investment_tenure: investmentTenure,
            investor_type: investorType,
            sort: sort
        },
        success: function(response) {
            $('#filtered-investors').html(response);
        },
        error: function(xhr, status, error) {
            console.log("An error occurred: " + error);
        }
    });
}


function fetchResults() {
    var formData = new FormData(document.getElementById('searchForm'));

    // Add the searchBox value to the formData
    var searchBoxValue = document.getElementById('searchBox').value;
    formData.append('searchBox', searchBoxValue); // Ensure searchBox value is included

    fetch('{{ route("investee.search") }}', { // Change route to investee search route
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token
        },
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('investeeList').innerHTML = data || '<p class="no-results">No results found.</p>';
        updateBreadcrumb(); // Update the breadcrumb after search results
    })
    .catch(error => console.error('Error fetching results:', error));
}

document.getElementById('locationSearch').addEventListener('keyup', function () {
    var searchValue = this.value.toLowerCase();
    document.querySelectorAll('#locationList .form-check').forEach(function (item) {
        var label = item.querySelector('label').innerText.toLowerCase();
        item.style.display = label.includes(searchValue) ? '' : 'none';  // Ensure this updates properly
    });
});

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('input[name="location[]"], input[name="nature_of_business[]"], input[name="incorporated_in[]"], input[name="fund_usage[]"]').forEach(function (el) {
        el.addEventListener('change', function () {
            fetchResults();  // Fetch results when filters are changed
        });
    });
});


$(document).ready(function () {
    // Automatically fetch investee results when any filter changes
    $('input[name="location[]"], input[name="nature_of_business[]"], input[name="incorporated_in[]"], input[name="fund_usage[]"]').on('change', function () {
        fetchInvesteeResults();  // Trigger fetch for investees
    });

    // Automatically fetch investor results when any filter changes
    $('input[name="location[]"], input[name="nature_of_business[]"], input[name="investment_size[]"], input[name="investment_tenure[]"], input[name="investor_type[]"], select[name="sort"]').on('change', function () {
        fetchInvestorResults();  // Trigger fetch for investors
    });
});

// Function to fetch Investee results
function fetchInvesteeResults() {
    var location = [];
    $('input[name="location[]"]:checked').each(function() {
        location.push($(this).val());
    });

    var natureOfBusiness = [];
    $('input[name="nature_of_business[]"]:checked').each(function() {
        natureOfBusiness.push($(this).val());
    });

    var incorporatedIn = [];
    $('input[name="incorporated_in[]"]:checked').each(function() {
        incorporatedIn.push($(this).val());
    });

    var fundUsage = [];
    $('input[name="fund_usage[]"]:checked').each(function() {
        fundUsage.push($(this).val());
    });

    // Call the investee filtering route and update the investee list container
    $.ajax({
        url: "{{ route('filter.banker.investees') }}",  // Ensure this is the correct route for investees
        method: "POST",
        data: {
            _token: "{{ csrf_token() }}", 
            location: location,
            nature_of_business: natureOfBusiness,
            incorporated_in: incorporatedIn,
            fund_usage: fundUsage
        },
        success: function(response) {
            $('#filtered-investees').html(response);  // Ensure this is the correct container for investee results
        },
        error: function(xhr, status, error) {
            console.log("An error occurred: " + error); 
        }
    });
}

// Function to fetch Investor results
function fetchInvestorResults() {
    var location = [];
    $('input[name="location[]"]:checked').each(function() {
        location.push($(this).val());
    });

    var natureOfBusiness = [];
    $('input[name="nature_of_business[]"]:checked').each(function() {
        natureOfBusiness.push($(this).val());
    });

    var investmentSize = [];
    $('input[name="investment_size[]"]:checked').each(function() {
        investmentSize.push($(this).val());
    });

    var investmentTenure = [];
    $('input[name="investment_tenure[]"]:checked').each(function() {
        investmentTenure.push($(this).val());
    });

    var investorType = [];
    $('input[name="investor_type[]"]:checked').each(function() {
        investorType.push($(this).val());
    });

    var sort = $('select[name="sort"]').val();

    $.ajax({
        url: "{{ route('filter.banker.investors') }}",
        method: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            location: location,
            nature_of_business: natureOfBusiness,
            investment_size: investmentSize,
            investment_tenure: investmentTenure,
            investor_type: investorType,
            sort: sort
        },
        success: function(response) {
            $('#filtered-investors').html(response);  // Ensure this is the correct container for investor results
        },
        error: function(xhr, status, error) {
            console.log("An error occurred: " + error);
        }
    });
}

// Function to fetch search results
function fetchResults() {
    var formData = new FormData(document.getElementById('searchForm'));

    // Add the searchBox value to the formData
    var searchBoxValue = document.getElementById('searchBox').value;
    formData.append('searchBox', searchBoxValue); // Ensure searchBox value is included

    fetch('{{ route("investee.search") }}', { // Change route to investee search route
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token
        },
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('investeeList').innerHTML = data || '<p class="no-results">No results found.</p>';
        updateBreadcrumb(); // Update the breadcrumb after search results
    })
    .catch(error => console.error('Error fetching results:', error));
}

document.getElementById('locationSearch').addEventListener('keyup', function () {
    var searchValue = this.value.toLowerCase();
    document.querySelectorAll('#locationList .form-check').forEach(function (item) {
        var label = item.querySelector('label').innerText.toLowerCase();
        item.style.display = label.includes(searchValue) ? '' : 'none';  // Ensure this updates properly
    });
});

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('input[name="location[]"], input[name="nature_of_business[]"], input[name="incorporated_in[]"], input[name="fund_usage[]"]').forEach(function (el) {
        el.addEventListener('change', function () {
            fetchResults();  // Fetch results when filters are changed
        });
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
