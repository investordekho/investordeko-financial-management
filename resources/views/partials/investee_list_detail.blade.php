@extends('layouts.app')

@section('content')
<div style="display:flex; justify-content:center; align-items: left; margin-bottom:10px; background-color: #f4f7fb; padding: 10px; border-radius: 12px; box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15); transaction 0.3s; border: 1px solid #ccc;">
    <div style="margin-right:10px; margin-left:50px;">sidebar</div>
<div style="max-width: 850px; margin: 10px auto; background: #f4f7fb; border-radius: 12px; padding: 25px; box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15); transition: 0.3s; border: 1px solid #ccc;">

    <!-- Title -->
    <h2 style="text-align: center; color: white; margin-bottom: 20px; padding: 12px; border-radius: 12px; background: linear-gradient(to right, #174a7d, #13507a); box-shadow: 0px 5px 15px rgba(0,0,0,0.1);">
        <span style="color: rgb(199, 210, 223);">Company Details</span>
    </h2>

    <!-- Company Name -->
    <div style="margin-bottom: 20px; text-align: center;">
        <h4 style="color: #222; font-size: 22px; border-radius: 8px; background: white; padding: 6px 10px; display: inline-block; box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);">
            <mark style="background: none;">{{ $investee->company_name }}</mark>
        </h4>
        <p style="color: #666; font-size: 16px;">{{ $investee->nature_of_business }}</p>
    </div>

    <!-- Details Section -->
    <div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
        <div style="width: 48%;">
            <p><strong>📍 Address:</strong> <span style="font-style: italic;">{{ $investee->address }}</span></p>
            <p><strong>📆 Incorporated In:</strong> <time datetime="{{ $investee->incorporated_in }}">{{ $investee->incorporated_in }}</time></p>
            <p><strong>🌐 Website:</strong> <a href="{{ $investee->website }}" target="_blank" style="color: #007bff; text-decoration: none;">{{ $investee->website }}</a></p>
            <p><strong>🔗 LinkedIn:</strong> <a href="{{ $investee->linkedin }}" target="_blank" style="color: #007bff; text-decoration: none;">{{ $investee->linkedin }}</a></p>
        </div>
        <div style="width: 48%;">
            <p><strong>👤 User:</strong> <span style="font-weight: bold;">{{ $investee->user->name ?? 'N/A' }}</span></p>
            <p><strong>📧 Email:</strong> <abbr title="Email Address">{{ $investee->user->email ?? 'N/A' }}</abbr></p>
            <p><strong>📞 Phone:</strong> <code>{{ $investee->user->phone ?? 'N/A' }}</code></p>
        </div>
    </div>

    <hr style="margin: 20px 0; border: none; height: 2px; background: linear-gradient(to right, #ccc, transparent);">

    <!-- Founders Section -->
    <h4 style="text-align: center; border-bottom: 2px solid #ddd; padding-bottom: 5px;">🚀 Founders</h4>
    <ul style="list-style: none; padding: 0;">
        @foreach($investee->founders as $founder)
            <li style="background: #fafafa; border: 1px solid #ddd; padding: 12px; margin-bottom: 6px; border-radius: 8px; transition: 0.3s;">
                <strong>{{ $founder->name }}</strong> - <span style="text-transform: uppercase;">{{ $founder->position }}</span> 
                (<em>{{ $founder->education }}</em>, <small>{{ $founder->experience }} years</small>)
            </li>
        @endforeach
    </ul>

    <hr style="margin: 20px 0; border: none; height: 2px; background: linear-gradient(to right, #ccc, transparent);">

    <!-- Concerned Persons -->
    <h4 style="text-align: center; border-bottom: 2px solid #ddd; padding-bottom: 5px;">🔎 Concerned Persons</h4>
    @if($investee->concernedPerson)
    <blockquote style="border-left: 5px solid #007bff; padding-left: 10px; font-style: italic; background: #eef4ff; padding: 12px; border-radius: 8px;">
        <p><strong>{{ $investee->concernedPerson->name }}</strong> - {{ $investee->concernedPerson->designation }}</p>
        <p>Email: {{ $investee->concernedPerson->email }} | Phone: {{ $investee->concernedPerson->phone }}</p>
    </blockquote>
    @else
        <p style="color: #666; text-align: center;">No concerned person found.</p>
    @endif

    <hr style="margin: 20px 0; border: none; height: 2px; background: linear-gradient(to right, #ccc, transparent);">
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- Fund Requirements -->
 <h4 style="text-align:center; border-bottom: 2px solid #ddd; padding-bottom:5px;">Fund Requirements</h4>
 <ul style="list-style:none; padding:0;">
        @foreach($investee->fundRequirements as $fund)
            <li style="background: #fafafa; border: 1px solid #ddd; padding: 10px; margin-bottom:5px; border-raadius:6px;">
                <strong>Usage:</strong> {{ $fund->usage}} | <strong>Amount:</strong> {{ number_format($fund->amount,2)}} {{ $fund->unit}}
            </li>
        @endforeach    
</ul>

<hr style="margin: 20px 0; border: none; height: 2px; background: linear-gradient(to right, #ccc, transparent);">
<!-- Previous Rounds -->

<h4 style="text-align:center; border-bottom:2px; padding-bottom:5px;">Previus Investment Rounds</h4>
<ul style="list-style: none; padding:0;">
    @foreach($investee->previousRounds as $round)
        <li style="background: #fafafa; border:1px solid #ddd; padding:10px; margin-botton:5px; border-radius:6px;">
            <strong>Round:</strong> {{ $round->round }} | <strong>Investors:</strong> {{ $round->investors}} <br>
            <strong>Amount Raised:<strong> {{ number_format($round->amount_raised,2)}} crores | <strong>Valiuation:</strong> {{ number_format($round->valuation,2)}} crores
        </li>
    @endforeach    
</ul>    

<hr style="margin: 20px 0; border: none:height:2px;  background: linear-gradient(to right, #ccc, transparent);">
<!-- Other Links -->
    <h4 style="text-align: center; border-bottom: 2px solid #ddd; padding-bottom: 5px;">🔗 Other Links</h4>
    <ul style="list-style: none; padding: 0;">
        @foreach($investee->otherLinks as $link)
            <li style="background: #fafafa; border: 1px solid #ddd; padding: 12px; margin-bottom: 6px; border-radius: 8px;">
                <a href="{{ $link->link_url }}" target="_blank" style="color: #007bff; text-decoration: none; transition: 0.3s;" onmouseover="this.style.color='#ff5733'" onmouseout="this.style.color='#007bff'">
                    {{ $link->link_description }}
                </a>
            </li>
        @endforeach
    </ul>
    <hr style="margin: 20px 0; border: none; height: 2px; background: linear-gradient(to right, #ccc, transparent);">

    <!--Attachments -->
    <h4 style="text-align: center; border-bottom:2px; padding-bottom:5px;">   📄 Attachments</h4>
    <ul style="list-style:none; padding:0;">
        <?php $i = 1; ?>

        @foreach($investee->attachments as $attachment)
            <li style="background: #fafafa;  boder: 1px solid #ddd; padding: 12px; margin-bottom: 6px; boder-radius: 8px;">
                <a href="{{ asset('storage/'.$attachment->file_path)}}" target="_blank" download="{{ $attachment->file_name }}" style="color: #007bff; text-decoration:none; transition: 0.3s;" onmouseover="this.style.color='#ff5733'" onmouseout="this.style.color='#007bff'">
                    <i class="fa fa-download"> file {{$i++}} </i>
                </a>    
            </li>
        @endforeach
    </ul>

    <hr style="margin: 20px 0; border: none; height: 2px; background: linear-gradient(to right, #ccc, transparent);">

    <!-- Referral Sources -->
    <h4 style="text-align: center; border-bottom: 2px solid #ddd; padding-bottom: 5px;">📌 Referral Sources</h4>
    <ul style="list-style: none; padding: 0;">
        <li style="background: #fafafa; border: 1px solid #ddd; padding: 12px; margin-bottom: 6px; border-radius: 8px;">
            <dfn>{{ $investee->source_name ?? 'N/A' }}</dfn>
        </li>
    </ul>
</div>
@endsection

</div>