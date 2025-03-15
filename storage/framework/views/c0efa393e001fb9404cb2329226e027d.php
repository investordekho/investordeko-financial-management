<?php $__env->startSection('content'); ?>

<style>
    /* CSS to make the dropdown scrollable */
.scrollable-menu {
    max-height: 200px; /* Set the maximum height for the dropdown */
    overflow-y: auto; /* Enable vertical scrolling */
    overflow-x: hidden; /* Disable horizontal scrolling */
}

/* Optional: Add styling to the scrollbar */
.scrollable-menu::-webkit-scrollbar {
    width: 6px; /* Width of the scrollbar */
}

.scrollable-menu::-webkit-scrollbar-thumb {
    background-color: #888; /* Color of the scrollbar thumb */
    border-radius: 10px; /* Rounded corners */
}

.scrollable-menu::-webkit-scrollbar-thumb:hover {
    background-color: #555; /* Darker color on hover */
}

.bg-light {
    --bs-bg-opacity: 1;
    background-color: #e8eaed !important;
    border: 0px;
}

#searchBox, #locationDropdown, #natureOfBusinessDropdown, #incorporatedDropdown, #fundUsageDropdown {
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
        <h1 style="font-size: 16px; color: grey;" class="display-8 mb-4 animated slideInDown">Welcome <?php echo e(Auth::user()->name); ?> </h1>
    </div>
</div>

<div class="container p-1">
    <!-- Filter Options Form -->
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
                                    <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="dropdown-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="location[]" value="<?php echo e($location->name); ?>" id="location_<?php echo e($location->name); ?>">
                                            <label class="form-check-label" for="location_<?php echo e($location->name); ?>"><?php echo e($location->name); ?></label>
                                        </div>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                    <?php $__currentLoopData = $sectors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sector): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="dropdown-item">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="nature_of_business[]" value="<?php echo e($sector->sectors_name); ?>" id="sector_<?php echo e($sector->sectors_name); ?>">
                                                <label class="form-check-label" for="sector_<?php echo e($sector->sectors_name); ?>"><?php echo e($sector->sectors_name); ?></label>
                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
    <div style="margin-top: -30px;" class="container">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('investee.dashboard')); ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Search Results</li>
        <li class="breadcrumb-item" id="selected-filters-container"></li> <!-- Dynamic filter labels will go here -->
    </ol>
</nav>
</div>

    <!-- Investee List Section -->
    <div class="row mt-4" id="investeeList">
        <!-- Dynamic Content Fetched from AJAX -->
    </div>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>

<!-- JavaScript for Dropdown Filters and Fetch Results -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    let selectedFilters = {}; // Object to store selected filters and their labels

    // Function to fetch results based on form input
    function fetchResults() {
        var formData = new FormData(document.getElementById('searchForm'));

        // Add the searchBox value to the formData
        var searchBoxValue = document.getElementById('searchBox').value;
        formData.append('searchBox', searchBoxValue); // Ensure searchBox value is included

        fetch('<?php echo e(route("investor.search")); ?>', {
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


</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/dashboards/investordashboard.blade.php ENDPATH**/ ?>