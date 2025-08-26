<!-- Tabs -->
<div class="tabs">
    <div class="tab-list">
  <div class="tab active" onclick="showCompanyTab(event, 'details')">Details</div>
<div class="tab" onclick="showCompanyTab(event, 'address')">Address</div>


    </div>
</div>

<!-- Form Content -->
<div class="form-content">

    <form action="{{ route('companydetails.updateDetails') }}" method="POST">
            @csrf
            @method('PUT')
        <!-- Details Tab Content -->
        <div id="company-details-tab" class="tab-content active">
            <h4>Company Details</h4>
            <div class="form-row">
                <label for="company-name">Company Name</label>
                <input type="text" id="company-name" placeholder="Enter company name" name="companyname"
                    value="{{ old('companyname', $company->companyname ?? '') }}">
            </div>
            <div class="form-row">
                <label for="id-number">ID Number</label>
                <input type="text" id="id-number" placeholder="Enter ID number" name="IDnumber"
                    value="{{ old( 'IDnumber', $company->IDnumber ?? '') }}">
            </div>
            <div class="form-row">
                <label for="vat-number">VAT Number</label>
                <input type="text" id="vat-number" placeholder="Enter VAT number" name="VATnumber"
                    value="{{ old('VATnumber', $company->VATnumber ?? '') }}">
            </div>
            <div class="form-row">
                <label for="website">Website</label>
                <input type="url" id="website" placeholder="Enter website URL" name="website"
                    value="{{ old('website', $company->website ?? '') }}">
            </div>
            <div class="form-row">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Enter email address" name="email"
                    value="{{ old('email', $company->email ?? '') }}">
            </div>
            <div class="form-row">
                <label for="company-phone">Company Phone</label>
                <input type="tel" id="company-phone" placeholder="Enter phone number" name="companyPhone"
                    value="{{ old('companyPhone', $company->companyPhone ?? '') }}">
            </div>

            <div class="form-row">


                <label for="industry">Industry</label>
                <select id="industry" name="industry">
                    <option {{ old('industry', $company->industry ?? '') == 'Sports' ? 'selected' : '' }}>Sports</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Advertising' ? 'selected' : '' }}>Advertising</option>
                    <option {{ old('industry', $company->industry ?? '') == 'AeroSpace' ? 'selected' : '' }}>AeroSpace</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Agriculture' ? 'selected' : '' }}>Agriculture</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Automotive' ? 'selected' : '' }}>Automotive</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Banking & Finance' ? 'selected' : '' }}>Banking & Finance</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Biotechnology' ? 'selected' : '' }}>Biotechnology</option>
                    <option {{ old('industry', $company->industry ?? '') == 'BroadCasting' ? 'selected' : '' }}>BroadCasting</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Business Services' ? 'selected' : '' }}>Business Services</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Commodities & Chemicals' ? 'selected' : '' }}>Commodities & Chemicals</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Communications' ? 'selected' : '' }}>Communications</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Computers & Hightech' ? 'selected' : '' }}>Computers & Hightech</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Construction' ? 'selected' : '' }}>Construction</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Defense' ? 'selected' : '' }}>Defense</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Energy' ? 'selected' : '' }}>Energy</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Entertainment' ? 'selected' : '' }}>Entertainment</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Government' ? 'selected' : '' }}>Government</option>
                    <option {{ old('industry', $company->industry ?? '') == 'HealthCare & Life Sciences' ? 'selected' : '' }}>HealthCare & Life Sciences</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Insurance' ? 'selected' : '' }}>Insurance</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Manufacturing' ? 'selected' : '' }}>Manufacturing</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Media' ? 'selected' : '' }}>Media</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Non-Profit & Higher ED' ? 'selected' : '' }}>Non-Profit & Higher ED</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Pharmaceuticals' ? 'selected' : '' }}>Pharmaceuticals</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Photography' ? 'selected' : '' }}>Photography</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Professional Services & Consulting' ? 'selected' : '' }}>Professional Services & Consulting</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Real State' ? 'selected' : '' }}>Real State</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Restaurant & Catering' ? 'selected' : '' }}>Restaurant & Catering</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Retail & Wholesale' ? 'selected' : '' }}>Retail & Wholesale</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Sports' ? 'selected' : '' }}>Sports</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Transportation' ? 'selected' : '' }}>Transportation</option>
                    <option {{ old('industry', $company->industry ?? '') == 'Travel & Luxury' ? 'selected' : '' }}>Travel & Luxury</option>
                </select>
            </div>
            <div class="form-row">
                <label for="classification">Classification</label>
                <select id="classification" name="classification">
                    <option {{ old('classification', $company->classification ?? '') == 'Individual' ? 'selected' : '' }}>Individual</option>
                    <option {{ old('classification', $company->classification ?? '') == 'Business' ? 'selected' : '' }}>Business</option>
                    <option {{ old('classification', $company->classification ?? '') == 'Company' ? 'selected' : '' }}>Company</option>
                    <option {{ old('classification', $company->classification ?? '') == 'PartnerShip' ? 'selected' : '' }}>PartnerShip</option>
                    <option {{ old('classification', $company->classification ?? '') == 'Trust' ? 'selected' : '' }}>Trust</option>
                    <option {{ old('classification', $company->classification ?? '') == 'Charity' ? 'selected' : '' }}>Charity</option>
                    <option {{ old('classification', $company->classification ?? '') == 'Government' ? 'selected' : '' }}>Government</option>
                    <option {{ old('classification', $company->classification ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div class="form-actions">
                <a href="{{ route('settings.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-save">Save</button>
            </div>
        </div>

    </form>

   <form action="{{ route('companydetails.updateAddress') }}" method="POST">
            @csrf
            @method('PUT')
        <!-- Address Tab Content -->
        <div id="company-address-tab" class="tab-content">
            <h4>Address</h4>
            <div class="form-row">
                <label for="street-address">Street Address</label>
                <input type="text" id="street-address" placeholder="Enter street address" name="street_address"
                    value="{{ old('street_address', $company->street_address ?? '') }}">
            </div>
            <div class="form-row">
                <label for="apt">Apt/Suite</label>
                <input type="text" id="apt" placeholder="Enter apartment or suite number" name="apt_suite"
                    value="{{ old('apt_suite', $company->apt_suite ?? '') }}">
            </div>
            <div class="form-row">
                <label for="city">City</label>
                <input type="text" id="city" placeholder="Enter city" name="city"
                    value="{{ old('city', $company->city ?? '') }}">
            </div>
            <div class="form-row">
                <label for="state">State/Province</label>
                <input type="text" id="state" placeholder="Enter state or province" name="state_province"
                    value="{{ old('state_province', $company->state_province ?? '') }}">
            </div>
            <div class="form-row">
                <label for="postal-code">Postal Code</label>
                <input type="text" id="postal-code" placeholder="Enter postal code" name="postal_code"
                    value="{{ old('postal_code', $company->postal_code ?? '') }}">
            </div>
            <div class="form-actions">
                <a href="{{ route('settings.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-save">Save</button>
            </div>
        </div>


    </form>


</div>
<script src="../buttonchange.js"></script>
<script>
function showCompanyTab(e, tabName) {
    // Hide all tab content
    const allTabContent = document.querySelectorAll('.tab-content');
    allTabContent.forEach(content => content.classList.remove('active'));

    // Show selected tab content
    const targetTab = document.getElementById('company-' + tabName + '-tab');
    if (targetTab) targetTab.classList.add('active');

    // Update tab active state
    const allTabs = document.querySelectorAll('.tab');
    allTabs.forEach(tab => tab.classList.remove('active'));
    e.target.classList.add('active'); // <-- now event is defined
}

</script>
