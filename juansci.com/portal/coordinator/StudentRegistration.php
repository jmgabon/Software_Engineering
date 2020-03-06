<?php
include 'partials/header.php';
?>
<script type="text/javascript">
   $('#lead').text('Student Registration');
   $('#student').addClass('active');
</script>
<style type="text/css">
	input,select{
		width: 60% !important;
	}
	input[type='checkbox']{
		/*display: none;*/
		margin-left: -20% !important;
		margin-right: -25% !important;
	}
</style>
<div class="content-main mt-4" id="Student">
  	<form>
   	<div id = "FirstCol">
   	<div id="ApplicantSection"><p><h2 class="pt-3 pb-2"><b>APPLICANT'S SECTION</b></h2>
   	<!-- <p>* - REQUIRED</p> -->
  	<div class="photo-div">
		<p><label class="h5 m-0" for="file">*Upload Student's Photo</label></p>
		<center><p><img src="../../pictures/faceless.png" id="profile" style="width: 200px; height: 200px" class="photo-upload shadow" ></p>
		<input type="file" id="file" name="file" accept=".gif,.jpg,.jpeg,.png" required>
		</center>
	</div>
   <h4 class="pt-3 pb-2">Student Information</h4>
   <p><label for="LRNNum"><b>*LRN: </b></label><input type="text" id = "LRNNum" name = "LRNNum" required minlength="12" maxlength="12" required/></p>
   	<p>
		<label for="GradeLevel">Grade Level: </label>
		<select id="GradeLevel">
		<option selected="selected">7</option>
		<option>8</option>
		<option>9</option>
		<option>10</option>
		<!-- <option>11</option> -->
		<!-- <option>12</option> -->
		</select>
    </p>
	<p>
		<label for="Type">Type: </label>
		<select id="Type">
		<option selected="selected">New</option>
		<option>Transferee</option>
		</select>
    </p>
   <p class="h5 pb-2">Student's Name</p>
	<p><label for="LastName">*Last Name: </label><input type="text" id = "LastName" name = "LastName" required/></p>
   <p><label for="Extension">Extended Name: </label><input type="text" id = "ExtendedName" name = "ExtendedName"/></p>
	<p><label for="FirstName">*First Name: </label><input type="text" id = "FirstName" name = "FirstName" required/></p>
	<p><label for="MiddleName">Middle Name: </label><input type="text" id = "MiddleName" name = "MiddleName"/></p>
		
    <div id="Present_Address">
    	<!-- Current Address -->
      <p class="h5 pt-3 pb-2">Current Address</p>
		<p><label for="Present_StreetAdd">Street Address: </label><input type="text" id = "Present_StreetAdd" name = "Present_StreetAdd"></p>
		<p><label for="Present_City">*City: </label><input type="text" id = "Present_City" name = "Present_City" required></p>
		<p><label for="Present_Province">*Province: </label><input type="text" id = "Present_Province" name= "Present_Province" required></p>
		<p><label for="Present_Country">Country: </label>
         <select id = "Present_Country" name = "Present_Country">
   			<option value="Afganistan">Afghanistan</option>
   			<option value="Albania">Albania</option>
   			<option value="Algeria">Algeria</option>
   			<option value="American Samoa">American Samoa</option>
   			<option value="Andorra">Andorra</option>
   			<option value="Angola">Angola</option>
   			<option value="Anguilla">Anguilla</option>
   			<option value="Antigua & Barbuda">Antigua & Barbuda</option>
   			<option value="Argentina">Argentina</option>
   			<option value="Armenia">Armenia</option>
   			<option value="Aruba">Aruba</option>
   			<option value="Australia">Australia</option>
   			<option value="Austria">Austria</option>
   			<option value="Azerbaijan">Azerbaijan</option>
   			<option value="Bahamas">Bahamas</option>
   			<option value="Bahrain">Bahrain</option>
   			<option value="Bangladesh">Bangladesh</option>
   			<option value="Barbados">Barbados</option>
   			<option value="Belarus">Belarus</option>
   			<option value="Belgium">Belgium</option>
   			<option value="Belize">Belize</option>
   			<option value="Benin">Benin</option>
   			<option value="Bermuda">Bermuda</option>
   			<option value="Bhutan">Bhutan</option>
   			<option value="Bolivia">Bolivia</option>
   			<option value="Bonaire">Bonaire</option>
   			<option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
   			<option value="Botswana">Botswana</option>
   			<option value="Brazil">Brazil</option>
   			<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
   			<option value="Brunei">Brunei</option>
   			<option value="Bulgaria">Bulgaria</option>
   			<option value="Burkina Faso">Burkina Faso</option>
   			<option value="Burundi">Burundi</option>
   			<option value="Cambodia">Cambodia</option>
   			<option value="Cameroon">Cameroon</option>
            <option value="Canada">Canada</option>
   			<option value="Canary Islands">Canary Islands</option>
   			<option value="Cape Verde">Cape Verde</option>
   			<option value="Cayman Islands">Cayman Islands</option>
   			<option value="Central African Republic">Central African Republic</option>
   			<option value="Chad">Chad</option>
   			<option value="Channel Islands">Channel Islands</option>
   			<option value="Chile">Chile</option>
   			<option value="China">China</option>
   			<option value="Christmas Island">Christmas Island</option>
   			<option value="Cocos Island">Cocos Island</option>
   			<option value="Colombia">Colombia</option>
   			<option value="Comoros">Comoros</option>
   			<option value="Congo">Congo</option>
   			<option value="Cook Islands">Cook Islands</option>
   			<option value="Costa Rica">Costa Rica</option>
   			<option value="Cote DIvoire">Cote DIvoire</option>
   			<option value="Croatia">Croatia</option>
   			<option value="Cuba">Cuba</option>
   			<option value="Curaco">Curacao</option>
   			<option value="Cyprus">Cyprus</option>
   			<option value="Czech Republic">Czech Republic</option>
   			<option value="Denmark">Denmark</option>
   			<option value="Djibouti">Djibouti</option>
   			<option value="Dominica">Dominica</option>
   			<option value="Dominican Republic">Dominican Republic</option>
            <option value="East Timor">East Timor</option>
   			<option value="Ecuador">Ecuador</option>
   			<option value="Egypt">Egypt</option>
   			<option value="El Salvador">El Salvador</option>
   			<option value="Equatorial Guinea">Equatorial Guinea</option>
   			<option value="Eritrea">Eritrea</option>
   			<option value="Estonia">Estonia</option>
   			<option value="Ethiopia">Ethiopia</option>
   			<option value="Falkland Islands">Falkland Islands</option>
   			<option value="Faroe Islands">Faroe Islands</option>
   			<option value="Fiji">Fiji</option>
   			<option value="Finland">Finland</option>
   			<option value="France">France</option>
   			<option value="French Guiana">French Guiana</option>
   			<option value="French Polynesia">French Polynesia</option>
   			<option value="French Southern Ter">French Southern Ter</option>
   			<option value="Gabon">Gabon</option>
   			<option value="Gambia">Gambia</option>
   			<option value="Georgia">Georgia</option>
   			<option value="Germany">Germany</option>
   			<option value="Ghana">Ghana</option>
   			<option value="Gibraltar">Gibraltar</option>
   			<option value="Great Britain">Great Britain</option>
   			<option value="Greece">Greece</option>
   			<option value="Greenland">Greenland</option>
   			<option value="Grenada">Grenada</option>
   			<option value="Guadeloupe">Guadeloupe</option>
   			<option value="Guam">Guam</option>
   			<option value="Guatemala">Guatemala</option>
   			<option value="Guinea">Guinea</option>
   			<option value="Guyana">Guyana</option>
   			<option value="Haiti">Haiti</option>
   			<option value="Hawaii">Hawaii</option>
   			<option value="Honduras">Honduras</option>
   			<option value="Hong Kong">Hong Kong</option>
   			<option value="Hungary">Hungary</option>
   			<option value="Iceland">Iceland</option>
   			<option value="Indonesia">Indonesia</option>
   			<option value="India">India</option>
   			<option value="Iran">Iran</option>
   			<option value="Iraq">Iraq</option>
   			<option value="Ireland">Ireland</option>
   			<option value="Isle of Man">Isle of Man</option>
   			<option value="Israel">Israel</option>
   			<option value="Italy">Italy</option>
   			<option value="Jamaica">Jamaica</option>
   			<option value="Japan">Japan</option>
   			<option value="Jordan">Jordan</option>
   			<option value="Kazakhstan">Kazakhstan</option>
   			<option value="Kenya">Kenya</option>
   			<option value="Kiribati">Kiribati</option>
   			<option value="Korea North">Korea North</option>
            <option value="Korea Sout">Korea South</option>
            <option value="Kuwait">Kuwait</option>
            <option value="Kyrgyzstan">Kyrgyzstan</option>
            <option value="Laos">Laos</option>
            <option value="Latvia">Latvia</option>
            <option value="Lebanon">Lebanon</option>
            <option value="Lesotho">Lesotho</option>
            <option value="Liberia">Liberia</option>
            <option value="Libya">Libya</option>
            <option value="Liechtenstein">Liechtenstein</option>
            <option value="Lithuania">Lithuania</option>
            <option value="Luxembourg">Luxembourg</option>
            <option value="Macau">Macau</option>
            <option value="Macedonia">Macedonia</option>
            <option value="Madagascar">Madagascar</option>
            <option value="Malaysia">Malaysia</option>
            <option value="Malawi">Malawi</option>
            <option value="Maldives">Maldives</option>
            <option value="Mali">Mali</option>
            <option value="Malta">Malta</option>
            <option value="Marshall Islands">Marshall Islands</option>
            <option value="Martinique">Martinique</option>
            <option value="Mauritania">Mauritania</option>
            <option value="Mauritius">Mauritius</option>
            <option value="Mayotte">Mayotte</option>
            <option value="Mexico">Mexico</option>
            <option value="Midway Islands">Midway Islands</option>
            <option value="Moldova">Moldova</option>
            <option value="Monaco">Monaco</option>
            <option value="Mongolia">Mongolia</option>
            <option value="Montserrat">Montserrat</option>
            <option value="Morocco">Morocco</option>
            <option value="Mozambique">Mozambique</option>
            <option value="Myanmar">Myanmar</option>
            <option value="Nambia">Nambia</option>
            <option value="Nauru">Nauru</option>
            <option value="Nepal">Nepal</option>
            <option value="Netherland Antilles">Netherland Antilles</option>
            <option value="Netherlands">Netherlands (Holland, Europe)</option>
            <option value="Nevis">Nevis</option>
            <option value="New Caledonia">New Caledonia</option>
            <option value="New Zealand">New Zealand</option>
            <option value="Nicaragua">Nicaragua</option>
            <option value="Niger">Niger</option>
            <option value="Nigeria">Nigeria</option>
            <option value="Niue">Niue</option>
            <option value="Norfolk Island">Norfolk Island</option>
            <option value="Norway">Norway</option>
            <option value="Oman">Oman</option>
            <option value="Pakistan">Pakistan</option>
            <option value="Palau Island">Palau Island</option>
            <option value="Palestine">Palestine</option>
            <option value="Panama">Panama</option>
            <option value="Papua New Guinea">Papua New Guinea</option>
            <option value="Paraguay">Paraguay</option>
            <option value="Peru">Peru</option>
            <option value="Phillipines" selected="selected">Philippines</option>
            <option value="Pitcairn Island">Pitcairn Island</option>
            <option value="Poland">Poland</option>
            <option value="Portugal">Portugal</option>
            <option value="Puerto Rico">Puerto Rico</option>
            <option value="Qatar">Qatar</option>
            <option value="Republic of Montenegro">Republic of Montenegro</option>
            <option value="Republic of Serbia">Republic of Serbia</option>
            <option value="Reunion">Reunion</option>
            <option value="Romania">Romania</option>
            <option value="Russia">Russia</option>
            <option value="Rwanda">Rwanda</option>
            <option value="St Barthelemy">St Barthelemy</option>
            <option value="St Eustatius">St Eustatius</option>
            <option value="St Helena">St Helena</option>
            <option value="St Kitts-Nevis">St Kitts-Nevis</option>
            <option value="St Lucia">St Lucia</option>
            <option value="St Maarten">St Maarten</option>
            <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
            <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
            <option value="Saipan">Saipan</option>
            <option value="Samoa">Samoa</option>
            <option value="Samoa American">Samoa American</option>
            <option value="San Marino">San Marino</option>
            <option value="Sao Tome & Principe">Sao Tome & Principe</option>
            <option value="Saudi Arabia">Saudi Arabia</option>
            <option value="Senegal">Senegal</option>
            <option value="Seychelles">Seychelles</option>
            <option value="Sierra Leone">Sierra Leone</option>
            <option value="Singapore">Singapore</option>
            <option value="Slovakia">Slovakia</option>
            <option value="Slovenia">Slovenia</option>
            <option value="Solomon Islands">Solomon Islands</option>
            <option value="Somalia">Somalia</option>
            <option value="South Africa">South Africa</option>
            <option value="Spain">Spain</option>
            <option value="Sri Lanka">Sri Lanka</option>
            <option value="Sudan">Sudan</option>
            <option value="Suriname">Suriname</option>
            <option value="Swaziland">Swaziland</option>
            <option value="Sweden">Sweden</option>
            <option value="Switzerland">Switzerland</option>
            <option value="Syria">Syria</option>
            <option value="Tahiti">Tahiti</option>
            <option value="Taiwan">Taiwan</option>
            <option value="Tajikistan">Tajikistan</option>
            <option value="Tanzania">Tanzania</option>
            <option value="Thailand">Thailand</option>
            <option value="Togo">Togo</option>
            <option value="Tokelau">Tokelau</option>
            <option value="Tonga">Tonga</option>
            <option value="Trinidad & Tobago">Trinidad & Tobago</option>
            <option value="Tunisia">Tunisia</option>
            <option value="Turkey">Turkey</option>
            <option value="Turkmenistan">Turkmenistan</option>
            <option value="Turks & Caicos Is">Turks & Caicos Is</option>
            <option value="Tuvalu">Tuvalu</option>
            <option value="Uganda">Uganda</option>
            <option value="United Kingdom">United Kingdom</option>
            <option value="Ukraine">Ukraine</option>
            <option value="United Arab Erimates">United Arab Emirates</option>
            <option value="United States of America">United States of America</option>
            <option value="Uraguay">Uruguay</option>
            <option value="Uzbekistan">Uzbekistan</option>
            <option value="Vanuatu">Vanuatu</option>
            <option value="Vatican City State">Vatican City State</option>
            <option value="Venezuela">Venezuela</option>
            <option value="Vietnam">Vietnam</option>
            <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
            <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
            <option value="Wake Island">Wake Island</option>
            <option value="Wallis & Futana Is">Wallis & Futana Is</option>
            <option value="Yemen">Yemen</option>
            <option value="Zaire">Zaire</option>
            <option value="Zambia">Zambia</option>
            <option value="Zimbabwe">Zimbabwe</option>
         </select></p>
    </div>
    <p id="IsSameAddress">Is Current Address same as Permanent Address?
		<button onclick="CopyAddress(event);">YES</button>
		<button onclick="DisplayPermanent(event)">NO</button>
    </p>
    <div id="Permanent_Address" style="display: none;">
      <p class="h5 pt-3 pb-2">Permanent Address</p>
		<p><label for="Permanent_StreetAdd">Street Address: </label><input type="text" id = "Permanent_StreetAdd" name = "Permanent_StreetAdd"></p>
		<p><label for="Permanent_City">*City: </label><input type="text" id = "Permanent_City" name = "Permanent_City" required></p>
		<p><label for="Permanent_Province">*Province: </label><input type="text" id = "Permanent_Province" name= "Permanent_Province" required></p>
		<p><label for="Permanent_Country">Country: </label>
         <select id = "Permanent_Country" name = "Permanent_Country">
   			<option value="Afganistan">Afghanistan</option>
   			<option value="Albania">Albania</option>
   			<option value="Algeria">Algeria</option>
   			<option value="American Samoa">American Samoa</option>
   			<option value="Andorra">Andorra</option>
   			<option value="Angola">Angola</option>
   			<option value="Anguilla">Anguilla</option>
   			<option value="Antigua & Barbuda">Antigua & Barbuda</option>
   			<option value="Argentina">Argentina</option>
   			<option value="Armenia">Armenia</option>
   			<option value="Aruba">Aruba</option>
   			<option value="Australia">Australia</option>
   			<option value="Austria">Austria</option>
   			<option value="Azerbaijan">Azerbaijan</option>
   			<option value="Bahamas">Bahamas</option>
   			<option value="Bahrain">Bahrain</option>
   			<option value="Bangladesh">Bangladesh</option>
   			<option value="Barbados">Barbados</option>
   			<option value="Belarus">Belarus</option>
   			<option value="Belgium">Belgium</option>
   			<option value="Belize">Belize</option>
   			<option value="Benin">Benin</option>
   			<option value="Bermuda">Bermuda</option>
   			<option value="Bhutan">Bhutan</option>
   			<option value="Bolivia">Bolivia</option>
   			<option value="Bonaire">Bonaire</option>
   			<option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
   			<option value="Botswana">Botswana</option>
   			<option value="Brazil">Brazil</option>
   			<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
   			<option value="Brunei">Brunei</option>
   			<option value="Bulgaria">Bulgaria</option>
   			<option value="Burkina Faso">Burkina Faso</option>
   			<option value="Burundi">Burundi</option>
   			<option value="Cambodia">Cambodia</option>
   			<option value="Cameroon">Cameroon</option>
            <option value="Canada">Canada</option>
   			<option value="Canary Islands">Canary Islands</option>
   			<option value="Cape Verde">Cape Verde</option>
   			<option value="Cayman Islands">Cayman Islands</option>
   			<option value="Central African Republic">Central African Republic</option>
   			<option value="Chad">Chad</option>
   			<option value="Channel Islands">Channel Islands</option>
   			<option value="Chile">Chile</option>
   			<option value="China">China</option>
   			<option value="Christmas Island">Christmas Island</option>
   			<option value="Cocos Island">Cocos Island</option>
   			<option value="Colombia">Colombia</option>
   			<option value="Comoros">Comoros</option>
   			<option value="Congo">Congo</option>
   			<option value="Cook Islands">Cook Islands</option>
   			<option value="Costa Rica">Costa Rica</option>
   			<option value="Cote DIvoire">Cote DIvoire</option>
   			<option value="Croatia">Croatia</option>
   			<option value="Cuba">Cuba</option>
   			<option value="Curaco">Curacao</option>
   			<option value="Cyprus">Cyprus</option>
   			<option value="Czech Republic">Czech Republic</option>
   			<option value="Denmark">Denmark</option>
   			<option value="Djibouti">Djibouti</option>
   			<option value="Dominica">Dominica</option>
   			<option value="Dominican Republic">Dominican Republic</option>
            <option value="East Timor">East Timor</option>
   			<option value="Ecuador">Ecuador</option>
   			<option value="Egypt">Egypt</option>
   			<option value="El Salvador">El Salvador</option>
   			<option value="Equatorial Guinea">Equatorial Guinea</option>
   			<option value="Eritrea">Eritrea</option>
   			<option value="Estonia">Estonia</option>
   			<option value="Ethiopia">Ethiopia</option>
   			<option value="Falkland Islands">Falkland Islands</option>
   			<option value="Faroe Islands">Faroe Islands</option>
   			<option value="Fiji">Fiji</option>
   			<option value="Finland">Finland</option>
   			<option value="France">France</option>
   			<option value="French Guiana">French Guiana</option>
   			<option value="French Polynesia">French Polynesia</option>
   			<option value="French Southern Ter">French Southern Ter</option>
   			<option value="Gabon">Gabon</option>
   			<option value="Gambia">Gambia</option>
   			<option value="Georgia">Georgia</option>
   			<option value="Germany">Germany</option>
   			<option value="Ghana">Ghana</option>
   			<option value="Gibraltar">Gibraltar</option>
   			<option value="Great Britain">Great Britain</option>
   			<option value="Greece">Greece</option>
   			<option value="Greenland">Greenland</option>
   			<option value="Grenada">Grenada</option>
   			<option value="Guadeloupe">Guadeloupe</option>
   			<option value="Guam">Guam</option>
   			<option value="Guatemala">Guatemala</option>
   			<option value="Guinea">Guinea</option>
   			<option value="Guyana">Guyana</option>
   			<option value="Haiti">Haiti</option>
   			<option value="Hawaii">Hawaii</option>
   			<option value="Honduras">Honduras</option>
   			<option value="Hong Kong">Hong Kong</option>
   			<option value="Hungary">Hungary</option>
   			<option value="Iceland">Iceland</option>
   			<option value="Indonesia">Indonesia</option>
   			<option value="India">India</option>
   			<option value="Iran">Iran</option>
   			<option value="Iraq">Iraq</option>
   			<option value="Ireland">Ireland</option>
   			<option value="Isle of Man">Isle of Man</option>
   			<option value="Israel">Israel</option>
   			<option value="Italy">Italy</option>
   			<option value="Jamaica">Jamaica</option>
   			<option value="Japan">Japan</option>
   			<option value="Jordan">Jordan</option>
   			<option value="Kazakhstan">Kazakhstan</option>
   			<option value="Kenya">Kenya</option>
   			<option value="Kiribati">Kiribati</option>
   			<option value="Korea North">Korea North</option>
            <option value="Korea Sout">Korea South</option>
            <option value="Kuwait">Kuwait</option>
            <option value="Kyrgyzstan">Kyrgyzstan</option>
            <option value="Laos">Laos</option>
            <option value="Latvia">Latvia</option>
            <option value="Lebanon">Lebanon</option>
            <option value="Lesotho">Lesotho</option>
            <option value="Liberia">Liberia</option>
            <option value="Libya">Libya</option>
            <option value="Liechtenstein">Liechtenstein</option>
            <option value="Lithuania">Lithuania</option>
            <option value="Luxembourg">Luxembourg</option>
            <option value="Macau">Macau</option>
            <option value="Macedonia">Macedonia</option>
            <option value="Madagascar">Madagascar</option>
            <option value="Malaysia">Malaysia</option>
            <option value="Malawi">Malawi</option>
            <option value="Maldives">Maldives</option>
            <option value="Mali">Mali</option>
            <option value="Malta">Malta</option>
            <option value="Marshall Islands">Marshall Islands</option>
            <option value="Martinique">Martinique</option>
            <option value="Mauritania">Mauritania</option>
            <option value="Mauritius">Mauritius</option>
            <option value="Mayotte">Mayotte</option>
            <option value="Mexico">Mexico</option>
            <option value="Midway Islands">Midway Islands</option>
            <option value="Moldova">Moldova</option>
            <option value="Monaco">Monaco</option>
            <option value="Mongolia">Mongolia</option>
            <option value="Montserrat">Montserrat</option>
            <option value="Morocco">Morocco</option>
            <option value="Mozambique">Mozambique</option>
            <option value="Myanmar">Myanmar</option>
            <option value="Nambia">Nambia</option>
            <option value="Nauru">Nauru</option>
            <option value="Nepal">Nepal</option>
            <option value="Netherland Antilles">Netherland Antilles</option>
            <option value="Netherlands">Netherlands (Holland, Europe)</option>
            <option value="Nevis">Nevis</option>
            <option value="New Caledonia">New Caledonia</option>
            <option value="New Zealand">New Zealand</option>
            <option value="Nicaragua">Nicaragua</option>
            <option value="Niger">Niger</option>
            <option value="Nigeria">Nigeria</option>
            <option value="Niue">Niue</option>
            <option value="Norfolk Island">Norfolk Island</option>
            <option value="Norway">Norway</option>
            <option value="Oman">Oman</option>
            <option value="Pakistan">Pakistan</option>
            <option value="Palau Island">Palau Island</option>
            <option value="Palestine">Palestine</option>
            <option value="Panama">Panama</option>
            <option value="Papua New Guinea">Papua New Guinea</option>
            <option value="Paraguay">Paraguay</option>
            <option value="Peru">Peru</option>
            <option value="Phillipines" selected="selected">Philippines</option>
            <option value="Pitcairn Island">Pitcairn Island</option>
            <option value="Poland">Poland</option>
            <option value="Portugal">Portugal</option>
            <option value="Puerto Rico">Puerto Rico</option>
            <option value="Qatar">Qatar</option>
            <option value="Republic of Montenegro">Republic of Montenegro</option>
            <option value="Republic of Serbia">Republic of Serbia</option>
            <option value="Reunion">Reunion</option>
            <option value="Romania">Romania</option>
            <option value="Russia">Russia</option>
            <option value="Rwanda">Rwanda</option>
            <option value="St Barthelemy">St Barthelemy</option>
            <option value="St Eustatius">St Eustatius</option>
            <option value="St Helena">St Helena</option>
            <option value="St Kitts-Nevis">St Kitts-Nevis</option>
            <option value="St Lucia">St Lucia</option>
            <option value="St Maarten">St Maarten</option>
            <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
            <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
            <option value="Saipan">Saipan</option>
            <option value="Samoa">Samoa</option>
            <option value="Samoa American">Samoa American</option>
            <option value="San Marino">San Marino</option>
            <option value="Sao Tome & Principe">Sao Tome & Principe</option>
            <option value="Saudi Arabia">Saudi Arabia</option>
            <option value="Senegal">Senegal</option>
            <option value="Seychelles">Seychelles</option>
            <option value="Sierra Leone">Sierra Leone</option>
            <option value="Singapore">Singapore</option>
            <option value="Slovakia">Slovakia</option>
            <option value="Slovenia">Slovenia</option>
            <option value="Solomon Islands">Solomon Islands</option>
            <option value="Somalia">Somalia</option>
            <option value="South Africa">South Africa</option>
            <option value="Spain">Spain</option>
            <option value="Sri Lanka">Sri Lanka</option>
            <option value="Sudan">Sudan</option>
            <option value="Suriname">Suriname</option>
            <option value="Swaziland">Swaziland</option>
            <option value="Sweden">Sweden</option>
            <option value="Switzerland">Switzerland</option>
            <option value="Syria">Syria</option>
            <option value="Tahiti">Tahiti</option>
            <option value="Taiwan">Taiwan</option>
            <option value="Tajikistan">Tajikistan</option>
            <option value="Tanzania">Tanzania</option>
            <option value="Thailand">Thailand</option>
            <option value="Togo">Togo</option>
            <option value="Tokelau">Tokelau</option>
            <option value="Tonga">Tonga</option>
            <option value="Trinidad & Tobago">Trinidad & Tobago</option>
            <option value="Tunisia">Tunisia</option>
            <option value="Turkey">Turkey</option>
            <option value="Turkmenistan">Turkmenistan</option>
            <option value="Turks & Caicos Is">Turks & Caicos Is</option>
            <option value="Tuvalu">Tuvalu</option>
            <option value="Uganda">Uganda</option>
            <option value="United Kingdom">United Kingdom</option>
            <option value="Ukraine">Ukraine</option>
            <option value="United Arab Erimates">United Arab Emirates</option>
            <option value="United States of America">United States of America</option>
            <option value="Uraguay">Uruguay</option>
            <option value="Uzbekistan">Uzbekistan</option>
            <option value="Vanuatu">Vanuatu</option>
            <option value="Vatican City State">Vatican City State</option>
            <option value="Venezuela">Venezuela</option>
            <option value="Vietnam">Vietnam</option>
            <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
            <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
            <option value="Wake Island">Wake Island</option>
            <option value="Wallis & Futana Is">Wallis & Futana Is</option>
            <option value="Yemen">Yemen</option>
            <option value="Zaire">Zaire</option>
            <option value="Zambia">Zambia</option>
            <option value="Zimbabwe">Zimbabwe</option>
         </select></p>
    </div>
    <!--  -->
    <p class="h5 pt-3 pb-2">Contact Details</p>
    <p>
      <label for="LandlineNum">Landline No.: </label>
      <!-- <input type="tel" id = "LandlineNum" name = "LandlineNum" pattern="0{1}[2-9]{1}[0-9]{8}" placeholder="02-XXXX-XXXX for Metro Manila"> -->
      <input type="tel" id = "LandlineNum" name = "LandlineNum" minlength=6 maxlength=9 pattern="([0-9]{1,4}-[0-9]{4}|[0-3]{6})" onkeyup="if(!this.checkValidity()){
            this.reportValidity();
         }" placeholder="XXXX-XXXX">
   </p>
	<p>
      <label for="CellphoneNum">Cellphone No.: </label>
      <input type="tel" id = "CellphoneNum" name = "CellphoneNum" minlength=11 maxlength=13 pattern="([0]{1}[9]{1}[0-9]{9}|[+]{1}[6]{1}[3]{1}[9]{1}[0-9]{9})" onkeyup="if(!this.checkValidity()){
            this.reportValidity();
         }">
   </p>
	<p><label for="Email">Email Address: </label><input type="email" id = "Email" name = "Email"></p>
	<!--  -->
	<div style="margin-top: 1rem;">
	<p>
		<label for="Birthday">*Birthday</label>
		<input type="date" id = "Birthday" name = "Birthday" required onblur="if(!this.checkValidity()){
            this.reportValidity();
         }" />
	</p>
	<p>
		<label for="BirthPlace">*Place of Birth</label>
		<input type="text" id = "BirthPlace" name = "BirthPlace" required/>
	</p>
	<p>
		<label for="Gender">Gender</label>
		<select id="Gender">
			<option selected="selected">Male</option>
			<option>Female</option>
      	</select>
	</p>
	</div>

	<p class="h5 pb-2">Current School Information</p>
	<p>
		<label for="Present_SchoolName">*Present School Name</label>
		<input type="text" id = "Present_SchoolName" name = "Present_SchoolName" required/>
	</p>
	<p>
		<label for="Present_SchoolAddress">Present School Address</label>
		<input type="text" id = "Present_SchoolAddress" name = "Present_SchoolAddress"/></p>
	<p>
		<label for="Present_SchoolContact">Contact No.</label>
		<input type="text" id = "Present_SchoolContact" name = "Present_SchoolContact"/>
	</p>
	
   	</div>
	<div id="ParentSection" style="margin-top: 1.5rem">
		<h2 class="pt-3 pb-2"><b>PARENT/GUARDIAN'S SECTION</b></h2>
		<h4 class="pt-3 pb-2">Mother's Information</h4>
			<p>
				<label for="MotherName">Name:</label>
				<input type="text" id = "MotherName" name = "MotherName"/>
			</p>	
			<p>
				<label for="MotherContact">Contact No.:</label>
				<input type="tel" id = "MotherContact" name = "MotherContact" minlength="6" maxlength="13" pattern="([0]{1}[9]{1}[0-9]{9}|[+]{1}[0-9]{1}[0-9]{1}[9]{1}[0-9]{9}|[0-9]{1,4}-[0-9]{4}|[0-3]{6})" onkeyup="if(!this.checkValidity()){
            this.reportValidity();
         }"/>
			</p>
			<p>
				<label for="MotherEducation">Educational Attainment:</label>
				<input type="text" id = "MotherEducation" name = "MotherEducation"/>
			</p>
			<p>
				<label for="MotherOccupation">Occupation:</label>
				<input type="text" id = "MotherOccupation" name = "MotherOccupation"/>
			</p>	
		<h4 class="pt-3 pb-2">Father's Information</h4>
			<p>	
				<label for="FatherName">Name:</label>
				<input type="text" id = "FatherName" name = "FatherName"/>
			</p>
			<p>
				<label for="FatherContact">Contact No.:</label>
				<input type="tel" id = "FatherContact" name = "FatherContact" minlength="6" maxlength="13" pattern="([0]{1}[9]{1}[0-9]{9}|[+]{1}[0-9]{1}[0-9]{1}[9]{1}[0-9]{9}|[0-9]{1,4}-[0-9]{4}|[0-3]{6})" onkeyup="if(!this.checkValidity()){
            this.reportValidity();
         }"/>
			</p>	
			<p>
				<label for="FatherEducation">Educational Attainment:</label>
				<input type="text" id = "FatherEducation" name = "FatherEducation"/>
			</p>
			<p>
				<label for="FatherOccupation">Occupation:</label>
				<input type="text" id = "FatherOccupation" name = "FatherOccupation"/>
			</p>	
		<h4 class="pt-3 pb-2">Guardian's Information</h4>
			<p>
				<label for="GuardianName">Name:</label>
				<input type="text" id = "GuardianName" name = "GuardianName"/>
			</p>	
			<p>
				<label for="GuardianContact">Contact No.:</label>
				<input type="tel" id = "GuardianContact" name = "GuardianContact" minlength="6" maxlength="13" pattern="([0]{1}[9]{1}[0-9]{9}|[+]{1}[0-9]{1}[0-9]{1}[9]{1}[0-9]{9}|[0-9]{1,4}-[0-9]{4}|[0-3]{6})" onkeyup="if(!this.checkValidity()){
            this.reportValidity();
         }"/>
			</p>
			<p>
				<label for="GuardianRelationship">Relation to the Applicant:</label>
				<input type="text" id = "GuardianRelationship" name = "GuardianRelationship"/>
			</p>	
			<p>
				<label for="GuardianOccupation">Occupation:</label>
				<input type="text" id = "GuardianOccupation" name = "GuardianOccupation"/>
			</p>	
	</div>
	<div id= "DeclarationSection">
		
	</div>

	<div id= "ApplicationSection" style="margin-top: 1.5rem">
		<h2 class="pt-3 pb-2"><b>APPLICATION SECTION</b></h2>
		<h5 class="pt-3 pb-2">Submitted Requirements</h5>

		<p><input type="checkbox" name="FirstReq"/><label for="FirstReq">Accomplished Application Form</label></p>
		<p><input type="checkbox" name="SecondReq"/><label for="SecondReq">2 pcs 1.5" x 1.5" colored ID pictures(white background)</label></p>
		<p><input type="checkbox" name="ThirdReq"/><label for="ThirdReq">Recommendation letter by the school principal</label></p>
		<p><input type="checkbox" name="FourthReq"/><label for="FourthReq">Report Card(Form 138) -All grades in Science, Math, and English must not lower than 85%</label></p>
		<p style="margin-left: 15% !important;">in any grading period and no grades lower than 80% in all other subjects</p>
		<p style="margin-left: 15% !important;margin-top: 0.5rem !important;">Proof/s of Residency</p>
		<div style="margin-left: 15% !important">
			<p><input type="checkbox" name="FifthReq1"/><label for="FifthReq1">Billing Statement</label></p>
			<p><input type="checkbox" name="FifthReq2"/><label for="FifthReq2">Driver's License</label></p>
			<p><input type="checkbox" name="FifthReq3"/><label for="FifthReq3">Voter's ID</label></p>
		</div>
	</div>
	<p style="margin-bottom: 0%!important;">NOTE:</p>
	<p style="margin-left: 10% !important;">* - REQUIRED</p>
	<button class="rounded-pill" id = "submitForm" name = "submitForm" style="margin-bottom: 2% !important;">SUBMIT</button>
   </div>
</form>
<?php
include 'partials/footer.php';
?>

<script type="text/javascript">
   let Birthday = document.querySelector("#Birthday");
   // console.log(new Date());
   let dateToday = new Date();
   var dd = dateToday.getDate();
   var mm = dateToday.getMonth();
   if(mm/10 < 1){
      mm = '0'+mm;
   }
   if(dd/10 < 1){
      dd = '0'+dd;
   }
   // console.log(mm);
   var y = dateToday.getFullYear();

   var maxDate = (y-10) + '-'+ mm + '-' + dd;
   var minDate = (y-80) + '-'+ mm + '-' + dd;

   Birthday.value = maxDate;
   // Birthday.setAttributeNode("");
   Birthday.min = minDate;
   Birthday.max = maxDate;

   // Birthday.style.display = "none";

	let Permanent_Address = document.querySelector("#Permanent_Address");
	let input_permanent_address = document.querySelectorAll("#Permanent_Address input");
	let input_current_address = document.querySelectorAll("#Present_Address input");
	let select_permanent_address = document.querySelector("#Permanent_Address select");
	let select_current_address = document.querySelector("#Present_Address select");
	function CopyAddress(event){
		let ifblank = 0;
		event.preventDefault();
		// console.log(input_permanent_address);
		// console.log(input_current_address)
		for(let i = 0; i < input_current_address.length; i++){
			if(!input_current_address[i].checkValidity()){
				ifblank++;
				input_current_address[i].reportValidity();
			}
		}
		if(ifblank == 0){
			for(let i = 0; i < input_current_address.length; i++){
				input_permanent_address[i].value = input_current_address[i].value;
				let disabled = document.createAttribute('disabled');
				input_permanent_address[i].setAttributeNode(disabled);	
			}
			document.querySelector("#IsSameAddress").style.display = 'none';
			Permanent_Address.style.display = 'block';
		}

		let disabled = document.createAttribute('disabled')
		select_permanent_address.value = select_current_address.value;
		// select_permanent_address.options[select_permanent_address.selectedIndex].text = select_current_address.options[select_current_address.selectedIndex].text;
		select_permanent_address.setAttributeNode(disabled);
	}

	function DisplayPermanent(event){
		event.preventDefault();
		document.querySelector("#IsSameAddress").style.display = 'none';
		Permanent_Address.style.display = 'block';
	}
</script>
<script type="text/javascript" src="js/StudentRegistration.js"></script>