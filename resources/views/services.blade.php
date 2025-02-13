@extends('layouts.app')

@section('content')

<!-- Custom Styles for Services Section -->
<style>
    .service-card {
        text-align: center;
        padding: 15px;
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        cursor: pointer;
    }

    .service-icon {
        font-size: 4.5rem;
        color: #f39c12;
        margin-bottom: 15px;
    }

    .service-card h2 {
        font-size: 1.25rem;
        margin-bottom: 10px;
    }

    .service-card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    .modal-body ul {
        padding-left: 20px;
    }

    .modal-body ul li {
        margin-bottom: 10px;
    }

    .modal-dialog {
        max-width: 1500px;
        margin: auto;
    }

    .service-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .custom-modal-width .modal-dialog {
        max-width: 100%;
        width: 100%;
    }

    @media (max-width: 1200px) {
        .service-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .service-icon {
            font-size: 3.5rem;
        }

        .service-card h2 {
            font-size: 1.1rem;
        }
    }

    @media (max-width: 992px) {
        .service-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .service-icon {
            font-size: 3rem;
        }

        .service-card h2 {
            font-size: 1rem;
        }
    }

    @media (max-width: 768px) {
        .service-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .service-icon {
            font-size: 2.5rem;
        }

        .service-card h2 {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 576px) {
        .service-grid {
            grid-template-columns: 1fr;
        }

        .service-icon {
            font-size: 2rem;
        }

        .service-card h2 {
            font-size: 0.85rem;
        }
    }
</style>

<!-- Navbar End -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Page Header -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="display-3 mb-4 text-center animated slideInDown">Services</h1>
    </div>
</div>

<!-- Services Section -->
<div class="container py-5">
    <div class="row">
        <!-- Service Cards -->
        <div class="col-md-4">
            <div class="service-card" onclick="showPopup('Fund Raising', fundRaisingContent)">
                <i class="fa-solid fa-chart-line service-icon"></i>
                <h2>Fund Raising</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="service-card" onclick="showPopup('Public Offering', publicOfferingContent)">
                <i class="fa-solid fa-building service-icon"></i>
                <h2>Public Offering</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="service-card" onclick="showPopup('Intellectual Property and Legal Services', intellectualPropertyContent)">
                <i class="fa-solid fa-file-alt service-icon"></i>
                <h2>Intellectual Property and Legal Services</h2>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="service-card" onclick="showPopup('Compliance and Regulatory Services', complianceRegulatoryContent)">
                <i class="fa-solid fa-balance-scale service-icon"></i>
                <h2>Compliance and Regulatory Services</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="service-card" onclick="showPopup('Financial and Accounting Services', financialAccountingContent)">
                <i class="fa-solid fa-calculator service-icon"></i>
                <h2>Financial and Accounting Services</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="service-card" onclick="showPopup('Other Services', otherServicesContent)">
                <i class="fa-solid fa-briefcase service-icon"></i>
                <h2>Other Services</h2>
            </div>
        </div>
    </div>
</div>

<!-- Modal Popup -->
<div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
    <div class="container-fluid modal-dialog modal-dialog-centered modal-lg custom-modal-width">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="serviceModalBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to Handle Modal Content -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const fundRaisingContent = `<div class="row">
        <div class="col-md-6">
            <h5><strong>Equity Funding:</strong></h5>
            <p>We facilitate capital raising for our clients by offering equity stakes to investors. This involves conducting thorough due diligence on the company, preparing financial projections, and creating a compelling investment thesis. After completing these steps, we market the investment opportunity to potential investors, negotiate terms, and facilitate the transaction.</p>

            <h5><strong>Debt Funding:</strong></h5>
            <p>We assist clients in securing debt financing, such as loans or bonds. We help clients determine the optimal debt structure, negotiate terms with lenders, and prepare the necessary documentation. We also provide ongoing financial advisory services to ensure compliance with debt covenants.</p>
        </div>
        <div class="col-md-6">
            <h5><strong>Mergers & Acquisitions (M&A):</strong></h5>
            <p>In M&A transactions we advise clients on potential deals, conducting financial analysis, and negotiating terms. We help clients identify suitable acquisition targets or merger partners, prepare valuation models, and manage the due diligence process. We also assist with post-merger integration and restructuring.</p>

            <h5><strong>Pitch Deck Making:</strong></h5>
            <p>We create compelling pitch decks to present investment opportunities to potential investors. These decks highlight the company's business model, market potential, financial performance, and management team. They are designed to capture investors' attention and generate interest in the investment.</p>

            <h5><strong>Pitching to Investors:</strong></h5>
            <p>We represent our clients in pitching to investors. We deliver persuasive presentations that showcase the company's value proposition, address potential risks, and answer investors' questions. We negotiate terms and conditions with investors to secure the best possible deal for our clients.</p>
        </div>
          <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
    </div>`;
    const publicOfferingContent = `<div class="row">
        <div class="col-md-6">
            <h5><strong>IPO Planning:</strong></h5>
            <p>We work closely with companies to prepare for an Initial Public Offering (IPO). We conduct thorough due diligence, help determine the company's valuation, and assist in drafting the IPO prospectus.</p>

            <h5><strong>IPO Listing:</strong></h5>
            <p>We manage the IPO listing process on stock exchanges. We coordinate with regulatory bodies, market makers, and investors to ensure a smooth and successful listing.</p>

            <h5><strong>Issuance of Bonus Shares:</strong></h5>
            <p>We advise companies on the issuance of bonus shares to existing shareholders. We help to determine the appropriate ratio of bonus shares, file necessary paperwork with regulatory authorities, and ensure compliance with listing regulations.</p>
        </div>
        <div class="col-md-6">
            <h5><strong>Issuance of Rights Issue:</strong></h5>
            <p>We assist in the issuance of rights issues when companies need to raise additional capital from existing shareholders (rights issue). We calculate the subscription price, prepare the rights issue circular, and manage the subscription process.</p>

            <h5><strong>Employee Stock Options (ESOP) Planning:</strong></h5>
            <p>We help companies to design and implement Employee Stock Option (ESOP) plans. We advise on the structure of the ESOP plan, valuation of the company's shares, and tax implications for both the company and employees.</p>
        </div>
          <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
    </div>`;
    const intellectualPropertyContent = `<div class="row">
        <div class="col-md-6">
            <h5><strong>Patent:</strong></h5>
            <p>We can assist in identifying patentable inventions and assessing their commercial potential. We also help to negotiate licensing deals and partnerships related to patents.</p>

            <h5><strong>Trademark:</strong></h5>
            <p>We help clients to protect their brand identity by registering trademarks and advising on trademark strategies. We also assist in trademark infringement cases.</p>

            <h5><strong>Design Registration:</strong></h5>
            <p>We help our clients to protect their unique designs through registration and licensing. We can also provide advice on design infringement matters.</p>
        </div>
        <div class="col-md-6">
            <h5><strong>DSC (Digital Signature Certificate):</strong></h5>
            <p>We assist in obtaining DSCs for clients involved in online transactions and e-filing. We also provide guidance on the legal and technical aspects of DSC usage.</p>

            <h5><strong>Online Listing:</strong></h5>
            <p>We help companies prepare for and execute online listings, such as IPOs or secondary offerings. We also provide advice on corporate governance and compliance requirements for online listings.</p>
        </div>
          <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
    </div>`;
    const complianceRegulatoryContent = `<div class="row"><div class="col-md-6">
        <h5><strong>Income Tax Return:</strong></h5>
        <p>We assist our clients with preparing and filing income tax returns for individuals and businesses. We help to identify deductions, optimize tax liabilities, and ensure compliance with tax regulations.</p>

        <h5><strong>GST, TDS, PF, ESI, PT, Customs:</strong></h5>
        <p>We provide expert guidance on Goods & Services Tax (GST) compliance, including registration, filing returns, and managing input tax credits. We also assist with Tax Deducted at Source (TDS) filing, Provident Fund (PF) and Employees' State Insurance (ESI) contributions, Professional Tax (PT) payments, and customs procedures.</p>

        <h5><strong>MCA & ROC Works:</strong></h5>
        <p>We handle MCA and ROC filings, such as annual returns, changes in directors, and company name changes. We ensure compliance with statutory requirements and provide guidance on corporate governance.</p>
    </div>
    <div class="col-md-6">
        <h5><strong>Appointment & Resignation of Directors:</strong></h5>
        <p>We assist with the appointment and resignation of directors, ensuring that the process adheres to legal and regulatory guidelines. We also provide advice on director responsibilities and liabilities.</p>

        <h5><strong>Annual Return:</strong></h5>
        <p>We help to prepare and file annual returns with the Registrar of Companies (ROC). We ensure accuracy and compliance with statutory requirements, including financial statements and director reports.</p>

        <h5><strong>Company Registration:</strong></h5>
        <p>We guide businesses through the company registration process, including selecting the appropriate type of entity, drafting necessary documents, and obtaining government approvals.</p>

        <h5><strong>Udyog Aadhaar & GST Registration:</strong></h5>
        <p>We assist with Udyog Aadhaar and GST registration, helping businesses obtain these essential registrations for conducting business in India.</p>

        <h5><strong>Importer-Exporter Code:</strong></h5>
        <p>We assist businesses in obtaining an Importer-Exporter Code (IEC), a necessary requirement for international trade activities. We guide businesses through the application process and provide advice on customs procedures.</p>
    </div>
      <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
    </div>`;
    const financialAccountingContent = `<div class="row"><div class="col-md-6">
        <h5><strong>Loan Proposal:</strong></h5>
        <p>We help companies prepare loan proposals by conducting financial due diligence, assessing creditworthiness, and negotiating with lenders to secure favorable terms.</p>

        <h5><strong>CMA Data:</strong></h5>
        <p>We assist in preparing and analyzing CMA (Credit Monitoring Analysis) data to evaluate a company's financial performance, identify cost-saving opportunities, and support decision-making.</p>

        <h5><strong>Accounting:</strong></h5>
        <p>We provide accounting advisory services, including financial statement preparation, internal controls assessment, and compliance with accounting standards.</p>

        <h5><strong>Subsidy:</strong></h5>
        <p>We help companies to identify and apply for government subsidies or grants that can reduce project costs and improve financial returns.</p>
    </div>
    <div class="col-md-6">
        <h5><strong>Tax Planning:</strong></h5>
        <p>We offer tax planning strategies to minimize a company's tax burden through legal and efficient tax structuring.</p>

        <h5><strong>Capital Re-Structuring:</strong></h5>
        <p>We advise on optimizing a company's capital structure by analyzing debt-to-equity ratios, interest costs, and refinancing options to achieve a healthy financial balance.</p>

        <h5><strong>Project Report:</strong></h5>
        <p>We prepare comprehensive project reports, including financial projections, risk assessments, and market analysis, to support investment decisions and secure funding.</p>

        <h5><strong>TEV Study:</strong></h5>
        <p>We offer comprehensive Techno Economic Viability (TEV) studies to our clients, encompassing market analysis, financial projections, and risk assessment. These studies provide valuable insights into a project's potential for success, aiding clients in making informed investment decisions and securing necessary funding.</p>
    </div>
      <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
</div>`;
    const otherServicesContent = `<div class="row"><div class="col-md-6">
        <h5><strong>Structured Finance:</strong></h5>
        <p>We help our clients in creating, designing, and distributing complex financial products. We package various assets, such as loans, bonds, or mortgages, into new securities that are backed by the underlying pool of assets. These new securities, often known as structured financial products, can be more attractive to investors due to their diversification and risk-adjusted returns. We provide advisory services, risk assessment, and structuring expertise to clients involved in structured finance transactions.</p>

        <h5><strong>Preparation of Share and Warrants Subscription Agreement (SWSA):</strong></h5>
        <p>An SWSA is a legal document that outlines the terms and conditions for subscribing to shares and warrants in a company. We assist in drafting and reviewing SWSA agreements. We ensure that the agreement complies with relevant laws and regulations, protect the interests of both the issuing company and the investors, and clearly define the rights and obligations of all parties involved. We also provide guidance on pricing the shares and warrants and structuring the subscription process.</p>
    </div>
    <div class="col-md-6">
        <h5><strong>Preparation of Share Holders' Agreement (SHA):</strong></h5>
        <p>An SHA is a contract between the shareholders of a company that governs their relationship and sets out the rules for how the company will be managed and operated. We help to prepare SHAs by negotiating the terms of the agreement on behalf of our clients and ensure that the SHA addresses key issues such as voting rights, transfer restrictions, dispute resolution mechanisms, and buy-back provisions. We also assist in structuring the shareholder relationship to align with the company's overall business strategy.</p>

        <h5><strong>Due Diligence:</strong></h5>
        <p>Due diligence is a process of conducting a thorough investigation and analysis of a company or investment opportunity. We conduct due diligence on behalf of our clients to assess the risks and potential rewards of a transaction. This involves reviewing the company's financial statements, business operations, management team, legal and regulatory compliance, and market conditions. We use our expertise to identify potential issues and provide recommendations to our clients. Due diligence is a critical step in ensuring that investment decisions are made on a sound and informed basis.</p>
    </div>
    <div class="text-center mt-4">
                    <a href="{{ route('service.contact.form') }}" class="btn btn-primary">
                        Contact Us
                    </a>
                </div>
</div>`;

    function showPopup(title, content) {
        document.getElementById('serviceModalLabel').innerText = title;
        document.getElementById('serviceModalBody').innerHTML = content;
        var myModal = new bootstrap.Modal(document.getElementById('serviceModal'), {});
        myModal.show();
    }
</script>

@endsection
