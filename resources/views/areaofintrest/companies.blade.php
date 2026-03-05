@extends('layouts.app')
@section('content')

<form action="{{ route('companycustomiseddata') }}" method="POST">
    @csrf
<div class="container py-4">
    <div class="card shadow-sm border-0 rounded-3" style="backdrop-filter: blur(12px); background: rgba(255,255,255,0.75);">
        <div class="card-body">
            <h5 class="fw-bold mb-3">🔍 Search Filters</h5>
            
            <div class="row g-3">

                <!-- Location -->
                <div class="col-md-3">
                    <div class="dropdown w-100">
                        <button class="btn btn-light border w-100 d-flex justify-content-between align-items-center" 
                                type="button" id="locationDropdown" data-bs-toggle="dropdown">
                            <span class="text-muted">🌍 Location</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu p-3 shadow-lg border-0 rounded-3" style="width: 260px;" id="locationDropdownMenu">
                            <input type="text" class="form-control mb-2" id="locationSearch" placeholder="Search location..." onkeyup="filterLocations()">
                            <div id="locationList" style="max-height: 200px; overflow-y: auto;">
                              
                                <div id="no-location-found" class="text-muted small px-2 d-none">No locations found</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sector -->
                <div class="col-md-3">
                    <div class="dropdown w-100">
                        <button class="btn btn-light border w-100 d-flex justify-content-between align-items-center" 
                                type="button" id="natureOfBusinessDropdown" data-bs-toggle="dropdown">
                            <span class="text-muted">🏢 Sector</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu p-3 shadow-lg border-0 rounded-3" style="width: 260px;" id="sectorDropdownMenu">
                            <input type="text" class="form-control mb-2" id="sectorSearch" placeholder="Search sector..." onkeyup="filterSectors()">
                            <div id="sectorList" style="max-height: 200px; overflow-y: auto;">
                                
                                <div id="no-sector-found" class="text-muted small px-2 d-none">No sectors found</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Incorporated Year -->
                <div class="col-md-3">
                    <div class="dropdown w-100">
                        <button class="btn btn-light border w-100 d-flex justify-content-between align-items-center" 
                                type="button" id="incorporatedDropdown" data-bs-toggle="dropdown">
                            <span class="text-muted">📅 Incorporated Year</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <ul id="incorporatedList" class="dropdown-menu p-3 shadow-lg border-0 rounded-3 scrollable-menu" style="max-height: 200px; overflow-y:auto;">
                            <li class="dropdown-item">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2024" id="incorporated_2024">
                                    <label class="form-check-label small" for="incorporated_2024">2024</label>
                                </div>
                            </li>
                            <li class="dropdown-item">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2023" id="incorporated_2023">
                                    <label class="form-check-label small" for="incorporated_2023">2023</label>
                                </div>
                            </li>
                            <li class="dropdown-item">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2022" id="incorporated_2022">
                                    <label class="form-check-label small" for="incorporated_2022">2022</label>
                                </div>
                            </li>
                            <li class="dropdown-item">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2021" id="incorporated_2021">
                                    <label class="form-check-label small" for="incorporated_2021">2021</label>
                                </div>
                            </li>
                            <li class="dropdown-item">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2020" id="incorporated_2020">
                                    <label class="form-check-label small" for="incorporated_2020">2020</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Usage of Fund -->
                <div class="col-md-3">
                    <div class="dropdown w-100">
                        <button class="btn btn-light border w-100 d-flex justify-content-between align-items-center" 
                                type="button" id="fundUsageDropdown" data-bs-toggle="dropdown">
                            <span class="text-muted">💰 Usage of Fund</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <ul id="fundUsageList" class="dropdown-menu p-3 shadow-lg border-0 rounded-3 scrollable-menu" style="max-height: 200px; overflow-y:auto;">
                            <li class="dropdown-item">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fund_usage[]" value="Acquisition" id="fund_acquisition">
                                    <label class="form-check-label small" for="fund_acquisition">Acquisition</label>
                                </div>
                            </li>
                            <li class="dropdown-item">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fund_usage[]" value="Capex" id="fund_capex">
                                    <label class="form-check-label small" for="fund_capex">Capex</label>
                                </div>
                            </li>
                            <li class="dropdown-item">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fund_usage[]" value="Debt Requirement" id="fund_debt">
                                    <label class="form-check-label small" for="fund_debt">Debt Requirement</label>
                                </div>
                            </li>
                            <li class="dropdown-item">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fund_usage[]" value="Opex" id="fund_opex">
                                    <label class="form-check-label small" for="fund_opex">Opex</label>
                                </div>
                            </li>
                            <li class="dropdown-item">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fund_usage[]" value="Other" id="fund_other">
                                    <label class="form-check-label small" for="fund_other">Other</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

            <!-- Search Button -->
            <div class="row mt-4">
                <div class="col-md-3 ms-auto">
                    <button type="submit" class="btn btn-success w-100 shadow-sm">
                        🚀 Search Now
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
</form>
<div>
    <!--selected filters will be shown here-->
    <div id="selected-filters-container" class="p-3">
        <!-- Selected filters will appear here as chips -->

    </div>
<div>
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
.chip {
  padding: 6px 10px;
  border-radius: 20px;
  font-size: 14px;
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

    

<script>
document.addEventListener("DOMContentLoaded", function () {
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

    const locationList = document.getElementById("locationList");
    if (locations.length > 0) {
        locations.forEach((loc, index) => {
            const div = document.createElement("div");
            div.className = "form-check mb-1";
            div.innerHTML = `
                <input class="form-check-input" type="checkbox" 
                       name="locations[]" value="${loc}" 
                       id="location_${index}">
                <label class="form-check-label small" for="location_${index}">
                    ${loc}
                </label>
            `;
            locationList.appendChild(div);
        });
        }else{
        document.getElementById("no-location-found").classList.remove("d-none");
        }
});

    function filterLocations() {
        const input = document.getElementById('locationSearch').value.toLowerCase();
        // const listItems = document.querySelectorAll('#locationList .dropdown-item');
        const listItems = document.querySelectorAll('#locationList .form-check');


        Array.from(listItems).forEach(item => {
            const locationName = item.textContent.toLowerCase();
            if(locationName.includes(input)){
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        
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

        const sectorList = document.getElementById('sectorList');
        if(sectors.length > 0){
            sectors.forEach((sector, index) => {
            const li = document.createElement('li');
            li.className = 'dropdown-item';
            li.innerHTML = `
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" 
                           name="sector[]" value="${sector}" 
                           id="sector_${index}">
                    <label class="form-check-label small" for="sector_${index}">
                        ${sector}
                    </label>
                </div>
            `;
                sectorList.appendChild(li);
            });
            }else{
                document.getElementById("no-sector-found").classList.remove("d-none");  
            }
    });


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

</script>
<script>
    //selected filters will be shown here
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

    function fetchResults() {
    // Example: you can do validations or data preparation here
    const form = document.querySelector('form'); // selects your form
    form.submit(); // submits the form
}


</script>
@endsection