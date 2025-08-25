@extends('layouts.app')

@section('content')
<div style="display:flex; justify-content:center; align-items: left; margin-bottom:10px; padding: 10px; box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15); transaction 0.3s;">
        <div class="sidebar">
        <!-- <h3>Profile</h3> -->
            <ul>
                <li><a href="#company-detail">Company Name</a></li>
                <li><a href="#company-founders">Company Founders</a></li>
                <li><a href="#company-concerned-person">Company Concerned Person</a></li>
                <li><a href="#company-fund-requirements">Company Fund Requirements</a></li>
                <li><a href="#company-previous-rounds">Company Previous Rounds</a></li>
                <li><a href="#company-other-links">Company Other Links</a></li>
                <li><a href="#company-attachments">Company Attachments</a></li>
                <li><a href="#company-referral-sources">Company Referral Sources</a></li>
            </ul>
        </div>

<div style="min-width: 850px; margin-left: 10px; background:rgb(255, 255, 255); border-radius: 12px; padding: 25px; box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15); transition: 0.3s; border: 1px solid #ccc;">








































                <div style="background: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); max-width: 1000px; margin: 30px auto; text-align: left; border-left: 5px solid #007bff;">

                <!-- Title -->
                <h2 id="company-detail" style="margin-bottom: 20px; font-size: 20px; font-weight: 600; color: #333; letter-spacing: 0.5px;" class="section">
                    Company Details
                </h2>

                <!-- Company Name -->
                <div style="background: #f1f1f1; padding: 15px; border-radius: 8px; box-shadow: inset 0px 2px 6px rgba(0, 0, 0, 0.05); margin-bottom: 15px;">
                    <h3 style="color: #007bff; margin: 0; font-size: 24px; font-weight: 700; letter-spacing: 1px;">
                        {{ $investee->company_name }}
                    </h3>
                </div>

                <!-- Nature of Business -->
                @if($investee->nature_of_business)
                    <div style="background: #f8f9fa; padding: 10px 15px; border-radius: 8px; box-shadow: inset 0px 2px 4px rgba(0, 0, 0, 0.05); margin-bottom: 20px;">
                        <p style="font-size: 14px; color: #333; line-height: 1.6; margin-bottom: 0; text-align: justify;">
                            <strong style="color: #007bff; font-weight: bold;">Nature of Business:</strong> 
                            <span style="color: #555;">{{ $investee->nature_of_business }}</span>
                        </p>
                    </div>
                @endif

                <!-- Details Section with Flex Layout -->
                <div style="display: flex; flex-wrap: wrap; justify-content: space-between; background: #f8f9fa; padding: 15px; border-radius: 8px; box-shadow: inset 4px 8px rgba(0, 0, 0, 0.05);">

                    <!-- Left Column -->
                    <div style="width: 48%; padding: 8px;">
                        <p style="font-size: 14px; color: #333; margin-bottom: 8px;">
                            <i class="bi bi-geo-alt-fill" style="color: #007bff; margin-right: 6px;"></i><strong>Address:</strong> 
                            <span style="color: #555;">{{ $investee->address }}</span>
                        </p>
                        <p style="font-size: 14px; color: #333; margin-bottom: 8px;">
                            <i class="bi bi-calendar-check-fill" style="color: #007bff; margin-right: 6px;"></i><strong>Incorporated In:</strong> 
                            <span style="color: #555;">{{ $investee->incorporated_in }}</span>
                        </p>
                    </div>

                    <!-- Right Column -->
                    <div style="width: 48%; padding: 8px;">
                        <!-- <p style="font-size: 14px; color: #333; margin-bottom: 8px;">
                            <i class="bi bi-person-fill" style="color: #007bff; margin-right: 6px;"></i><strong>Investee:</strong> 
                            <span style="color: #555;">{{ $investee->user->name ?? 'N/A' }}</span>
                        </p> -->
                        <p style="font-size: 14px; color: #333; margin-bottom: 8px;">
                            <i class="bi bi-envelope-fill" style="color: #007bff; margin-right: 6px;"></i><strong>Email:</strong> 
                            <span style="color: #555;">{{ $investee->user->email ?? 'N/A' }}</span>
                        </p>
                        <p style="font-size: 14px; color: #333; margin-bottom: 8px;">
                            <i class="bi bi-telephone-fill" style="color: #007bff; margin-right: 6px;"></i><strong>Phone:</strong> 
                            <span style="color: #555;">{{ $investee->user->phone ?? 'N/A' }}</span>
                        </p>
                    </div>
                </div>
                </div>




























        <div style="background: linear-gradient(135deg, #f8f9fb, #ffffff); padding: 20px; border-radius: 10px; box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.08); border: 1px solid #ddd; width: 100%; max-width: 100%; font-family: Arial, sans-serif; box-sizing: border-box; margin-bottom: 20px;">
            <h4 id="company-founders" style="font-size: 18px; color: #333; font-weight: bold; margin-bottom: 15px; border-bottom: 2px solid #007bff; padding-bottom: 8px;" class="section">
                🚀 Founders Information
            </h4>

            <div style="display: flex; flex-direction: column; gap: 10px;">
                @foreach($investee->founders as $founder)
                    <div style="display: flex; align-items: center; gap: 15px; background: #ffffff; padding: 12px; border-radius: 6px; border: 1px solid #e1e5eb; transition: all 0.3s ease-in-out;">
                        
                        <!-- Icon -->
                        <div style="font-size: 22px; color: #007bff; flex-shrink: 0;">👤</div>

                        <!-- Founder Details in Form-Style Layout -->
                        <div style="display: flex; flex-wrap: wrap; gap: 20px; width: 100%;">
                            
                            <!-- Name -->
                            <div style="flex: 1; min-width: 200px;">
                                <label style="font-size: 13px; color: #666; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Name</label>
                                <div style="font-size: 15px; color: #333; font-weight: bold;">{{ $founder->name }}</div>
                            </div>

                            <!-- Position -->
                            <div style="flex: 1; min-width: 200px;">
                                <label style="font-size: 13px; color: #666; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Position</label>
                                <div style="font-size: 15px; color: #444;">{{ $founder->position }}</div>
                            </div>

                            <!-- Education -->
                            <div style="flex: 1; min-width: 200px;">
                                <label style="font-size: 13px; color: #666; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Education</label>
                                <div style="font-size: 14px; color: #777;">{{ $founder->education }}</div>
                            </div>

                            <!-- Experience -->
                            <div style="flex: 1; min-width: 200px;">
                                <label style="font-size: 13px; color: #666; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Experience</label>
                                <div style="font-size: 14px; color: #777;">{{ $founder->experience }} years</div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>











































                <!-- Concerned Person Section -->
                <div style="background: #ffffff; padding: 20px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); border: 1px solid #e3e7ec; width: 100%; max-width: 100%; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; box-sizing: border-box;">
                    <h4 id="company-concerned-person" style="display: flex; align-items: center; font-size: 20px; color: #2d3e50; font-weight: bold; margin-bottom: 18px; border-bottom: 3px solid #007bff; padding-bottom: 8px;" class="section">
                        <span style="font-size: 22px; margin-right: 8px;">🔎</span> Concerned Person
                    </h4>

                    @if($investee->concernedPerson)
                        <div style="display: flex; flex-direction: row; background: #f8faff; padding: 16px; border-radius: 8px; border: 1px solid #e1e5eb; gap: 15px; align-items: center;">
                            <!-- Profile Icon -->
                            <div style="font-size: 36px; color: #007bff; display: flex; align-items: center; justify-content: center; background: #e8f0ff; width: 70px; height: 70px; border-radius: 50%; box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);">
                                👤
                            </div>

                            <!-- Details Section -->
                            <div style="flex: 1; display: flex; flex-wrap: wrap; gap: 20px; justify-content: space-between;">
                                <div style="flex: 1;">
                                    <p style="font-size: 14px; font-weight: 600; color: #007bff; margin-bottom: 6px;">Name</p>
                                    <p style="font-size: 16px; color: #333; font-weight: bold;">{{ $investee->concernedPerson->name }}</p>
                                </div>

                                <div style="flex: 1;">
                                    <p style="font-size: 14px; font-weight: 600; color: #007bff; margin-bottom: 6px;">Designation</p>
                                    <p style="font-size: 14px; color: #555;">{{ $investee->concernedPerson->designation }}</p>
                                </div>

                                <div style="flex: 1;">
                                    <p style="font-size: 14px; font-weight: 600; color: #007bff; margin-bottom: 6px;">Email</p>
                                    <p style="font-size: 14px; color: #555; display: flex; align-items: center;">
                                        <span style="font-size: 16px; margin-right: 6px;">📧</span>
                                        <a href="mailto:{{ $investee->concernedPerson->email }}" style="color: #007bff; text-decoration: none;">{{ $investee->concernedPerson->email }}</a>
                                    </p>
                                </div>

                                <div style="flex: 1;">
                                    <p style="font-size: 14px; font-weight: 600; color: #007bff; margin-bottom: 6px;">Phone</p>
                                    <p style="font-size: 14px; color: #555; display: flex; align-items: center;">
                                        <!-- <span style="font-size: 16px; margin-right: 6px;">📞</span> -->
                                        <i class="fa fa-phone" style="font-size: 16px; margin-right: 6px; color: #007bff;"></i>
                                        <a href="tel:{{ $investee->concernedPerson->phone }}" style="color: #007bff; text-decoration: none;">{{ $investee->concernedPerson->phone }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <p style="color: #777; text-align: center; font-size: 14px; padding: 14px; background: #f1f3f7; border-radius: 6px; border: 1px solid #e1e5eb;">No concerned person found.</p>
                    @endif
                </div>



































































                <!-- <hr style="margin: 30px 0; border: none; height: 1px; background: linear-gradient(to right, rgb(229, 255, 0), rgb(212, 78, 0));"> -->

<!-- Card Container -->
<div style="background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0px 10px 60px rgba(0, 0, 0, 0.2); max-width: 1000px; margin: 30px auto;">
  <!-- Title -->
    <h4 id="company-fund-requirements" style="text-align: left; font-size: 22px; color: #333; font-weight: 600; border-bottom: 2px solid #007bff; padding-bottom: 8px; margin-bottom: 18px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;" class="section">
        <i class="fa fa-wallet" style="margin-right: 8px; color: #007bff; font-size: 24px;"></i>Fund Requirements
    </h4>

    <!-- Card Content -->
    <ul style="list-style: none; padding: 0; margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        @foreach($investee->fundRequirements as $fund)
            <li style="background: #ffffff; border: 1px solid #e0e0e0; padding: 12px 20px; margin-bottom: 15px; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1); transition: all 0.3s ease-in-out;">

                <!-- Left Section: Fund Details (Usage & Amount) -->
                <div style="flex: 1; display: flex; justify-content: space-between; align-items: center; margin-right: 10px; font-size: 14px; color: #333;">
                    <div style="display: flex; flex-direction: row; align-items: center; margin-right: 15px; width: 48%;">
                        <div style="font-weight: 600; color: #007bff; margin-right: 8px;">Usage:</div>
                        <p style="color: #555; margin: 0;">{{ $fund->usage }}</p>
                    </div>

                    <div style="display: flex; flex-direction: row; align-items: center; width: 48%;">
                        <div style="font-weight: 600; color: #007bff; margin-right: 8px;">Amount:</div>
                        <p style="color: #555; margin: 0;">{{ number_format($fund->amount, 2) }} {{ $fund->unit }}</p>
                    </div>
                </div>

                <!-- Right Section: Usage Tag -->
                <div style="flex-shrink: 0; font-size: 13px; color: #fff; background-color: #007bff; padding: 8px 14px; border-radius: 6px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                    {{ strtoupper($fund->usage) }}
                </div>
            </li>
        @endforeach
    </ul>

</div>































                    <!-- <hr style="margin: 30px 0; border: none; height: 2px; background: linear-gradient(to right, #007bff, #00bcd4);"> -->

                    <!-- <hr style="margin: 30px 0; border: none; height: 1px; background: linear-gradient(to right, rgb(229, 255, 0), rgb(212, 78, 0));"> -->

<!-- Card Container for Previous Investment Rounds -->
<div style="background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0px 20px 100px rgba(0, 0, 0, 0.2); max-width: 1000px; margin: 30px auto;">

    <!-- Title Section -->
    <h4 id="company-previous-rounds" style="text-align: left; font-size: 24px; color: #2c3e50; font-weight: bold; border-bottom: 2px solid #007bff; padding-bottom: 10px; margin-bottom: 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;" class="section">
    <i class="fa fa-piggy-bank" style="margin-right: 8px; color: #007bff;"></i> Previous Investment Rounds
</h4>


    <!-- List of Previous Investment Rounds -->
    <ul style="list-style: none; padding: 0; margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        @foreach($investee->previousRounds as $round)
            <li style="background: #ffffff; border: 1px solid #e1e5eb; padding: 15px 20px; margin-bottom: 12px; border-radius: 10px; display: flex; flex-wrap: wrap; gap: 15px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); transition: all 0.3s ease;">

                <!-- Round Info -->
                <div style="flex: 1; min-width: 200px; display: flex; flex-direction: column;">
                    <p style="font-weight: 600; color: #007bff; margin: 5px 0;">Round:</p>
                    <p style="margin: 0; color: #555;">{{ $round->round }}</p>
                </div>

                <!-- Investors Info -->
                <div style="flex: 1; min-width: 200px; display: flex; flex-direction: column;">
                    <p style="font-weight: 600; color: #007bff; margin: 5px 0;">Investors:</p>
                    <p style="margin: 0; color: #555;">{{ $round->investors }}</p>
                </div>

                <!-- Amount Raised Info -->
                <div style="flex: 1; min-width: 200px; display: flex; flex-direction: column;">
                    <p style="font-weight: 600; color: #007bff; margin: 5px 0;">Amount Raised:</p>
                    <p style="margin: 0; color: #555;">{{ number_format($round->amount_raised, 2) }} crores</p>
                </div>

                <!-- Valuation Info -->
                <div style="flex: 1; min-width: 200px; display: flex; flex-direction: column;">
                    <p style="font-weight: 600; color: #007bff; margin: 5px 0;">Valuation:</p>
                    <p style="margin: 0; color: #555;">{{ number_format($round->valuation, 2) }} crores</p>
                </div>

            </li>
        @endforeach
    </ul>

</div>






























































<h4 id="company-other-links" style="text-align: center; font-size: 22px; font-weight: 600; color: #333; border-bottom: 2px solid #007bff; padding-bottom: 10px; margin-bottom: 20px;" class="section"> 
    🔗 Other Links
</h4>

<ul style="list-style: none; padding: 0; margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    @foreach($investee->otherLinks as $link)
        <li style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px; padding: 12px; background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease;">
            <!-- Link Title and Icon -->
           <div style="
    flex: 1; 
    display: flex; 
    flex-direction: column; 
    justify-content: center; 
    background: #fff; 
    padding: 20px; 
    border-radius: 10px; 
    box-shadow: 0 10px 50px rgba(0, 0, 0, 0.15);
">

                <p style="color: #007bff; font-weight: 600; margin-bottom: 5px; font-size: 16px;">
                    <!-- Dynamic Icon based on Link Description -->
                    @if(stripos($link->link_description, 'facebook') !== false)
                        <img src="https://img.icons8.com/ios/50/000000/facebook.png" alt="Facebook Icon" style="width: 20px; height: 20px; margin-right: 8px; vertical-align: middle;" />
                    @elseif(stripos($link->link_description, 'twitter') !== false)
                        <img src="https://img.icons8.com/ios/50/000000/twitter.png" alt="Twitter Icon" style="width: 20px; height: 20px; margin-right: 8px; vertical-align: middle;" />
                    @else
                        <img src="https://img.icons8.com/ios/50/000000/domain.png" alt="Company Icon" style="width: 20px; height: 20px; margin-right: 8px; vertical-align: middle;" />
                    @endif
                    {{ $link->link_description }}
                </p>

                <!-- Link URL -->
                <a href="{{ $link->link_url }}" target="_blank" style="color: #555; text-decoration: none; font-size: 14px; transition: color 0.3s ease;" onmouseover="this.style.color='#007bff'" onmouseout="this.style.color='#555'">
                    <span style="color: #007bff;">👉</span> {{ $link->link_url }}
                </a>
            </div>
        </li>
    @endforeach
</ul>

<!-- <hr style="margin: 30px 0; border: none; height: 2px; background: linear-gradient(to right, #ddd, transparent);"> -->











            <h4 id="company-attachments" style="text-align: center; font-size: 20px; color: #2c3e50; font-weight: 600; border-bottom: 2px solid #ddd; padding-bottom: 5px; margin-bottom: 20px;" class="section">
                📄 Attachments
            </h4>
            <!-- <ul style="list-style: none; padding: 0;">
                <?php $i = 1; ?>
                @foreach($investee->attachments as $attachment)
                    <li style="padding: 12px; margin-bottom: 8px; display: flex; justify-content: space-between; align-items: center; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.05);">
                        <a href="{{ asset('storage/'.$attachment->file_path)}}" target="_blank" download="{{ $attachment->file_name }}" style="color: #007bff; text-decoration: none; font-size: 14px; transition: 0.3s;" onmouseover="this.style.color='#ff5733'" onmouseout="this.style.color='#007bff'">
                            <i class="fa fa-download" style="margin-right: 8px;"></i> file {{$i++}}
                        </a>
                    </li>
                @endforeach
            </ul> -->
            <ul style="list-style: none; padding: 0;">
            <?php $i = 1; ?>
            @foreach($investee->attachments as $attachment)
                <li style="padding: 12px; margin-bottom: 8px; display: flex; justify-content: space-between; align-items: center; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.05);">
                    <!-- Check file description and assign the icon -->
                    <a href="{{ asset('storage/'.$attachment->file_path)}}" target="_blank" download="{{ $attachment->file_name }}" style="color: #007bff; text-decoration: none; font-size: 14px; transition: 0.3s;" onmouseover="this.style.color='#ff5733'" onmouseout="this.style.color='#007bff'">
                        <!-- Check the description for pitch_deck and financials -->
                        @if(strpos(strtolower($attachment->type), 'pitch_deck') !== false)
                            <i class="fa fa-file-powerpoint" style="margin-right: 8px; color: #ff6f61;"></i> <!-- PowerPoint icon for pitch deck -->
                        @elseif(strpos(strtolower($attachment->type), 'financials') !== false)
                            <i class="fa fa-chart-line" style="margin-right: 8px; color: #28a745;"></i> <!-- Chart icon for financials -->
                        @else
                            <i class="fa fa-file" style="margin-right: 8px;"></i> <!-- Default file icon -->
                        @endif
                        File {{$i++}}<i class="fa fa-download" style="margin-right: 8px;"></i>
                    </a>
                </li>
            @endforeach
        </ul>



            <hr style="margin: 20px 0; border: none; height: 2px; background: linear-gradient(to right, #ccc, transparent);">

            <h4 id="company-referral-sources" style="text-align: center; font-size: 20px; color: #2c3e50; font-weight: 600; border-bottom: 2px solid #ddd; padding-bottom: 5px; margin-bottom: 20px;">
                📌 Referral Sources
            </h4>
            <ul style="list-style: none; padding: 0;">
    <li style="padding: 12px; margin-bottom: 8px; background-color: #f9f9f9; border-radius: 8px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15);">
        <dfn style="font-size: 14px; color: #333;">{{ $investee->source_name ?? 'N/A' }}</dfn>
    </li>
</ul>























                
        </div>
    </div>

























































    

<style>
    .sidebar {
    width: 300px;
    /* background: linear-gradient(to bottom, #007bff, #0056b3); */
    background: linear-gradient(to bottom, #007bff, #007bff);
    padding: 10px;
    border-radius: 12px;
    box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
    position: sticky;
    top: 80px; /* Adjust based on navbar height */
    max-height: calc(100vh - 100px); /* Prevent overlap with footer */
    overflow-y: auto; /* Enable scrolling if necessary */
}


    .sidebar h3 {
        text-align: center;
        /* background: linear-gradient(to right, #174a7d, #13507a); */
        color: white;
        padding: 10px;
        border-radius: 8px;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
        /* margin-top: 10px; */
        margin : 10px;
    }

    .sidebar ul li {
        margin: 2px 2px;
        padding: 10px;
        border-radius: 8px;
        transition: 0.3s;
    }

    /* .sidebar ul li a {
        text-decoration: none;
        font-size: 14px;
        color: #333;
        display: block;
        padding: 10px;
        border-radius: 8px;
        transition: all 0.3s;
    } */

    .sidebar ul li a {
    text-decoration: none;
    font-size: 14px; /* Increased font size */
    color: white; /* Changed to white for better visibility */
    display: block;
    padding: 5px 5px;
    border-radius: 8px;
    transition: all 0.3s;
    background: transparent;
}
    /* .sidebar ul li a:hover, .sidebar ul li a.active {
        background: #174a7d;
        color: white;
    } */
/* Sidebar Hover and Active */
.sidebar ul li a:hover, 
.sidebar ul li a.active {
    background-color: rgba(255, 255, 255, 0.2);
    color: #fff;
    font-weight: bold;
    border-radius: 5px;
}
    .main-content {
    flex: 1;
    min-width: 850px;
    margin-left: 10px;
    background: #ffffff;
    border-radius: 12px;
    padding: 10px;
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
    transition: 0.3s;
    border: 1px solid #ccc;
    padding-bottom: 50px; /* Ensure content does not overlap footer */
}
@media screen and (max-width: 768px) {
    .sidebar {
        width: 100%;
        margin-bottom: 20px;
        position: relative; /* Change from sticky to relative on small screens */
    }
    .main-content {
        min-width: 100%;
        margin-left: 0;
    }
}

</style>


    
<script>
document.addEventListener("DOMContentLoaded", function () {
    const links = document.querySelectorAll(".sidebar ul li a");
    const sections = document.querySelectorAll("h2, h4");
    
    links.forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault();
            const section = document.querySelector(this.getAttribute("href"));
            if (section) {
                section.scrollIntoView({ behavior: "smooth" });
            }
        });
    });

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                links.forEach(link => link.classList.remove("active"));
                document.querySelector(`.sidebar ul li a[href="#${entry.target.id}"]`)?.classList.add("active");
            }
        });
    }, { threshold: 0.6 });

    sections.forEach(section => observer.observe(section));
});
document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.querySelector(".sidebar");
    const navbarHeight = 80; // Adjust to match actual navbar height

    window.addEventListener("scroll", function () {
        let scrollY = window.scrollY;
        let newTop = Math.max(navbarHeight - Math.min(scrollY, 80), 0) + "px";
        sidebar.style.top = newTop;
    });
});

</script>
<!-- <Script>
window.addEventListener("scroll",function(){
    let scrollposition =window.scrollY;
    document.querySelectorAll(".section-card").forEach(section => {
        let sectionTop = section.offsetTop;
        let sectionHeight = section.clientHeight;
        

        if(scrollposition >= sectionTop-50 && scrollposition < sectionTop + sectionHeight){
            document.querySelectorAll(".list-group-item").forEach(link => {
                link.classList.remove("active");
            })

          let sidebarsection=document.querySelector(`.list-group-item[href="#${section.id}"]`);
          if(sidebarsection){
            sidebarsection.classList.add("active");
          }
        }
    })
})
</script> -->
<!-- Your existing script -->
<script>
window.addEventListener("scroll", function() {
    let scrollPosition = window.scrollY; // Get current scroll position

    // Loop through each section
    document.querySelectorAll(".section").forEach(section => {
        let sectionTop = section.offsetTop; // Get top position of the section
        let sectionHeight = section.clientHeight; // Get height of the section

        // Check if scroll is within the section
        if (scrollPosition >= sectionTop - 50 && scrollPosition < sectionTop + sectionHeight) {
            // Remove active class from all sidebar links
            document.querySelectorAll(".list-group-item").forEach(link => {
                link.classList.remove("active");
            });

            // Add active class to the current link
            let sidebarSection = document.querySelector(`.list-group-item[href="#${section.id}"]`);
            if (sidebarSection) {
                sidebarSection.classList.add("active");
            }
        }
    });
});
</script>
@endsection












 

















