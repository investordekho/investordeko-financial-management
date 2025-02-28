<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Page Title -->
    <title>@yield('title', 'InvestorDekho.in  ')</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Main App CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> <!-- Custom CSS -->

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons and Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">

    
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

    <!-- Preconnect for fonts and icons to improve loading performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/app.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <!-- Custom Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    
    








    <!-- Styles for this page -->
    <style>
      /* Custom background color */
      .bg-dark {
          background-color: #011a41 !important;
      }

      /* Body font styling */
      body {
          font-family: 'Montserrat', sans-serif;
      }

      /* Navbar custom styles */
      .navbar-nav .nav-item .nav-link {
          color: #333;
          font-weight: 600;
          font-size: 16px;
      }

      /* Dropdown menu styling */
      .dropdown-menu-columns {
          display: flex;
          flex-wrap: wrap;
      }

      .dropdown-menu-column {
          padding: 10px;
      }

      /* Top bar styling */
      .top-bar {
          background-color: #f8f9fa;
      }

      /* Social media icons */
      .social-icons a {
          font-size: 16px;
          margin-right: 10px;
      }

      /* Profile dropdown styling */
      .profile-dropdown .dropdown-toggle::after {
          display: none;
      }
      
    /* Adjust the dropdown container */
#profileDropdownMenu {
    position: absolute;
    top: 100%;  /* Position it right below the toggle */
    right: 0;  /* Align it to the right */
    left: auto; /* Remove the left alignment */
    min-width: 150px;  /* Set a minimum width */
    max-width: 200px;  /* Set a maximum width */
    background-color: #fff;  /* Background color */
    border: 1px solid #ddd;  /* Light border */
    border-radius: 5px;  /* Rounded corners */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);  /* Light shadow */
    z-index: 1000;  /* Ensure it appears above other content */
}

/* Adjust dropdown links */
#profileDropdownMenu a {
    color: #333;
    padding: 10px 15px;
    display: block;
    white-space: nowrap;  /* Prevent text wrapping */
    text-align: left;  /* Align text to the left */
}

/* Hover effect */
#profileDropdownMenu a:hover {
    background-color: #f8f9fa;
    color: #007bff;
}

/* Profile icon alignment */
#profileDropdown {
    display: flex;
    align-items: center;
    justify-content: center;
}

#profileDropdown i {
    font-size: 1.5rem;  /* Adjust icon size */
    margin-right: 8px;  /* Space between icon and username */
}




    </style>
</head>
<body>
   
</head>

<body>

<!-- Top Header -->
<div class="top-bar bg-light-blue py-2">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-md-6 d-flex align-items-center">
        <!--<span class="me-3">
        <i class="bi bi-geo-alt"></i> Mumbai
        </span> 
        <span class="me-3">
          <i class="bi bi-clock"></i> 9.00 am - 9.00 pm
        </span>-->
      </div>
      <div class="col-md-6 d-flex justify-content-end align-items-center">
       <!-- <span class="me-3">
          <i class="bi bi-envelope"></i> info@example.com
        </span>
        <span class="me-3">
          <i class="bi bi-telephone"></i> +012 345 6789
        </span> -->
        <div class="social-icons">
          <a href="https://www.facebook.com/profile.php?id=61568901415594" class="me-2 text-dark"><i class="bi bi-facebook"></i></a>
          <a href="https://www.youtube.com/@InvestorDekho" class="me-2 text-dark"><i class="bi bi-youtube"></i></a>
          <a href="https://x.com/investordekho" class="me-2 text-dark"><i class="fa-solid fa-x"></i></span></a>
          <a href="https://www.instagram.com/investor_dekho/" class="me-2 text-dark"><i class="bi bi-instagram"></i></a>
          <a href="https://www.linkedin.com/in/investor-dekho-327689338/" class="text-dark"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Main Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <!-- Left Section: Logo -->
        <div class="col-md-1 d-flex align-items-center">
            <a class="navbar-brand" href="{{ route('home') }}">
               <img src="{{ asset('img/Investor-logo.png') }}" alt="Logo" style="height: 90px;">
                
            </a>
        </div>

        <!-- Middle Section: Menu -->
        <div class="col-md-9 d-flex justify-content-end">
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">

                @auth
                    <!-- <li class="nav-item">
                        <span class="nav-link">Role: {{ auth()->user()->roles->pluck('name') }}</span>
                    </li> -->

                    @if(auth()->user()->hasRole('Admin'))
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                        </li>
                    @endif
                @endauth



                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('services') }}" class="nav-link dropdown-toggle" id="servicesDropdown" data-bs-toggle="dropdown" aria-expanded="false">Services</a>
                        <div class="dropdown-menu dropdown-menu-columns border-light m-0">
                            <div class="row">
                                <div class="col-sm-3 dropdown-menu-column">
                                    <h5><a href="{{ route('services') }}"><i class="fa-solid fa-chart-line"></i> Fund Raising</a></h5>
                                    <ul style="list-style: none;">
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#equityFundingModal">Equity Funding</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#debtFundingModal">Debt Funding</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#maModal">Mergers & Acquisitions</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#piModal">Pitchdeck Making</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#piiModal">Pitching to Investors</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-3 dropdown-menu-column">
                                    <h5><a href="{{ route('services') }}"><i class="fas fa-dollar-sign"></i> Public Offering</a></h5>
                                    <ul style="list-style: none;">
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#ipoPlanningModal">IPO Planning</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#ipoListingModal">IPO Listing</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#bonusSharesModal">Bonus Shares</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#rightsIssueModal">Rights Issue</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#esopPlanningModal">ESOP Planning</a></li>

                                    </ul>
                                </div>
                                <div class="col-sm-3 dropdown-menu-column">
                                    <h5><a href="{{ route('services') }}"><i class="fas fa-gavel"></i> Intellectual Property</a></h5>
                                    <ul style="list-style: none;">
                                         <li><a href="#" data-bs-toggle="modal" data-bs-target="#patentModal">Patent</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#trademarkModal">Trademark</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#designRegistrationModal">Design Registration</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#dscModal">DSC</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#onlineListingModal">Online Listing</a></li>
        
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 dropdown-menu-column">
                                    <h5><a href="{{ route('services') }}"><i class="fas fa-tools"></i> Compliance Services</a></h5>
                                    <ul style="list-style: none;">
                                       <li><a href="#" data-bs-toggle="modal" data-bs-target="#incomeTaxModal">Income Tax Return</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#gstCustomsModal">GST, TDS, PF, ESI, PT, Customs</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#mcaRocWorksModal">MCA & ROC Works</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#appointmentResignationModal">Appointment & Resignation of Directors</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#annualReturnModal">Annual Return</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#companyRegistrationModal">Company Registration</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#udyogAadhaarGstModal">Udyog Aadhaar & GST Registration</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#importerExporterCodeModal">Importer-Exporter Code</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-3 dropdown-menu-column">
                                    <h5><a href="{{ route('services') }}"><i class="fa-solid fa-file-alt"></i> Financial Services</a></h5>
                                    <ul style="list-style: none;">
                                         <li><a href="#" data-bs-toggle="modal" data-bs-target="#loanProposalModal">Loan Proposal</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#cmaDataModal">CMA Data</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#accountingModal">Accounting</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#subsidyModal">Subsidy</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#taxPlanningModal">Tax Planning</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#capitalReStructuringModal">Capital Re-Structuring</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#projectReportModal">Project Report</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#tevStudyModal">TEV Study</a></li>
                                       
                                    </ul>
                                </div>
                                <div class="col-sm-3 dropdown-menu-column">
                                    <h5><a href="{{ route('services') }}"><i class="fa-solid fa-file-alt"></i> Other Services</a></h5>
                                    <ul style="list-style: none;">
                                         <li><a href="#" data-bs-toggle="modal" data-bs-target="#structuredFinanceModal">Structured Finance</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#swsAgreementModal">Preparation of SWSA</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#shaAgreementModal">Preparation of Share Holders' Agreement (SHA)</a></li>
                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#dueDiligenceModal">Due Diligence</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item" style="margin-right: 50px;">
                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Right Section: Login/Profile -->
      <!-- Right Section: Login/Profile -->
<div class="col-md-1 d-flex justify-content-end">
    <ul id="profileMenu" class="navbar-nav">
        @guest
            <!-- Show Login Link if not authenticated -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
        @else
            <!-- Show User Dropdown if authenticated -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <!-- Display Profile Image if exists, otherwise show default image -->
                    @if (Auth::user()->profile_image)
                        <img src="{{ asset('storage/profile_image/' . Auth::user()->profile_image) }}" alt="Profile Image" class="rounded-circle" width="40" height="40">
                    @else
                        <img src="{{ asset('img/default_profile.png') }}" alt="Default Profile Image" class="rounded-circle" width="40" height="40">
                    @endif
                    <span class="ms-2">{{ Auth::user()->name }}</span>
                </a>
                <ul id="profileDropdownMenu" class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <!-- Dashboard Link -->
                    <li>
                        <a class="dropdown-item" href="
                            @if(Auth::user()->form_filled == 0)
                                @if(Auth::user()->category_id == 1)
                                    {{ route('form.investee') }}  
                                @elseif(Auth::user()->category_id == 2)
                                    {{ route('form.investor') }}  
                                @elseif(Auth::user()->category_id == 3)
                                    {{ route('form.banker.form') }} 
                                @elseif(Auth::user()->category_id == 4)
                                    {{ route('form.other') }}     
                                @else
                                    {{ route('home') }} <!-- Fallback if no valid category -->
                                @endif
                            @else
                                @if(Auth::user()->category_id == 1)
                                    {{ route('investee.dashboard') }}
                                @elseif(Auth::user()->category_id == 2)
                                    {{ route('investor.dashboard') }}
                                @elseif(Auth::user()->category_id == 3)
                                    {{ route('banker.dashboard') }}
                                @elseif(Auth::user()->category_id == 4)
                                    {{ route('banker.dashboard') }}
                                @else
                                    {{ route('home') }}
                                @endif
                            @endif
                        ">
                            <i class="bi bi-house-door-fill me-2"></i> Dashboard
                        </a>
                    </li>
                    
                    <!-- Profile Settings Link -->
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.settings') }}">
                            <i class="bi bi-gear-fill me-2"></i> Profile Settings
                        </a>
                    </li>
                    
                    <!-- Divider -->
                    <li><hr class="dropdown-divider"></li>
                    
                    <!-- Logout Link -->
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        @endguest
    </ul>
</div>




    </div>
</nav>


<div class="modal fade" id="equityFundingModal" tabindex="-1" aria-labelledby="equityFundingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="equityFundingModalLabel">Equity Funding</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We facilitate capital raising for our clients by offering equity stakes to investors. This involves conducting thorough due diligence on the company, preparing financial projections, and creating a compelling investment thesis. After completing these steps, we market the investment opportunity to potential investors, negotiate terms, and facilitate the transaction.</p>
                
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Debt Funding Modal -->
<div class="modal fade" id="debtFundingModal" tabindex="-1" aria-labelledby="debtFundingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="debtFundingModalLabel">Debt Funding</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We assist clients in securing debt financing, such as loans or bonds. We help clients determine the optimal debt structure, negotiate terms with lenders, and prepare the necessary documentation. We also provide ongoing financial advisory services to ensure compliance with debt covenants.</p>
                
                 <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mergers & Acquisitions Modal -->
<div class="modal fade" id="maModal" tabindex="-1" aria-labelledby="maModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="maModalLabel">Mergers & Acquisitions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>In M&A transactions we advise clients on potential deals, conducting financial analysis, and negotiating terms. We help clients identify suitable acquisition targets or merger partners, prepare valuation models, and manage the due diligence process. We also assist with post-merger integration and restructuring.</p>
                
                 <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pitchdeck Making Modal -->
<div class="modal fade" id="piModal" tabindex="-1" aria-labelledby="maModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="maModalLabel">Pitchdeck Making</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We create compelling pitch decks to present investment opportunities to potential investors. These decks highlight the company's business model, market potential, financial performance, and management team. They are designed to capture investors' attention and generate interest in the investment.</p>
                
                 <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pitching to Investors Modal -->
<div class="modal fade" id="piiModal" tabindex="-1" aria-labelledby="maModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="maModalLabel">Pitching to Investors</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We represent our clients in pitching to investors. We deliver persuasive presentations that showcase the company's value proposition, address potential risks, and answer investors' questions. We negotiate terms and conditions with investors to secure the best possible deal for our clients.</p>
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="ipoPlanningModal" tabindex="-1" aria-labelledby="ipoPlanningModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ipoPlanningModalLabel">IPO Planning</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We work closely with companies to prepare for an Initial Public Offering (IPO). We conduct thorough due diligence, help determine the company's valuation, and assist in drafting the IPO prospectus.</p>
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- IPO Listing Modal -->
<div class="modal fade" id="ipoListingModal" tabindex="-1" aria-labelledby="ipoListingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ipoListingModalLabel">IPO Listing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We manage the IPO listing process on stock exchanges. We coordinate with regulatory bodies, market makers, and investors to ensure a smooth and successful listing.</p>
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bonus Shares Modal -->
<div class="modal fade" id="bonusSharesModal" tabindex="-1" aria-labelledby="bonusSharesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bonusSharesModalLabel">Bonus Shares</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We advise companies on the issuance of bonus shares to existing shareholders. We help to determine the appropriate ratio of bonus shares, file necessary paperwork with regulatory authorities, and ensure compliance with listing regulations.</p>
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Rights Issue Modal -->
<div class="modal fade" id="rightsIssueModal" tabindex="-1" aria-labelledby="rightsIssueModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rightsIssueModalLabel">Rights Issue</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We assist in the issuance of rights issues when companies need to raise additional capital from existing shareholders (rights issue). We calculate the subscription price, prepare the rights issue circular, and manage the subscription process.</p>
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ESOP Planning Modal -->
<div class="modal fade" id="esopPlanningModal" tabindex="-1" aria-labelledby="esopPlanningModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="esopPlanningModalLabel">ESOP Planning</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We help companies to design and implement Employee Stock Option (ESOP) plans. We advise on the structure of the ESOP plan, valuation of the company's shares, and tax implications for both the company and employees.</p>
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="patentModal" tabindex="-1" aria-labelledby="patentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="patentModalLabel">Patent</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We can assist in identifying patentable inventions and assessing their commercial potential. We also help to negotiate licensing deals and partnerships related to patents.</p>
                
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Trademark Modal -->
<div class="modal fade" id="trademarkModal" tabindex="-1" aria-labelledby="trademarkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="trademarkModalLabel">Trademark</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We help clients to protect their brand identity by registering trademarks and advising on trademark strategies. We also assist in trademark infringement cases.</p>
                
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Design Registration Modal -->
<div class="modal fade" id="designRegistrationModal" tabindex="-1" aria-labelledby="designRegistrationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="designRegistrationModalLabel">Design Registration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We help our clients to protect their unique designs through registration and licensing. We can also provide advice on design infringement matters.</p>
                
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DSC Modal -->
<div class="modal fade" id="dscModal" tabindex="-1" aria-labelledby="dscModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dscModalLabel">DSC</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We assist in obtaining DSCs for clients involved in online transactions and e-filing. We also provide guidance on the legal and technical aspects of DSC usage.</p>
                
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Online Listing Modal -->
<div class="modal fade" id="onlineListingModal" tabindex="-1" aria-labelledby="onlineListingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="onlineListingModalLabel">Online Listing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We help companies prepare for and execute online listings, such as IPOs or secondary offerings. We also provide advice on corporate governance and compliance requirements for online listings.</p>
                
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Income Tax Return Modal -->
<div class="modal fade" id="incomeTaxModal" tabindex="-1" aria-labelledby="incomeTaxModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="incomeTaxModalLabel">Income Tax Return</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We assist our clients with preparing and filing income tax returns for individuals and businesses. We help to identify deductions, optimize tax liabilities, and ensure compliance with tax regulations.</p>
                
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- GST, TDS, PF, ESI, PT, Customs Modal -->
<div class="modal fade" id="gstCustomsModal" tabindex="-1" aria-labelledby="gstCustomsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gstCustomsModalLabel">GST, TDS, PF, ESI, PT, Customs</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We provide expert guidance on Goods & Services Tax (GST) compliance, including registration, filing returns, and managing input tax credits. We also assist with Tax Deducted at Source (TDS) filing, Provident Fund (PF) and Employees' State Insurance (ESI) contributions, Professional Tax (PT) payments, and customs procedures.</p>
                
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- MCA & ROC Works Modal -->
<div class="modal fade" id="mcaRocWorksModal" tabindex="-1" aria-labelledby="mcaRocWorksModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mcaRocWorksModalLabel">MCA & ROC Works</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We handle MCA and ROC filings, such as annual returns, changes in directors, and company name changes. We ensure compliance with statutory requirements and provide guidance on corporate governance.</p>
                
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Appointment & Resignation of Directors Modal -->
<div class="modal fade" id="appointmentResignationModal" tabindex="-1" aria-labelledby="appointmentResignationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="appointmentResignationModalLabel">Appointment & Resignation of Directors</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We assist with the appointment and resignation of directors, ensuring that the process adheres to legal and regulatory guidelines. We also provide advice on director responsibilities and liabilities.</p>
                
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Annual Return Modal -->
<div class="modal fade" id="annualReturnModal" tabindex="-1" aria-labelledby="annualReturnModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="annualReturnModalLabel">Annual Return</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We help to prepare and file annual returns with the Registrar of Companies (ROC). We ensure accuracy and compliance with statutory requirements, including financial statements and director reports.</p>
                
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Company Registration Modal -->
<div class="modal fade" id="companyRegistrationModal" tabindex="-1" aria-labelledby="companyRegistrationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="companyRegistrationModalLabel">Company Registration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We guide businesses through the company registration process, including selecting the appropriate type of entity, drafting necessary documents, and obtaining government approvals.</p>
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Udyog Aadhaar & GST Registration Modal -->
<div class="modal fade" id="udyogAadhaarGstModal" tabindex="-1" aria-labelledby="udyogAadhaarGstModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="udyogAadhaarGstModalLabel">Udyog Aadhaar & GST Registration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We assist with Udyog Aadhaar and GST registration, helping businesses obtain these essential registrations for conducting business in India.</p>
                
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Importer-Exporter Code Modal -->
<div class="modal fade" id="importerExporterCodeModal" tabindex="-1" aria-labelledby="importerExporterCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importerExporterCodeModalLabel">Importer-Exporter Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We assist businesses in obtaining an Importer-Exporter Code (IEC), a necessary requirement for international trade activities. We guide businesses through the application process and provide advice on customs procedures.</p>
                
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loan Proposal Modal -->
<div class="modal fade" id="loanProposalModal" tabindex="-1" aria-labelledby="loanProposalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loanProposalModalLabel">Loan Proposal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We help companies prepare loan proposals by conducting financial due diligence, assessing creditworthiness, and negotiating with lenders to secure favorable terms.</p>
                
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CMA Data Modal -->
<div class="modal fade" id="cmaDataModal" tabindex="-1" aria-labelledby="cmaDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cmaDataModalLabel">CMA Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We assist in preparing and analyzing CMA (Credit Monitoring Analysis) data to evaluate a company's financial performance, identify cost-saving opportunities, and support decision-making.</p>
                
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Accounting Modal -->
<div class="modal fade" id="accountingModal" tabindex="-1" aria-labelledby="accountingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="accountingModalLabel">Accounting</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We provide accounting advisory services, including financial statement preparation, internal controls assessment, and compliance with accounting standards.</p>
                
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Subsidy Modal -->
<div class="modal fade" id="subsidyModal" tabindex="-1" aria-labelledby="subsidyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subsidyModalLabel">Subsidy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We help companies to identify and apply for government subsidies or grants that can reduce project costs and improve financial returns.</p>
                
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tax Planning Modal -->
<div class="modal fade" id="taxPlanningModal" tabindex="-1" aria-labelledby="taxPlanningModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taxPlanningModalLabel">Tax Planning</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We offer tax planning strategies to minimize a company's tax burden through legal and efficient tax structuring.</p>
                
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Capital Restructuring Modal -->
<div class="modal fade" id="capitalReStructuringModal" tabindex="-1" aria-labelledby="capitalReStructuringModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="capitalReStructuringModalLabel">Capital Restructuring</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We advise on optimizing a company's capital structure by analyzing debt-to-equity ratios, interest costs, and refinancing options to achieve a healthy financial balance.</p>
                
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Project Report Modal -->
<div class="modal fade" id="projectReportModal" tabindex="-1" aria-labelledby="projectReportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="projectReportModalLabel">Project Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We prepare comprehensive project reports, including financial projections, risk assessments, and market analysis, to support investment decisions and secure funding.</p>
                
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TEV Study Modal -->
<div class="modal fade" id="tevStudyModal" tabindex="-1" aria-labelledby="tevStudyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tevStudyModalLabel">TEV Study</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We offer comprehensive Techno Economic Viability (TEV) studies to our clients, encompassing market analysis, financial projections, and risk assessment. These studies provide valuable insights into a project's potential for success, aiding clients in making informed investment decisions and securing necessary funding.</p>
                
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Structured Finance Modal -->
<div class="modal fade" id="structuredFinanceModal" tabindex="-1" aria-labelledby="structuredFinanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="structuredFinanceModalLabel">Structured Finance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>We help our clients in creating, designing, and distributing complex financial products. We package various assets, such as loans, bonds, or mortgages, into new securities that are backed by the underlying pool of assets. These new securities, often known as structured financial products, can be more attractive to investors due to their diversification and risk-adjusted returns. We provide advisory services, risk assessment, and structuring expertise to clients involved in structured finance transactions.</p>
                
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Structured Finance Modal -->
<div class="modal fade" id="swsAgreementModal" tabindex="-1" aria-labelledby="structuredFinanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="structuredFinanceModalLabel">Preparation of Share and Warrants Subscription Agreement (SWSA)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>An SWSA is a legal document that outlines the terms and conditions for subscribing to shares and warrants in a company. We assist in drafting and reviewing SWSA agreements. We ensure that the agreement complies with relevant laws and regulations, protect the interests of both the issuing company and the investors, and clearly define the rights and obligations of all parties involved. We also provide guidance on pricing the shares and warrants and structuring the subscription process.</p>
                
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="shaAgreementModal" tabindex="-1" aria-labelledby="shaAgreementModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shaAgreementModalLabel">Preparation of Share Holders' Agreement (SHA)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>An SHA is a contract between the shareholders of a company that governs their relationship and sets out the rules for how the company will be managed and operated. We help to prepare SHAs by negotiating the terms of the agreement on behalf of our clients and ensure that the SHA addresses key issues such as voting rights, transfer restrictions, dispute resolution mechanisms, and buy-back provisions. We also assist in structuring the shareholder relationship to align with the company's overall business strategy.</p>
                
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Due Diligence Modal -->
<div class="modal fade" id="dueDiligenceModal" tabindex="-1" aria-labelledby="dueDiligenceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dueDiligenceModalLabel">Due Diligence</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Due diligence is a process of conducting a thorough investigation and analysis of a company or investment opportunity. We conduct due diligence on behalf of our clients to assess the risks and potential rewards of a transaction. This involves reviewing the company's financial statements, business operations, management team, legal and regulatory compliance, and market conditions. We use our expertise to identify potential issues and provide recommendations to our clients. Due diligence is a critical step in ensuring that investment decisions are made on a sound and informed basis</p>
                
                <!-- Contact Us Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


 <script>
        // Set up the CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>
</html>