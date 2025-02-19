@extends('layouts.app')

@section('content')

<style>
    #Ctext{
        font-size: 14px;
        color: grey;
    }
</style>
<style>
    /* Define the clockwise rotation animation */
    @keyframes rotateClockwise {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /* Apply the animation when the class is added */
    .rotate-clockwise {
        animation: rotateClockwise 0.5s ease-in-out;
    }
</style>

<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                <h2 class="text-center">Signup Now</h2>

                <!-- Display Success or Error Messages -->
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Registration Form -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Full Name and Email Fields on the Same Line -->
                    <div class="row g-3">
                        <div class="col-sm-6 mb-3">
                            <label id="Ctext" for="fullName">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="name" value="{{ old('name') }}" placeholder="Enter your full name" required>
                            
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label id="Ctext" for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required>
                            
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                      <div class="row g-3">

                    <!-- Phone Number Field Covering Full Line -->
                    <div class="form-auto mb-1">
                        <div class="input-group" style="margin-bottom: -10px;">
                            <!-- Country Code Dropdown -->
                            <select class="form-select p-1" name="country_code" id="country_code" required style="max-width: 150px;">
                                <option value="+91" {{ old('country_code') == '+91' ? 'selected' : '' }}>+91 (IN)</option>
                               <option value="+93" {{ old('country_code') == '+93' ? 'selected' : '' }}>+93 (AF)</option>
                            <option value="+358" {{ old('country_code') == '+358' ? 'selected' : '' }}>+358 (AX)</option>
                            <option value="+355" {{ old('country_code') == '+355' ? 'selected' : '' }}>+355 (AL)</option>
                            <option value="+213" {{ old('country_code') == '+213' ? 'selected' : '' }}>+213 (DZ)</option>
                            <option value="+1684" {{ old('country_code') == '+1684' ? 'selected' : '' }}>+1684 (AS)</option>
                            <option value="+376" {{ old('country_code') == '+376' ? 'selected' : '' }}>+376 (AD)</option>
                            <option value="+244" {{ old('country_code') == '+244' ? 'selected' : '' }}>+244 (AO)</option>
                            <option value="+1264" {{ old('country_code') == '+1264' ? 'selected' : '' }}>+1264 (AI)</option>
                            <option value="+672" {{ old('country_code') == '+672' ? 'selected' : '' }}>+672 (AQ)</option>
                            <option value="+1268" {{ old('country_code') == '+1268' ? 'selected' : '' }}>+1268 (AG)</option>
                            <option value="+54" {{ old('country_code') == '+54' ? 'selected' : '' }}>+54 (AR)</option>
                            <option value="+374" {{ old('country_code') == '+374' ? 'selected' : '' }}>+374 (AM)</option>
                            <option value="+297" {{ old('country_code') == '+297' ? 'selected' : '' }}>+297 (AW)</option>
                            <option value="+61" {{ old('country_code') == '+61' ? 'selected' : '' }}>+61 (AU)</option>
                            <option value="+43" {{ old('country_code') == '+43' ? 'selected' : '' }}>+43 (AT)</option>
                            <option value="+994" {{ old('country_code') == '+994' ? 'selected' : '' }}>+994 (AZ)</option>
                            <option value="+1242" {{ old('country_code') == '+1242' ? 'selected' : '' }}>+1242 (BS)</option>
                            <option value="+973" {{ old('country_code') == '+973' ? 'selected' : '' }}>+973 (BH)</option>
                            <option value="+880" {{ old('country_code') == '+880' ? 'selected' : '' }}>+880 (BD)</option>
                            <option value="+1246" {{ old('country_code') == '+1246' ? 'selected' : '' }}>+1246 (BB)</option>
                            <option value="+375" {{ old('country_code') == '+375' ? 'selected' : '' }}>+375 (BY)</option>
                            <option value="+32" {{ old('country_code') == '+32' ? 'selected' : '' }}>+32 (BE)</option>
                            <option value="+501" {{ old('country_code') == '+501' ? 'selected' : '' }}>+501 (BZ)</option>
                            <option value="+229" {{ old('country_code') == '+229' ? 'selected' : '' }}>+229 (BJ)</option>
                            <option value="+1441" {{ old('country_code') == '+1441' ? 'selected' : '' }}>+1441 (BM)</option>
                            <option value="+975" {{ old('country_code') == '+975' ? 'selected' : '' }}>+975 (BT)</option>
                            <option value="+591" {{ old('country_code') == '+591' ? 'selected' : '' }}>+591 (BO)</option>
                            <option value="+387" {{ old('country_code') == '+387' ? 'selected' : '' }}>+387 (BA)</option>
                            <option value="+267" {{ old('country_code') == '+267' ? 'selected' : '' }}>+267 (BW)</option>
                            <option value="+55" {{ old('country_code') == '+55' ? 'selected' : '' }}>+55 (BR)</option>
                            <option value="+246" {{ old('country_code') == '+246' ? 'selected' : '' }}>+246 (IO)</option>
                            <option value="+673" {{ old('country_code') == '+673' ? 'selected' : '' }}>+673 (BN)</option>
                            <option value="+359" {{ old('country_code') == '+359' ? 'selected' : '' }}>+359 (BG)</option>
                            <option value="+226" {{ old('country_code') == '+226' ? 'selected' : '' }}>+226 (BF)</option>
                            <option value="+257" {{ old('country_code') == '+257' ? 'selected' : '' }}>+257 (BI)</option>
                            <option value="+855" {{ old('country_code') == '+855' ? 'selected' : '' }}>+855 (KH)</option>
                            <option value="+237" {{ old('country_code') == '+237' ? 'selected' : '' }}>+237 (CM)</option>
                            <option value="+1" {{ old('country_code') == '+1' ? 'selected' : '' }}>+1 (CA)</option>
                            <option value="+238" {{ old('country_code') == '+238' ? 'selected' : '' }}>+238 (CV)</option>
                            <option value="+ 345" {{ old('country_code') == '+ 345' ? 'selected' : '' }}>+ 345 (KY)</option>
                            <option value="+236" {{ old('country_code') == '+236' ? 'selected' : '' }}>+236 (CF)</option>
                            <option value="+235" {{ old('country_code') == '+235' ? 'selected' : '' }}>+235 (TD)</option>
                            <option value="+56" {{ old('country_code') == '+56' ? 'selected' : '' }}>+56 (CL)</option>
                            <option value="+86" {{ old('country_code') == '+86' ? 'selected' : '' }}>+86 (CN)</option>
                            <option value="+61" {{ old('country_code') == '+61' ? 'selected' : '' }}>+61 (CX)</option>
                            <option value="+61" {{ old('country_code') == '+61' ? 'selected' : '' }}>+61 (CC)</option>
                            <option value="+57" {{ old('country_code') == '+57' ? 'selected' : '' }}>+57 (CO)</option>
                            <option value="+269" {{ old('country_code') == '+269' ? 'selected' : '' }}>+269 (KM)</option>
                            <option value="+242" {{ old('country_code') == '+242' ? 'selected' : '' }}>+242 (CG)</option>
                            <option value="+243" {{ old('country_code') == '+243' ? 'selected' : '' }}>+243 (CD)</option>
                            <option value="+682" {{ old('country_code') == '+682' ? 'selected' : '' }}>+682 (CK)</option>
                            <option value="+506" {{ old('country_code') == '+506' ? 'selected' : '' }}>+506 (CR)</option>
                            <option value="+225" {{ old('country_code') == '+225' ? 'selected' : '' }}>+225 (CI)</option>
                            <option value="+385" {{ old('country_code') == '+385' ? 'selected' : '' }}>+385 (HR)</option>
                            <option value="+53" {{ old('country_code') == '+53' ? 'selected' : '' }}>+53 (CU)</option>
                            <option value="+357" {{ old('country_code') == '+357' ? 'selected' : '' }}>+357 (CY)</option>
                            <option value="+420" {{ old('country_code') == '+420' ? 'selected' : '' }}>+420 (CZ)</option>
                            <option value="+45" {{ old('country_code') == '+45' ? 'selected' : '' }}>+45 (DK)</option>
                            <option value="+253" {{ old('country_code') == '+253' ? 'selected' : '' }}>+253 (DJ)</option>
                            <option value="+1767" {{ old('country_code') == '+1767' ? 'selected' : '' }}>+1767 (DM)</option>
                            <option value="+1849" {{ old('country_code') == '+1849' ? 'selected' : '' }}>+1849 (DO)</option>
                            <option value="+593" {{ old('country_code') == '+593' ? 'selected' : '' }}>+593 (EC)</option>
                            <option value="+20" {{ old('country_code') == '+20' ? 'selected' : '' }}>+20 (EG)</option>
                            <option value="+503" {{ old('country_code') == '+503' ? 'selected' : '' }}>+503 (SV)</option>
                            <option value="+240" {{ old('country_code') == '+240' ? 'selected' : '' }}>+240 (GQ)</option>
                            <option value="+291" {{ old('country_code') == '+291' ? 'selected' : '' }}>+291 (ER)</option>
                            <option value="+372" {{ old('country_code') == '+372' ? 'selected' : '' }}>+372 (EE)</option>
                            <option value="+251" {{ old('country_code') == '+251' ? 'selected' : '' }}>+251 (ET)</option>
                            <option value="+500" {{ old('country_code') == '+500' ? 'selected' : '' }}>+500 (FK)</option>
                            <option value="+298" {{ old('country_code') == '+298' ? 'selected' : '' }}>+298 (FO)</option>
                            <option value="+679" {{ old('country_code') == '+679' ? 'selected' : '' }}>+679 (FJ)</option>
                            <option value="+358" {{ old('country_code') == '+358' ? 'selected' : '' }}>+358 (FI)</option>
                            <option value="+33" {{ old('country_code') == '+33' ? 'selected' : '' }}>+33 (FR)</option>
                            <option value="+594" {{ old('country_code') == '+594' ? 'selected' : '' }}>+594 (GF)</option>
                            <option value="+689" {{ old('country_code') == '+689' ? 'selected' : '' }}>+689 (PF)</option>
                            <option value="+241" {{ old('country_code') == '+241' ? 'selected' : '' }}>+241 (GA)</option>
                            <option value="+220" {{ old('country_code') == '+220' ? 'selected' : '' }}>+220 (GM)</option>
                            <option value="+995" {{ old('country_code') == '+995' ? 'selected' : '' }}>+995 (GE)</option>
                            <option value="+49" {{ old('country_code') == '+49' ? 'selected' : '' }}>+49 (DE)</option>
                            <option value="+233" {{ old('country_code') == '+233' ? 'selected' : '' }}>+233 (GH)</option>
                            <option value="+350" {{ old('country_code') == '+350' ? 'selected' : '' }}>+350 (GI)</option>
                            <option value="+30" {{ old('country_code') == '+30' ? 'selected' : '' }}>+30 (GR)</option>
                            <option value="+299" {{ old('country_code') == '+299' ? 'selected' : '' }}>+299 (GL)</option>
                            <option value="+1473" {{ old('country_code') == '+1473' ? 'selected' : '' }}>+1473 (GD)</option>
                            <option value="+590" {{ old('country_code') == '+590' ? 'selected' : '' }}>+590 (GP)</option>
                            <option value="+1671" {{ old('country_code') == '+1671' ? 'selected' : '' }}>+1671 (GU)</option>
                            <option value="+502" {{ old('country_code') == '+502' ? 'selected' : '' }}>+502 (GT)</option>
                            <option value="+44" {{ old('country_code') == '+44' ? 'selected' : '' }}>+44 (GG)</option>
                            <option value="+224" {{ old('country_code') == '+224' ? 'selected' : '' }}>+224 (GN)</option>
                            <option value="+245" {{ old('country_code') == '+245' ? 'selected' : '' }}>+245 (GW)</option>
                            <option value="+595" {{ old('country_code') == '+595' ? 'selected' : '' }}>+595 (GY)</option>
                            <option value="+509" {{ old('country_code') == '+509' ? 'selected' : '' }}>+509 (HT)</option>
                            <option value="+379" {{ old('country_code') == '+379' ? 'selected' : '' }}>+379 (VA)</option>
                            <option value="+504" {{ old('country_code') == '+504' ? 'selected' : '' }}>+504 (HN)</option>
                            <option value="+852" {{ old('country_code') == '+852' ? 'selected' : '' }}>+852 (HK)</option>
                            <option value="+36" {{ old('country_code') == '+36' ? 'selected' : '' }}>+36 (HU)</option>
                            <option value="+354" {{ old('country_code') == '+354' ? 'selected' : '' }}>+354 (IS)</option>
                            <option value="+62" {{ old('country_code') == '+62' ? 'selected' : '' }}>+62 (ID)</option>
                            <option value="+98" {{ old('country_code') == '+98' ? 'selected' : '' }}>+98 (IR)</option>
                            <option value="+964" {{ old('country_code') == '+964' ? 'selected' : '' }}>+964 (IQ)</option>
                            <option value="+353" {{ old('country_code') == '+353' ? 'selected' : '' }}>+353 (IE)</option>
                            <option value="+44" {{ old('country_code') == '+44' ? 'selected' : '' }}>+44 (IM)</option>
                            <option value="+972" {{ old('country_code') == '+972' ? 'selected' : '' }}>+972 (IL)</option>
                            <option value="+39" {{ old('country_code') == '+39' ? 'selected' : '' }}>+39 (IT)</option>
                            <option value="+1876" {{ old('country_code') == '+1876' ? 'selected' : '' }}>+1876 (JM)</option>
                            <option value="+81" {{ old('country_code') == '+81' ? 'selected' : '' }}>+81 (JP)</option>
                            <option value="+44" {{ old('country_code') == '+44' ? 'selected' : '' }}>+44 (JE)</option>
                            <option value="+962" {{ old('country_code') == '+962' ? 'selected' : '' }}>+962 (JO)</option>
                            <option value="+77" {{ old('country_code') == '+77' ? 'selected' : '' }}>+77 (KZ)</option>
                            <option value="+254" {{ old('country_code') == '+254' ? 'selected' : '' }}>+254 (KE)</option>
                            <option value="+686" {{ old('country_code') == '+686' ? 'selected' : '' }}>+686 (KI)</option>
                            <option value="+850" {{ old('country_code') == '+850' ? 'selected' : '' }}>+850 (KP)</option>
                            <option value="+82" {{ old('country_code') == '+82' ? 'selected' : '' }}>+82 (KR)</option>
                            <option value="+965" {{ old('country_code') == '+965' ? 'selected' : '' }}>+965 (KW)</option>
                            <option value="+996" {{ old('country_code') == '+996' ? 'selected' : '' }}>+996 (KG)</option>
                            <option value="+856" {{ old('country_code') == '+856' ? 'selected' : '' }}>+856 (LA)</option>
                            <option value="+371" {{ old('country_code') == '+371' ? 'selected' : '' }}>+371 (LV)</option>
                            <option value="+961" {{ old('country_code') == '+961' ? 'selected' : '' }}>+961 (LB)</option>
                            <option value="+266" {{ old('country_code') == '+266' ? 'selected' : '' }}>+266 (LS)</option>
                            <option value="+231" {{ old('country_code') == '+231' ? 'selected' : '' }}>+231 (LR)</option>
                            <option value="+218" {{ old('country_code') == '+218' ? 'selected' : '' }}>+218 (LY)</option>
                            <option value="+423" {{ old('country_code') == '+423' ? 'selected' : '' }}>+423 (LI)</option>
                            <option value="+370" {{ old('country_code') == '+370' ? 'selected' : '' }}>+370 (LT)</option>
                            <option value="+352" {{ old('country_code') == '+352' ? 'selected' : '' }}>+352 (LU)</option>
                            <option value="+853" {{ old('country_code') == '+853' ? 'selected' : '' }}>+853 (MO)</option>
                            <option value="+389" {{ old('country_code') == '+389' ? 'selected' : '' }}>+389 (MK)</option>
                            <option value="+261" {{ old('country_code') == '+261' ? 'selected' : '' }}>+261 (MG)</option>
                            <option value="+265" {{ old('country_code') == '+265' ? 'selected' : '' }}>+265 (MW)</option>
                            <option value="+60" {{ old('country_code') == '+60' ? 'selected' : '' }}>+60 (MY)</option>
                            <option value="+960" {{ old('country_code') == '+960' ? 'selected' : '' }}>+960 (MV)</option>
                            <option value="+223" {{ old('country_code') == '+223' ? 'selected' : '' }}>+223 (ML)</option>
                            <option value="+356" {{ old('country_code') == '+356' ? 'selected' : '' }}>+356 (MT)</option>
                            <option value="+692" {{ old('country_code') == '+692' ? 'selected' : '' }}>+692 (MH)</option>
                            <option value="+596" {{ old('country_code') == '+596' ? 'selected' : '' }}>+596 (MQ)</option>
                            <option value="+222" {{ old('country_code') == '+222' ? 'selected' : '' }}>+222 (MR)</option>
                            <option value="+230" {{ old('country_code') == '+230' ? 'selected' : '' }}>+230 (MU)</option>
                            <option value="+262" {{ old('country_code') == '+262' ? 'selected' : '' }}>+262 (YT)</option>
                            <option value="+52" {{ old('country_code') == '+52' ? 'selected' : '' }}>+52 (MX)</option>
                            <option value="+691" {{ old('country_code') == '+691' ? 'selected' : '' }}>+691 (FM)</option>
                            <option value="+373" {{ old('country_code') == '+373' ? 'selected' : '' }}>+373 (MD)</option>
                            <option value="+377" {{ old('country_code') == '+377' ? 'selected' : '' }}>+377 (MC)</option>
                            <option value="+976" {{ old('country_code') == '+976' ? 'selected' : '' }}>+976 (MN)</option>
                            <option value="+382" {{ old('country_code') == '+382' ? 'selected' : '' }}>+382 (ME)</option>
                            <option value="+1664" {{ old('country_code') == '+1664' ? 'selected' : '' }}>+1664 (MS)</option>
                            <option value="+212" {{ old('country_code') == '+212' ? 'selected' : '' }}>+212 (MA)</option>
                            <option value="+258" {{ old('country_code') == '+258' ? 'selected' : '' }}>+258 (MZ)</option>
                            <option value="+95" {{ old('country_code') == '+95' ? 'selected' : '' }}>+95 (MM)</option>
                            <option value="+264" {{ old('country_code') == '+264' ? 'selected' : '' }}>+264 (NA)</option>
                            <option value="+674" {{ old('country_code') == '+674' ? 'selected' : '' }}>+674 (NR)</option>
                            <option value="+977" {{ old('country_code') == '+977' ? 'selected' : '' }}>+977 (NP)</option>
                            <option value="+31" {{ old('country_code') == '+31' ? 'selected' : '' }}>+31 (NL)</option>
                            <option value="+599" {{ old('country_code') == '+599' ? 'selected' : '' }}>+599 (AN)</option>
                            <option value="+687" {{ old('country_code') == '+687' ? 'selected' : '' }}>+687 (NC)</option>
                            <option value="+64" {{ old('country_code') == '+64' ? 'selected' : '' }}>+64 (NZ)</option>
                            <option value="+505" {{ old('country_code') == '+505' ? 'selected' : '' }}>+505 (NI)</option>
                            <option value="+227" {{ old('country_code') == '+227' ? 'selected' : '' }}>+227 (NE)</option>
                            <option value="+234" {{ old('country_code') == '+234' ? 'selected' : '' }}>+234 (NG)</option>
                            <option value="+683" {{ old('country_code') == '+683' ? 'selected' : '' }}>+683 (NU)</option>
                            <option value="+672" {{ old('country_code') == '+672' ? 'selected' : '' }}>+672 (NF)</option>
                            <option value="+1670" {{ old('country_code') == '+1670' ? 'selected' : '' }}>+1670 (MP)</option>
                            <option value="+47" {{ old('country_code') == '+47' ? 'selected' : '' }}>+47 (NO)</option>
                            <option value="+968" {{ old('country_code') == '+968' ? 'selected' : '' }}>+968 (OM)</option>
                            <option value="+92" {{ old('country_code') == '+92' ? 'selected' : '' }}>+92 (PK)</option>
                            <option value="+680" {{ old('country_code') == '+680' ? 'selected' : '' }}>+680 (PW)</option>
                            <option value="+970" {{ old('country_code') == '+970' ? 'selected' : '' }}>+970 (PS)</option>
                            <option value="+507" {{ old('country_code') == '+507' ? 'selected' : '' }}>+507 (PA)</option>
                            <option value="+675" {{ old('country_code') == '+675' ? 'selected' : '' }}>+675 (PG)</option>
                            <option value="+595" {{ old('country_code') == '+595' ? 'selected' : '' }}>+595 (PY)</option>
                            <option value="+51" {{ old('country_code') == '+51' ? 'selected' : '' }}>+51 (PE)</option>
                            <option value="+63" {{ old('country_code') == '+63' ? 'selected' : '' }}>+63 (PH)</option>
                            <option value="+872" {{ old('country_code') == '+872' ? 'selected' : '' }}>+872 (PN)</option>
                            <option value="+48" {{ old('country_code') == '+48' ? 'selected' : '' }}>+48 (PL)</option>
                            <option value="+351" {{ old('country_code') == '+351' ? 'selected' : '' }}>+351 (PT)</option>
                            <option value="+1939" {{ old('country_code') == '+1939' ? 'selected' : '' }}>+1939 (PR)</option>
                            <option value="+974" {{ old('country_code') == '+974' ? 'selected' : '' }}>+974 (QA)</option>
                            <option value="+40" {{ old('country_code') == '+40' ? 'selected' : '' }}>+40 (RO)</option>
                            <option value="+7" {{ old('country_code') == '+7' ? 'selected' : '' }}>+7 (RU)</option>
                            <option value="+250" {{ old('country_code') == '+250' ? 'selected' : '' }}>+250 (RW)</option>
                            <option value="+262" {{ old('country_code') == '+262' ? 'selected' : '' }}>+262 (RE)</option>
                            <option value="+590" {{ old('country_code') == '+590' ? 'selected' : '' }}>+590 (BL)</option>
                            <option value="+290" {{ old('country_code') == '+290' ? 'selected' : '' }}>+290 (SH)</option>
                            <option value="+1869" {{ old('country_code') == '+1869' ? 'selected' : '' }}>+1869 (KN)</option>
                            <option value="+1758" {{ old('country_code') == '+1758' ? 'selected' : '' }}>+1758 (LC)</option>
                            <option value="+590" {{ old('country_code') == '+590' ? 'selected' : '' }}>+590 (MF)</option>
                            <option value="+508" {{ old('country_code') == '+508' ? 'selected' : '' }}>+508 (PM)</option>
                            <option value="+1784" {{ old('country_code') == '+1784' ? 'selected' : '' }}>+1784 (VC)</option>
                            <option value="+685" {{ old('country_code') == '+685' ? 'selected' : '' }}>+685 (WS)</option>
                            <option value="+378" {{ old('country_code') == '+378' ? 'selected' : '' }}>+378 (SM)</option>
                            <option value="+239" {{ old('country_code') == '+239' ? 'selected' : '' }}>+239 (ST)</option>
                            <option value="+966" {{ old('country_code') == '+966' ? 'selected' : '' }}>+966 (SA)</option>
                            <option value="+221" {{ old('country_code') == '+221' ? 'selected' : '' }}>+221 (SN)</option>
                            <option value="+381" {{ old('country_code') == '+381' ? 'selected' : '' }}>+381 (RS)</option>
                            <option value="+248" {{ old('country_code') == '+248' ? 'selected' : '' }}>+248 (SC)</option>
                            <option value="+232" {{ old('country_code') == '+232' ? 'selected' : '' }}>+232 (SL)</option>
                            <option value="+65" {{ old('country_code') == '+65' ? 'selected' : '' }}>+65 (SG)</option>
                            <option value="+421" {{ old('country_code') == '+421' ? 'selected' : '' }}>+421 (SK)</option>
                            <option value="+386" {{ old('country_code') == '+386' ? 'selected' : '' }}>+386 (SI)</option>
                            <option value="+677" {{ old('country_code') == '+677' ? 'selected' : '' }}>+677 (SB)</option>
                            <option value="+252" {{ old('country_code') == '+252' ? 'selected' : '' }}>+252 (SO)</option>
                            <option value="+27" {{ old('country_code') == '+27' ? 'selected' : '' }}>+27 (ZA)</option>
                            <option value="+211" {{ old('country_code') == '+211' ? 'selected' : '' }}>+211 (SS)</option>
                            <option value="+500" {{ old('country_code') == '+500' ? 'selected' : '' }}>+500 (GS)</option>
                            <option value="+34" {{ old('country_code') == '+34' ? 'selected' : '' }}>+34 (ES)</option>
                            <option value="+94" {{ old('country_code') == '+94' ? 'selected' : '' }}>+94 (LK)</option>
                            <option value="+249" {{ old('country_code') == '+249' ? 'selected' : '' }}>+249 (SD)</option>
                            <option value="+597" {{ old('country_code') == '+597' ? 'selected' : '' }}>+597 (SR)</option>
                            <option value="+47" {{ old('country_code') == '+47' ? 'selected' : '' }}>+47 (SJ)</option>
                            <option value="+268" {{ old('country_code') == '+268' ? 'selected' : '' }}>+268 (SZ)</option>
                            <option value="+46" {{ old('country_code') == '+46' ? 'selected' : '' }}>+46 (SE)</option>
                            <option value="+41" {{ old('country_code') == '+41' ? 'selected' : '' }}>+41 (CH)</option>
                            <option value="+963" {{ old('country_code') == '+963' ? 'selected' : '' }}>+963 (SY)</option>
                            <option value="+886" {{ old('country_code') == '+886' ? 'selected' : '' }}>+886 (TW)</option>
                            <option value="+992" {{ old('country_code') == '+992' ? 'selected' : '' }}>+992 (TJ)</option>
                            <option value="+255" {{ old('country_code') == '+255' ? 'selected' : '' }}>+255 (TZ)</option>
                            <option value="+66" {{ old('country_code') == '+66' ? 'selected' : '' }}>+66 (TH)</option>
                            <option value="+670" {{ old('country_code') == '+670' ? 'selected' : '' }}>+670 (TL)</option>
                            <option value="+228" {{ old('country_code') == '+228' ? 'selected' : '' }}>+228 (TG)</option>
                            <option value="+690" {{ old('country_code') == '+690' ? 'selected' : '' }}>+690 (TK)</option>
                            <option value="+676" {{ old('country_code') == '+676' ? 'selected' : '' }}>+676 (TO)</option>
                            <option value="+1868" {{ old('country_code') == '+1868' ? 'selected' : '' }}>+1868 (TT)</option>
                            <option value="+216" {{ old('country_code') == '+216' ? 'selected' : '' }}>+216 (TN)</option>
                            <option value="+90" {{ old('country_code') == '+90' ? 'selected' : '' }}>+90 (TR)</option>
                            <option value="+993" {{ old('country_code') == '+993' ? 'selected' : '' }}>+993 (TM)</option>
                            <option value="+1649" {{ old('country_code') == '+1649' ? 'selected' : '' }}>+1649 (TC)</option>
                            <option value="+688" {{ old('country_code') == '+688' ? 'selected' : '' }}>+688 (TV)</option>
                            <option value="+256" {{ old('country_code') == '+256' ? 'selected' : '' }}>+256 (UG)</option>
                            <option value="+380" {{ old('country_code') == '+380' ? 'selected' : '' }}>+380 (UA)</option>
                            <option value="+971" {{ old('country_code') == '+971' ? 'selected' : '' }}>+971 (AE)</option>
                            <option value="+44" {{ old('country_code') == '+44' ? 'selected' : '' }}>+44 (GB)</option>
                            <option value="+1" {{ old('country_code') == '+1' ? 'selected' : '' }}>+1 (US)</option>
                            <option value="+598" {{ old('country_code') == '+598' ? 'selected' : '' }}>+598 (UY)</option>
                            <option value="+998" {{ old('country_code') == '+998' ? 'selected' : '' }}>+998 (UZ)</option>
                            <option value="+678" {{ old('country_code') == '+678' ? 'selected' : '' }}>+678 (VU)</option>
                            <option value="+58" {{ old('country_code') == '+58' ? 'selected' : '' }}>+58 (VE)</option>
                            <option value="+84" {{ old('country_code') == '+84' ? 'selected' : '' }}>+84 (VN)</option>
                            <option value="+1284" {{ old('country_code') == '+1284' ? 'selected' : '' }}>+1284 (VG)</option>
                            <option value="+1340" {{ old('country_code') == '+1340' ? 'selected' : '' }}>+1340 (VI)</option>
                            <option value="+681" {{ old('country_code') == '+681' ? 'selected' : '' }}>+681 (WF)</option>
                            <option value="+967" {{ old('country_code') == '+967' ? 'selected' : '' }}>+967 (YE)</option>
                            <option value="+260" {{ old('country_code') == '+260' ? 'selected' : '' }}>+260 (ZM)</option>
                            <option value="+263" {{ old('country_code') == '+263' ? 'selected' : '' }}>+263 (ZW)</option>

                                
                                <!-- Add more country codes as needed -->
                            </select>

                            <!-- Phone Number Input -->
                            <input type="number" class="form-control phone" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter your phone number" required maxlength="10">
                        </div>
                        <label for="phone"></label>
                        @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>

                    <!-- Password and Password Confirmation Fields on the Same Line -->
                    <div class="row g-3">
                        <div class="col-md-6 form-auto mb-1">
                            <label id="Ctext" for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 form-auto mb-1">
                            <label id="Ctext" for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                            
                        </div>
                    </div>

                    <!-- Category Field -->
                    <div class="form-auto mb-3">
                         <label id="Ctext" for="category">Join as</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                            @endforeach
                        </select>
                       
                        @error('category')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- CAPTCHA Field -->
                  
                    <!-- <div class="form-auto mb-3">
                        <input type="text" class="form-control" id="captcha" name="captcha" placeholder="Enter the result" required>
                        <label id="Ctext" for="captcha">What is {{ session('captcha_value_1') }}?</label>
                        @error('captcha')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div> -->

                    <div class="form-group mb-3">
                        <label for="captcha">Enter the text shown in the image:</label>
                        <input type="text" name="captcha" id="captcha" class="form-control" placeholder="Enter CAPTCHA" required>
                        <br>
                        <img id="captchaImage" src="{{ url('/captcha') }}" alt="CAPTCHA Image">
                        <!-- <button type="button" onclick="document.querySelector('img[alt=\'CAPTCHA Image\']').src = '{{ url('/captcha') }}?' + Math.random();">
                            Reload CAPTCHA
                        </button> -->
                        <img src="{{ asset('img/refresh.png') }}" id="refreshIcon" alt="Refresh CAPTCHA" style="cursor: pointer; width:25px; margin-left:10px;" onclick="refreshCaptcha()">

                        @error('captcha')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Terms and Conditions Checkbox -->
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                        <label class="form-check-label" for="terms">
                            By clicking to register, I agree to the <a href="{{ route('terms') }}">Terms of Use</a> and <a href="{{ route('privacy-policy') }}">Privacy Policy</a>.
                        </label>
                        @error('terms')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary py-3 px-5 w-100">Register</button>
                </form>

                <!-- Already have an account -->
                <h3 class="text-center mt-4">Already have an account? <a href="{{ route('login') }}">Login</a></h3>
            </div>
        </div>
    </div>
</div>

<!-- <script>
    function refreshCaptcha() {
        var captchaImage = document.getElementById('captchaImage');
        // Append a random query string to prevent caching
        captchaImage.src = '{{ url('/captcha') }}?' + Math.random();
    }
</script> -->
<!-- <script>
    function refreshCaptcha() {
        // Refresh the CAPTCHA image by appending a random query string to avoid caching
        var captchaImage = document.getElementById('captchaImage');
        captchaImage.src = '{{ url('/captcha') }}?' + Math.random();
        
        // Get the refresh icon and apply the rotation effect
        var refreshIcon = document.getElementById('refreshIcon');
        refreshIcon.style.transition = "transform 0.5s ease-in-out";
        refreshIcon.style.transform = "rotate(360deg)";
        
        // Reset the rotation after the animation completes (0.5 seconds)
        setTimeout(function() {
            refreshIcon.style.transform = "rotate(0deg)";
        }, 500);
    }
</script> -->
<script>
    function refreshCaptcha() {
        // Refresh the CAPTCHA image by appending a random query string to avoid caching
        var captchaImage = document.getElementById('captchaImage');
        captchaImage.src = '{{ url('/captcha') }}?' + Math.random();

        // Get the refresh icon and add the rotation class to trigger the animation
        var refreshIcon = document.getElementById('refreshIcon');

        // Remove the class if it's already there, then force a reflow before adding it again.
        refreshIcon.classList.remove('rotate-clockwise');
        void refreshIcon.offsetWidth; // This forces reflow, so the animation will re-trigger
        refreshIcon.classList.add('rotate-clockwise');
    }
</script>
@endsection
