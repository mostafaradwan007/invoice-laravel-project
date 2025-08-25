<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<style>
    .address-bar {
        display: flex;
        align-items: center;
        background: #fff;
        border: 0.5px solid grey;
        border-radius: 6px;
        padding: 5px 10px;
        width: 52px;
        text-decoration: none;
        color: black;
        text-align: center;

    }

    .address-bar img {
        width: 30px;
        height: 30px;
        margin-right: 8px;

    }
</style>
<!-- Tabs -->
<div class="tabs">
    <div class="tab-list">
        <div class="tab active" onclick="showuserTab('details')">Details</div>
        <div class="tab" onclick="showuserTab('password')">password</div>
        <div class="tab" onclick="showuserTab('OAuth/Mail')">OAuth/Mail</div>
        <!-- <div class="tab" onclick="showuserTab('accentcolor')">accentcolor</div> -->
      
    </div>
</div>


<!-- Form Content -->
<div class="form-content">

    <form action="{{ route('userdetails.store') }}" method="POST">
        @csrf
        <!-- Details Tab Content -->
        <div id="user-details-tab" class="tab-content active">
            <h4>Details</h4>
            <div class="form-row">
                <label for="Firstname">First Name</label>
                <input type="text" id="Firstname" placeholder="Enter first name" name="firstname"
                    value="{{ old('firstname', $userr->firstname ?? '') }}"v>
            </div>
            <div class="form-row">
                <label for="Lastname">Last Name</label>
                <input type="text" id="Lastname" placeholder="Enter last name" name="lastname"
                    value="{{ old('lastname', $userr->lastname ?? '') }}">
            </div>
            <div class="form-row">
                <label for="email">Email</label>
                <input type="text" id="email" placeholder="Enter email" name="email"
                    value="{{ old('email', $userr->email ?? '') }}">
            </div>
            <div class="form-row">
                <label for="phone">Phone</label>
                <input type="text" id="phone" placeholder="Enter phone" name="phone"
                    value="{{ old('phone', $userr->phone ?? '') }}">
            </div>
            <div class="form-actions">
                <a href="{{ route('settings.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-save">Save</button>
            </div>
        </div>

    </form>

    <!--need to be connected to user info from login-->
    <form action="{{ route('userdetails.store') }}" method="POST">
        @csrf
        <!-- password Tab Content -->
        <div id="user-password-tab" class="tab-content">
            <h4>Password</h4>
            <div class="form-row">
                <label for="password">New Password</label>
                <input type="password" id="password" placeholder="Enter New Password" name="password"
                    value="{{ old('password', $userr->password ?? '') }}">
                <i id="toggleIcon" class="fa-solid fa-eye" onclick="togglePassword()" style="cursor:pointer"></i>

            </div>
            <div class="form-actions">
                <a href="{{ route('settings.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-save">Save</button>
            </div>

        </div>
    </form>


    <!-- OAuth / Mail Tab Content -->

    <div id="user-OAuth/Mail-tab" class="tab-content">
        <h4>Connected Account</h4>
        <div class="form-row">
            <label>Google</label>
            <a href="https://www.google.com" target="_blank" class="address-bar">
                <img src="https://www.google.com/favicon.ico" alt="Google Icon">

            </a>
        </div>
        <div class="form-row">
            <label>Microsoft</label>
            <a href="https://www.microsofrcom" target="_blank" class="address-bar">
                <img src="https://www.microsoft.com/favicon.ico" alt="microsoft Icon">

            </a>
        </div>

    </div>

    <!-- <div id="user-accentcolor-tab" class="tab-content">
            <h4>Accent Color</h4>
            <label for="colorPicker">Choose Accent Color:</label>
            <input type="color" id="colorPicker" value="#3b82f6">
            <div class="current-color" id="currentColor">
                Current Color: <span id="colorValue">#3b82f6</span>
            </div>
        </div> -->


</div>

<script>
    function showuserTab(tabName) {
        // Hide all tab content
        const allTabContent = document.querySelectorAll('.tab-content');
        allTabContent.forEach(content => content.classList.remove('active'));

        // Show selected tab content
        const targetTab = document.getElementById('user-' + tabName + '-tab');
        if (targetTab) {
            targetTab.classList.add('active');
        }

        // Update tab active state
        const allTabs = document.querySelectorAll('.tab');
        allTabs.forEach(tab => tab.classList.remove('active'));
        event.target.classList.add('active');
    }

    //for eye password
    function togglePassword() {
        const password = document.getElementById("password");
        const icon = document.getElementById("toggleIcon");

        if (password.type === "password") {
            password.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            password.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>
