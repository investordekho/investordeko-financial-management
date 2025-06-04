<?php $__env->startSection('content'); ?>

<style>
    .tab-container {
        margin: auto;
        background: #fff;
        padding: 20px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        border-radius: 12px;
    }

    .tab-buttons {
        display: flex;
        border-bottom: 2px solid #ddd;
        flex-wrap: wrap;
        gap: 5px;
    }

    .tab-button {
        flex: 1;
        padding: 12px;
        text-align: center;
        cursor: pointer;
        font-size: 16px;
        color: #555;
        border: none;
        background:rgb(187, 193, 194);
        outline: none;
        border-radius: 8px 8px 0 0;
        transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.2s ease;
        font-weight: 500;
    }

    .tab-button:hover {
        background-color: #e0e0e0;
        color: #3b82f6;
    }

    .tab-button.active {
        background-color: #3b82f6;
        color: white;
        font-weight: bold;
        border-bottom: 2px solid #3b82f6;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .tab-content {
        padding: 20px;
        font-size: 16px;
        color: #333;
    }

    .tab-pane {
        display: none;
    }

    .tab-pane.active {
        display: block;
    }

    /* Responsive */
    @media (max-width: 600px) {
        .tab-buttons {
            flex-direction: column;
        }

        .tab-button {
            border-radius: 8px;
        }
    }
</style>



<!-- ------------------------------------------------------investor style ------------------------------------------------ -->
 
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
 <!-- ----------------------------------------------------------investeee style ------------------------------------------------  -->

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

    #searchBox2, #locationDropdown, #natureOfBusinessDropdown, #incorporatedDropdown, #fundUsageDropdown {
        color: #198754;
        background-color: #ffffff;
        font-family: robot;
        font-weight: 400;
        font-size: 18px;
        border: 0px;
    }




</style>


<div class="container">
    <div class="tab-container">
        <div class="tab-buttons">
            <button id="tab1" class="tab-button active" onclick="openTab('investor')">Investor</button>
            <button id="tab2" class="tab-button" onclick="openTab('investee')">Investee</button>
        </div>
        <div class="tab-content">
            <div id="investor" class="tab-pane active">
                <!-- 👇 Paste your entire content of investorview.blade.php here -->
                <!-- <h4>Investor View Content</h4>
                <p>This is where your investor-related content goes.</p>
               -->

<!-- 

----------------------------------------------------------------------------investor--------------------------------------------------------
 -->

                <div class="container-fluid page-header mb-1 wow fadeIn" data-wow-delay="0.1s">
                        <div class="container">
                            <h1 style="font-size: 16px; color: grey;" class="mb-1 animated slideInDown">Welcome <?php echo e(Auth::user()->name); ?> </h1>
                        </div>
                    </div>
                <div class="container">
                                <form class="form-control p-3 bg-light" id="searchForm" method="post" action="<?php echo e(route('investee.search')); ?>">
                                    <?php echo csrf_field(); ?> <!-- Protect the form with CSRF token -->
                                    <div class="row g-3">
                                        <!-- Sector Multi-select Dropdown -->
                                        <div class="col-md-3 mb-3">
                                            <label for="sector"></label>
                                        <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle form-control" type="button" id="sectorDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            Startup Sector
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="sectorDropdown" style="width: 400px; max-height: 300px; overflow-y: auto;">
                                            <div class="px-3 py-2">
                                                <input type="text" class="form-control mb-2" id="sectorSearch" placeholder="Search sector" onkeyup="filterSectors()">
                                                <div class="scrollable-menu" style="max-height: 200px; overflow-y: auto;">
                                                    <ul id="sectorList">
                                                        <div id="selected-filters-container2" class="mb-3"></div>                      
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
                                                                <?php if(!empty($locations)): ?>
                                                                    <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li class="dropdown-item">
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="location[]" value="<?php echo e($location->name); ?>" id="location_<?php echo e($location->name); ?>">
                                                                                <label class="form-check-label" for="location_<?php echo e($location->name); ?>">
                                                                                    <?php echo e($location->name); ?>

                                                                                </label>
                                                                            </div>
                                                                        </li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php else: ?>
                                                                    <li>No locations available</li>
                                                                <?php endif; ?>
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
                                                        <!-- <input type="text" class="form-control mb-2" id="investorTypeSearch" placeholder="Search investor type"> -->
                                                        <div class="scrollable-menu" style="max-height: 200px; overflow-y: auto;">
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="investor_type[]" value="Angel" id="type_angel_investor">
                                                                    <label class="form-check-label" for="type_angel_investor">Angel Investor</label>
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
                                                                    <input class="form-check-input" type="checkbox" name="investor_type[]" value="PE" id="type_private_equity">
                                                                    <label class="form-check-label" for="type_private_equity">Private Equity</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="investor_type[]" value="Seed" id="type_Seed_investor">
                                                                    <label class="form-check-label" for="type_Seed_investor">Seed Investor</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="investor_type[]" value="VC" id="type_venture_capitalist">
                                                                    <label class="form-check-label" for="type_venture_capitalist">Venture Capitalist</label>
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
                            <!-- <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('investee.dashboard')); ?>">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Investee Dashboard / Search Investors</li>
                              
                                </ol>
                            </nav> -->
                            <nav class="nav">
                                <li class="breadcrumb-item" id="selected-filters-container-list"></li> <!-- Dynamic filter labels will go here -->
                            
                            </nav>


                                    <!-- Your search form -->

                                    <!-- Display investor results -->
                                    <div id="investorList">
                                        
                                    </div>
                                </div>




                </div>


            </div>


<!-- 
-------------------------------------------investee----------------------------------------------------------------------------------- -->

            <div id="investee" class="tab-pane">
                            <!-- 👇 Paste your entire content of investeeview.blade.php here -->
                            <!-- <h4>Investee View Content</h4>
                            <p>This is where your investee-related content goes.</p>
                  -->



                <div class="container-fluid page-header mb-1 wow fadeIn" data-wow-delay="0.1s" style="margin-top: -10px;">
                    <div class="container">
                        <h1 style="font-size: 16px; color: grey;" class="display-8 mb-4 animated slideInDown">Welcome <?php echo e(Auth::user()->name); ?> </h1>
                    </div>
                </div>

                    <div class="container p-1" style="margin-top: -20px;">
                        <!-- Filter Options Form -->
                        <form id="searchForm2" class="form-control p-3 bg-light">
                            <div class="row-g-1">
                                <div class="col-md-12">
                                    <div class="search-box p-1 bg-light rounded shadow-sm">
                                
                                        <input type="text" class="form-control" id="searchBox2" name="searchBox" placeholder="Eg. Company Name, Sector, Location">
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
                                            <ul style="padding-left: 0px;" id="locationList2" class="dropdown-menu scrollable-menu">
                                                <div class="px-3 py-2">
                                                    <input type="text" class="form-control mb-2" id="locationSearch2" placeholder="Search location" onkeyup="filterLocations()">
                                                    <ul style="padding-left: 0px;">
                                                        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="dropdown-item">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="location[]" value="<?php echo e($location->name); ?>" id="location2_<?php echo e($location->name); ?>">
                                                                <label class="form-check-label" for="location2_<?php echo e($location->name); ?>"><?php echo e($location->name); ?></label>
                                                            </div>
                                                        </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                               


                                <div class="col-md-3 mt-4">
                                    <div class="filter-box">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle form-control" type="button" id="natureOfBusinessDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                Select Sector
                                            </button>
                                            
                                            <div class="dropdown-menu p-3" aria-labelledby="natureOfBusinessDropdown" style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                <input type="text" class="form-control mb-2" id="sectorSearch2" placeholder="Search sector" onkeyup="filterSectors()">
                                                <ul id="sectorList2" class="list-unstyled m-0">
                                                    <?php $__currentLoopData = $sectors->sortBy(function($sector) { return strtoupper($sector->sectors_name); }); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sector): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="mb-1">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="nature_of_business[]" value="<?php echo e($sector->sectors_name); ?>" id="sector_<?php echo e($sector->id); ?>">
                                                                <label class="form-check-label" for="sector_<?php echo e($sector->id); ?>"><?php echo e($sector->sectors_name); ?></label>
                                                            </div>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
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
                                                    <!-- <input type="text" class="form-control mb-2" id="incorporatedSearch" placeholder="Search year"> -->
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
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2019" id="incorporated_2019">   
                                                                    <label class="form-check-label" for="incorporated_2019">2019</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2018" id="incorporated_2018">
                                                                    <label class="form-check-label" for="incorporated_2018">2018</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2017" id="incorporated_2017">
                                                                    <label class="form-check-label" for="incorporated_2017">2017</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2016" id="incorporated_2016">
                                                                    <label class="form-check-label" for="incorporated_2016">2016</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2015" id="incorporated_2015">
                                                                    <label class="form-check-label" for="incorporated_2015">2015</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2014" id="incorporated_2014">
                                                                    <label class="form-check-label" for="incorporated_2014">2014</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2013" id="incorporated_2013">
                                                                    <label class="form-check-label" for="incorporated_2013">2013</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2012" id="incorporated_2012">
                                                                    <label class="form-check-label" for="incorporated_2012">2012</label>
                                                                </div>  
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2011" id="incorporated_2011">
                                                                    <label class="form-check-label" for="incorporated_2011">2011</label>    
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2010" id="incorporated_2010">
                                                                    <label class="form-check-label" for="incorporated_2010">2010</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2009" id="incorporated_2009">
                                                                    <label class="form-check-label" for="incorporated_2009">2009</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2008" id="incorporated_2008">
                                                                    <label class="form-check-label" for="incorporated_2008">2008</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2007" id="incorporated_2007">
                                                                    <label class="form-check-label" for="incorporated_2007">2007</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2006" id="incorporated_2006">
                                                                    <label class="form-check-label" for="incorporated_2006">2006</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2005" id="incorporated_2005">
                                                                    <label class="form-check-label" for="incorporated_2005">2005</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2004" id="incorporated_2004">
                                                                    <label class="form-check-label" for="incorporated_2004">2004</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2003" id="incorporated_2003">
                                                                    <label class="form-check-label" for="incorporated_2003">2003</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2002" id="incorporated_2002">
                                                                    <label class="form-check-label" for="incorporated_2002">2002</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2001" id="incorporated_2001">
                                                                    <label class="form-check-label" for="incorporated_2001">2001</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="2000" id="incorporated_2000">
                                                                    <label class="form-check-label" for="incorporated_2000">2000</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="1999" id="incorporated_1999">
                                                                    <label class="form-check-label" for="incorporated_1999">1999</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="1998" id="incorporated_1998">
                                                                    <label class="form-check-label" for="incorporated_1998">1998</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="1997" id="incorporated_1997">
                                                                    <label class="form-check-label" for="incorporated_1997">1997</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="1996" id="incorporated_1996">
                                                                    <label class="form-check-label" for="incorporated_1996">1996</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="1995" id="incorporated_1995">
                                                                    <label class="form-check-label" for="incorporated_1995">1995</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="1994" id="incorporated_1994">
                                                                    <label class="form-check-label" for="incorporated_1994">1994</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="1993" id="incorporated_1993">
                                                                    <label class="form-check-label" for="incorporated_1993">1993</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="1992" id="incorporated_1992">
                                                                    <label class="form-check-label" for="incorporated_1992">1992</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="1991" id="incorporated_1991">
                                                                    <label class="form-check-label" for="incorporated_1991">1991</label>
                                                                </div>
                                                            </li>
                                                            <li class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="incorporated_in[]" value="1990" id="incorporated_1990">
                                                                    <label class="form-check-label" for="incorporated_1990">1990</label>
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
                                                    <!-- <input type="text" class="form-control mb-2" id="fundUsageSearch" placeholder="Search fund usage"> -->
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
                                    <!-- <button type="button" class="btn btn-success" onclick="fetchResults()">Search Now</button> -->
                                    <button id="searchBtn2" class="btn btn-success">Search</button>

                                </div>
                            </div>

                        </form>
                        <!-- <div style="margin-top: -30px;" class="container">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo e(route('investee.dashboard')); ?>">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Search Results</li>
                                    <li class="breadcrumb-item" id="selected-filters-container"></li> 
                                </ol>
                            </nav>
                        </div> -->

                        <!-- Investee List Section -->
                        <div class="row mt-4" id="investeeList">
                            <!-- Dynamic Content Fetched from AJAX -->
                        </div>
                    </div>


            </div>

        </div>
    </div>
</div>




<script>
    // const sectors = [ 'hghasdv']
    function openTab(tabId) {
        // Toggle tab button active class
        document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
        event.currentTarget.classList.add('active');

        // Show selected tab content
        document.querySelectorAll('.tab-pane').forEach(tab => tab.classList.remove('active'));
        document.getElementById(tabId).classList.add('active');
    }


</script>


<!-- 

----------------------------------------------investor script---------------------------------------------------- -->


<script>
  
    // Sector data array
    const sectors = [
        'Accounting',
        'Adtech',
        'Advanced Manufacturing',
        'Aerospace',
        'Agriculture',
        'Agritech and Farming',
        'AI and ML',
        'Airlines/Aviation',
        'Alternative Dispute Resolution',
        'Alternative Investment Funds',
        'Alternative Medicine',
        'Analytics',
        'Animation',
        'APIs',
        'Apparel/Fashion',
        'Apps',
        'Architecture/Planning',
        'Arts/Crafts',
        'Augmented Reality (AR)',
        'Automotive',
        'Autonomous Vehicles',
        'Aviation/Aerospace',
        'B2B Marketplaces',
        'B2B Software',
        'B2B2C',
        'Banking/Mortgage',
        'Banks',
        'BFSI',
        'Big Data',
        'Biosciences (Therapeutics, Diagnostics, Devices)',
        'Biotech',
        'Biotechnology/Greentech',
        'Blockchain',
        'Blockchain Startups',
        'Broadcast Media',
        'Building Materials',
        'Business Supplies/Equipment',
        'Business Support Services',
        'Capital Goods',
        'Capital Markets/Hedge Fund/Private Equity',
        'CCUS',
        'Chemicals',
        'Civic/Social Organization',
        'Civil Engineering',
        'Cleantech',
        'ClimateTech/CleanTech',
        'Cloud Computing',
        'Commercial Real Estate',
        'Community and Lifestyle',
        'Computer Games',
        'Computer Hardware',
        'Computer Networking',
        'Computer Software/Engineering',
        'Computer/Network Security',
        'Construction',
        'Consumer',
        'Consumer Electronics',
        'Consumer Goods',
        'Consumer Internet',
        'Consumer Services',
        'Content and Publishing',
        'Cosmetics',
        'Creative Economy',
        'Crypto',
        'Cyber Security',
        'Dairy',
        'Data and Analytics',
        'Deep Tech',
        'Deep Tech and Fintech',
        'Defense/Space',
        'Design',
        'Digital Assets',
        'Digital Health',
        'Digital Media',
        'E-Learning',
        'eCommerce',
        'EdTech',
        'Education Management',
        'Electrical/Electronic Manufacturing',
        'Energy',
        'Enterprise Applications',
        'Enterprise Software',
        'Entertainment/Movie Production',
        'Environment Tech',
        'Environmental Services',
        'Events Services',
        'Executive Office',
        'Extended Reality (XR)',
        'Facilities Services',
        'Farming',
        'Fin-Tech',
        'Financial Exchanges',
        'Financial Services',
        'Fine Art',
        'Fishery',
        'Food and Beverage',
        'Food Production',
        'Food/Beverages',
        'Fundraising',
        'Furniture',
        'Gambling/Casinos',
        'Gaming',
        'Glass/Ceramics/Concrete',
        'Government Administration',
        'Government Relations',
        'Graphic Design/Web Design',
        'Green Molecules',
        'Hardware',
        'Health',
        'Health/Fitness',
        'Healthcare & Life Sciences',
        'HealthTech',
        'High Tech',
        'Higher Education/Academia',
        'Hospitality',
        'Hospitality Investment',
        'Human Resources/HR',
        'Hydrogen',
        'Import/Export',
        'Individual/Family Services',
        'Industrial Automation',
        'Industrial Goods and Manufacturing',
        'Information Services',
        'Information Technology/IT',
        'Infra',
        'Insurance',
        'Insurtech',
        'International Affairs',
        'International Trade/Development',
        'Internet',
        'Investment Banking/Venture',
        'Investment Management/Hedge Fund/Private Equity',
        'IoT',
        'IT',
        'Judiciary',
        'Law Enforcement',
        'Law Practice/Law Firms',
        'Legal Services',
        'Legislative Office',
        'Leisure/Travel',
        'Library',
        'Life Sciences',
        'Logistics',
        'Logistics/Procurement',
        'Luxury Goods/Jewelry',
        'Machinery',
        'Management Consulting',
        'Maritime',
        'Market Research',
        'Marketing/Advertising/Sales',
        'Marketplaces',
        'Mechanical Engineering',
        'Mechanical or Industrial Engineering',
        'Media and Entertainment',
        'Media Production',
        'Medical Equipment',
        'Medical Practice',
        'Mental Health Care',
        'Micro Lending',
        'Military Industry',
        'Minerals Business',
        'Mining/Metals',
        'Mobile',
        'Mobile Technology',
        'Motion Pictures/Film',
        'Museums/Institutions',
        'Music',
        'Nanotechnology',
        'Natural Health Products',
        'NBFC',
        'Newspapers/Journalism',
        'Non-Profit/Volunteering',
        'Nonprofits',
        'Oil/Energy/Solar/Greentech',
        'Online Publishing',
        'Other Industry',
        'Outsourcing/Offshoring',
        'Package/Freight Delivery',
        'Packaging/Containers',
        'Paper/Forest Products',
        'Performing Arts',
        'Personal Finance',
        'Pharmaceuticals',
        'Philanthropy',
        'Photography',
        'Plastics',
        'Platforms',
        'Political Organization',
        'Primary/Secondary Education',
        'Printing',
        'Professional Training',
        'Program Development',
        'Proptech',
        'Public Relations/PR',
        'Public Safety',
        'Publishing Industry',
        'Railroad Manufacture',
        'Ranching',
        'Real Estate and Construction',
        'Real Estate/Mortgage',
        'Recreational Facilities/Services',
        'Religious Institutions',
        'Renewables/Environment',
        'Research Industry',
        'Restaurants',
        'Retail',
        'Retail Industry',
        'SaaS',
        'Science and Engineering',
        'Security/Investigations',
        'Semiconductor',
        'Semiconductors',
        'Shipbuilding',
        'Smart Hardware',
        'Social Media',
        'Software',
        'Space',
        'Sporting Goods',
        'Sports',
        'Staffing/Recruiting',
        'Start-ups',
        'Supermarkets',
        'Sustainability',
        'Sustainable Sectors',
        'Technology',
        'Telecommunications',
        'Textiles',
        'Think Tanks',
        'Tobacco',
        'Trading Platform',
        'Translation/Localization',
        'Transportation',
        'Transportation and Logistics Tech',
        'Utilities',
        'Venture Capital/VC',
        'Vertical SaaS',
        'Veterinary',
        'Virtual Reality',
        'vSaaS',
        'Warehousing',
        'Web3',
        'Web3 + Gaming',
        'Web3-focused Startups',
        'Wholesale',
        'Wine/Spirits',
        'Wireless',
        'Writing/Editing'
    ];

    // Locations array
    // const locations = [
    //     'Adilabad', 'Agra', 'Ahmedabad', 'Bangalore', 'Chennai', 'Delhi', 'Gurgaon', 'Hyderabad', 'Kolkata', 'Mumbai', 'Noida', 'Pune', 'Surat'
    // ];
const locations = [
    'Agartala', 'Agra', 'Agraharam', 'Ahmedabad', 'Ajmer', 'Alappuzha', 'Aligarh', 'Ambala',
    'Amritsar', 'Anantapur', 'Ankleshwar', 'Aurangabad', 'Azamgarh', 'Bagalkot', 'Balasore',
    'Ballari', 'Banda', 'Bardhaman', 'Bareilly', 'Belgaum', 'Bellary', 'Bengaluru', 'Berhampur',
    'Bhagalpur', 'Bhandara', 'Bharuch', 'Bhavnagar', 'Bhilai', 'Bhilwara', 'Bhimavaram', 'Bhiwadi',
    'Bhopal', 'Bhubaneswar', 'Bhuj', 'Bidar', 'Bihar', 'Bihar Sharif', 'Bikaner', 'Bilaspur',
    'Bokaro', 'Bongaigaon', 'Budaun', 'Bulandshahr', 'Chandigarh', 'Chandrapur', 'Chapra',
    'Chhattisgarh', 'Chhindwara', 'Chikmagalur', 'Chittoor', 'Churu', 'Coimbatore', 'Cuddalore',
    'Cuttack', 'Dadra and Nagar Haveli and Daman and Diu', 'Dahod', 'Darbhanga', 'Darjeeling',
    'Dehradun', 'Delhi', 'Dewas', 'Dhanbad', 'Dhar', 'Dharmapuri', 'Dharwad', 'Dibrugarh',
    'Dimapur', 'Dindigul', 'Durg', 'East Godavari', 'Erode', 'Etawah', 'Faizabad', 'Faridabad',
    'Farrukhabad', 'Fatehpur', 'Firozabad', 'Gadag', 'Gandhinagar', 'Gangtok', 'Gaya', 'Ghaziabad',
    'Giridih', 'Goa', 'Godhra', 'Gorakhpur', 'Greater Noida', 'Gujarat', 'Gulbarga', 'Guna',
    'Guntur', 'Gurgaon', 'Gurugram', 'Guwahati', 'Gwalior', 'Haldwani', 'Haldia', 'Haryana',
    'Hassan', 'Hathras', 'Himachal Pradesh', 'Hisar', 'Hosur', 'Hubli', 'Hyderabad', 'Ichalkaranji',
    'Imphal', 'Indore', 'Itanagar', 'Jabalpur', 'Jaipur', 'Jalandhar', 'Jalgaon', 'Jammu',
    'Jammu and Kashmir', 'Jamnagar', 'Jamshedpur', 'Jhansi', 'Jharkhand', 'Jodhpur', 'Junagadh',
    'Kadapa', 'Kakinada', 'Kalaburagi', 'Kalyan', 'Kanchipuram', 'Kannur', 'Kanpur', 'Kanyakumari',
    'Kapurthala', 'Karimnagar', 'Karnal', 'Karnataka', 'Karur', 'Kasaragod', 'Kashipur', 'Kathua',
    'Katihar', 'Kavali', 'Kendrapara', 'Kerala', 'Khammam', 'Kharagpur', 'Kochi', 'Kolar',
    'Kolhapur', 'Kolkata', 'Kollam', 'Korba', 'Kota', 'Kottayam', 'Kozhikode', 'Krishnagiri',
    'Kurnool', 'Kurukshetra', 'Latur', 'Lucknow', 'Ludhiana', 'Madurai', 'Maharashtra', 'Malappuram',
    'Malda', 'Manipur', 'Mathura', 'Mau', 'Meerut', 'Meghalaya', 'Midnapore', 'Mirzapur', 'Mizoram',
    'Mangalore', 'Moradabad', 'Morena', 'Motihari', 'Muzaffarnagar', 'Muzaffarpur', 'Mysore',
    'Mysuru', 'Nagaland', 'Nagapattinam', 'Nagpur', 'Nanded', 'Nashik', 'Navi Mumbai', 'Nellore',
    'Noida', 'North 24 Parganas', 'Odisha', 'Ongole', 'Palakkad', 'Palghar', 'Pali', 'Panaji',
    'Panipat', 'Parbhani', 'Patiala', 'Patna', 'Pimpri-Chinchwad', 'Pondicherry', 'Porbandar',
    'Prayagraj', 'Puducherry', 'Punjab', 'Pune', 'Puri', 'Raebareli', 'Raichur', 'Raipur',
    'Rajasthan', 'Rajkot', 'Ranchi', 'Ratlam', 'Ratnagiri', 'Rewa', 'Rohtak', 'Rourkela', 'Sagar',
    'Saharanpur', 'Salem', 'Sambalpur', 'Sangli', 'Satara', 'Satna', 'Secunderabad', 'Shahjahanpur',
    'Shillong', 'Shimla', 'Shivamogga', 'Siliguri', 'Sikar', 'Silchar', 'Siliguri', 'Sirmaur',
    'Sitapur', 'Solapur', 'Sonipat', 'Srinagar', 'Surat', 'Tamil Nadu', 'Telangana',
    'Thane', 'Thanjavur', 'Thiruvananthapuram', 'Thoothukudi', 'Thrissur', 'Tiruchirappalli',
    'Tirunelveli', 'Tirupati', 'Tiruppur', 'Tripura', 'Tumkur', 'Udaipur', 'Udupi', 'Ujjain',
    'Uttar Pradesh', 'Uttarakhand', 'Vadodara', 'Valsad', 'Varanasi', 'Vasai-Virar', 'Vellore',
    'Vidisha', 'Vijayawada', 'Villupuram', 'Virudhunagar', 'Visakhapatnam', 'Vizianagaram',
    'Warangal', 'Wardha', 'West Bengal', 'Yamunanagar'
];


    let filterdata = [];

   


    // Render Sectors Dropdown
    // function populateSectors() {
    //     const sectorList = document.getElementById('sectorList');
    //     const selectedSectors = new Set([...new FormData(document.getElementById('searchForm')).getAll('sector[]')]);
    //     sectorList.innerHTML = '';

    //     sectors.forEach((sector, index) => {
    //         const listItem = document.createElement('li');
    //         listItem.classList.add('dropdown-item');
    //         listItem.innerHTML = `
    //             <div class="form-check">
    //                 <input class="form-check-input" type="checkbox" name="sector[]" value="${sector}" id="sector_${index}" ${selectedSectors.has(sector) ? 'checked' : ''}>
    //                 <label class="form-check-label" for="sector_${index}">${sector}</label>
    //             </div>
    //         `;
    //         sectorList.appendChild(listItem);
    //     });
    // }

    function populateSectors() {

        const sectorList = document.getElementById('sectorList');
        sectors.forEach(sector => {
            const li = document.createElement('li');
            li.classList.add('dropdown-item');

            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.name = 'sector[]';
            checkbox.value = sector;
            checkbox.id = `sector_${sector}`;

            checkbox.classList.add('form-check-input');

            const label = document.createElement('label');
            label.classList.add('form-check-label');
            label.setAttribute('for', `sector_${sector}`);
            label.textContent = sector;
            li.appendChild(checkbox);
            li.appendChild(label);

            sectorList.appendChild(li);
        });
        filterSectors();
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

    //document.getElementById('sectorSearch').addEventListener('keyup',filterSectors);

    filterSectors();
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
    function fetchResults1() {
        const formData = new FormData(document.getElementById('searchForm'));
        // console.log("Form Data: ");
        fetch('<?php echo e(route("investee.search")); ?>', {
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
       
        populateLocations();
        fetchResults1();
        document.getElementById('sectorSearch').addEventListener('keyup', filterSectors);
        document.getElementById('locationSearch').addEventListener('keyup', filterLocations);

        document.querySelectorAll('input[name="sector[]"]').forEach(input => {
            input.addEventListener('change', populateSectors);
        });

        document.querySelectorAll('input[name="location[]"]').forEach(input => {
            input.addEventListener('change', populateLocations);
        });

        document.getElementById('searchNowButton').addEventListener('click', function () {
            fetchResults1();
        });

        document.querySelectorAll('.dropdown-menu').forEach(dropdown => {
        dropdown.addEventListener('click', function (e) {
            e.stopPropagation();
        });
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
</script>

<!-- 
------------------------------------------investee script-------------------------------------------------------- -->


<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>

<!-- JavaScript for Dropdown Filters and Fetch Results -->
<script>
        document.addEventListener('DOMContentLoaded', function () {

            let selectedFilters = {}; // Object to store selected filters and their labels

            // Function to fetch results based on form input
            function fetchResults() {
                var formData = new FormData(document.getElementById('searchForm2'));
                console.log("Form Data:");
                for (var pair of formData.entries()) {
                    console.log(pair[0] + ': ' + pair[1]);
                }
                // Add the searchBox value to the formData
                var searchBoxValue = document.getElementById('searchBox2').value;
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
                const container = document.getElementById('selected-filters-container2');
                container.innerHTML = ''; // Clear the breadcrumb

                // Add each selected filter to the breadcrumb
                Object.keys(selectedFilters).forEach(key => {
                    if(Array.isArray(selectedFilters[key])){
                        selectedFilters[key].forEach(values => {
                            addFilterToBreadcrumb(key, values);
                        });
                    }
                    else{
                        addFilterToBreadcrumb(key, selectedFilters[key]);
                    }
                });

                // Add searchBox value to the breadcrumb if it's not empty
                let searchBoxValue = document.getElementById('searchBox2').value;
                if (searchBoxValue && searchBoxValue.trim() !== '') {
                    addFilterToBreadcrumb('searchBox', searchBoxValue); // Add searchBox filter
                }
            }

            // Function to add filter to the breadcrumb
            function addFilterToBreadcrumb(name, label) {
                const container = document.getElementById('selected-filters-container2');

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
                    document.getElementById('searchBox2').value = ''; // Clear the search box
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
            document.getElementById('searchBtn2').addEventListener('click', function (event) {
        event.preventDefault(); // Stop form from submitting normally
        console.log("Search button 2 clicked!"); // Debugging log
        updateSelectedFilters();  // Update the selected filters
        fetchResults();  // Fetch results

        document.querySelectorAll('.dropdown-menu').forEach(dropdown => {
        dropdown.addEventListener('click', function (e) {
            e.stopPropagation();
        });
    });
    });




        // Function to update selected filters based on checkboxes
        function updateSelectedFilters() {
            selectedFilters = {}; // Clear previous selected filters

            // Capture selected locations
            selectedFilters['location'] = []; // Initialize as an array
            document.querySelectorAll('input[name="location2[]"]:checked').forEach(el => {
                selectedFilters['location'].push(el.value);
            });

            console.log("Selected Locations:----------------------- ", selectedFilters['location']);
            // Capture selected sectors (nature of business)
            selectedFilters['nature_of_business'] = []; // Initialize as an array
            document.querySelectorAll('input[name="nature_of_business[]"]:checked').forEach(el => {
                selectedFilters['nature_of_business'].push(el.value);
            });

            // Capture selected incorporated years
            selectedFilters['incorporated_in'] = []; // Initialize as an array
            document.querySelectorAll('input[name="incorporated_in[]"]:checked').forEach(el => {
                selectedFilters['incorporated_in'].push(el.value);
            });

            // Capture selected fund usages
            selectedFilters['fund_usage'] = []; // Initialize as an array
            document.querySelectorAll('input[name="fund_usage[]"]:checked').forEach(el => {
                selectedFilters['fund_usage'].push(el.value);
            });

            // Capture searchBox value
            selectedFilters['searchBox'] = ''; // Initialize as an empty string
            const searchBoxValue = document.getElementById('searchBox2').value.trim();
            if (searchBoxValue) {
                selectedFilters['searchBox'] = searchBoxValue; // Add searchBox to selected filters
            } else {
                delete selectedFilters['searchBox']; // Remove searchBox if empty
            }
        }

        // Filter logic for sector search (dropdown)
        // document.getElementById('sectorSearch2').addEventListener('keyup', function () {
        //     var searchValue = this.value.toLowerCase();
        //     document.querySelectorAll('#sectorList2 .form-check').forEach(function (item) {
        //         var label = item.querySelector('label').innerText.toLowerCase();
        //         item.style.display = label.includes(searchValue) ? '' : 'none';
        //     });
        // });
        document.getElementById('sectorSearch2').addEventListener('keyup', function () {
            var searchValue = this.value.toLowerCase();
            document.querySelectorAll('#sectorList2 li').forEach(function (item) { // Fix selector
                var label = item.querySelector('label').innerText.toLowerCase();
                item.style.display = label.includes(searchValue) ? '' : 'none';
            });
        });


        // Filter logic for location search (dropdown)
        // document.getElementById('locationSearch2').addEventListener('keyup', function () {
        //     var searchValue = this.value.toLowerCase();
        //     document.querySelectorAll('#locationList2 .form-check').forEach(function (item) {
        //         var label = item.querySelector('label').innerText.toLowerCase();
        //         item.style.display = label.includes(searchValue) ? '' : 'none';  // Ensure this updates properly
        //     });
        // });

        document.getElementById('locationSearch2').addEventListener('keyup', function () {
            var searchValue = this.value.toLowerCase();
            document.querySelectorAll('#locationList2 li').forEach(function (item) { // Fix selector
                var label = item.querySelector('label').innerText.toLowerCase();
                item.style.display = label.includes(searchValue) ? '' : 'none';
            });
        });

        // Trigger the initial fetch to load the default results
        fetchResults();
    });


</script>

<script>
    $(document).on("click",".tab-button",function(){
        let tabId = $(this).attr("id");

        if(tabId == "investorTab"){
            console.log("Investor Tab Clicked");
            
        }
        else{
            console.log("Investee Tab Clicked");

        }
    })
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/dashboards/banker.blade.php ENDPATH**/ ?>