<!-- Tabs -->
<div class="tabs">
    <div class="tab-list">

        <div class="tab active" onclick="showAccountTab('overview', event)">Overview</div>
        <div class="tab" onclick="showAccountTab('EnabledModules', event)">Enabled Modules</div>
        <div class="tab" onclick="showAccountTab('security', event)">Security</div>
        <div class="tab" onclick="showAccountTab('danger', event)">Danger Zone</div>

    </div>
</div>

<!-- Form Content -->
<div class="form-content">
    <form method="POST" action="{{ route('accountmanagment.store') }}">
        @csrf

        <!-- Overview Tab Content -->
        <div id="account-overview-tab" class="tab-content active">
            <h4>Overview</h4>
            <div class="form-row">
                <label for="account-name">Activate Company<br><span style="color: gray;">Enable emails, recurring
                        invoices
                        and notifications</span></label>
                <label class="switch">
                    <input type="hidden" name="activate_company" value="No">
                    <input type="checkbox" name="activate_company" value="Yes"
                        {{ isset($accountmanagment) && $accountmanagment->activate_company === 'Yes' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="form-row">
                <label for="account-status">Enable MarkDown<br><span style="color: gray;">Convert markdown to HTML on
                        the
                        PDF</span></label>
                <label class="switch">
                    <input type="hidden" name="enable_markdown" value="No">
                    <input type="checkbox" name="enable_markdown" value="Yes"
                        {{ isset($accountmanagment) && $accountmanagment->enable_markdown === 'Yes' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="form-row">
                <label for="account-created">Include Drafts<Br> <span style="color: gray;">Include draft records in
                        reports</span></label>
                <label class="switch">
                    <input type="hidden" name="include_drafts" value="No">
                    <input type="checkbox" name="include_drafts" value="Yes"
                        {{ isset($accountmanagment) && $accountmanagment->include_drafts === 'Yes' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="form-actions">
                <a href="{{ route('settings.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-save">Save</button>
            </div>
        </div>
    </form>


    <form method="POST" action="{{ route('accountmanagment.index') }}">
        @csrf

        <!-- Enabled Modules Tab Content -->
        <div id="account-EnabledModules-tab" class="tab-content">
            <h4>Enabled Modules</h4>
            <hr style="color:lightgray;">
            <div class="form-row">
                <label for="account-name">Invoices</label>
                <label class="switch">
                    <input type="hidden" name="invoices" value="No">
                    <input type="checkbox" name="invoices" value="Yes"
                        {{ isset($accountmanagment) && $accountmanagment->invoices === 'Yes' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="form-row">
                <label for="account-status">Recuring Invoices</label>
                <label class="switch">
                    <input type="hidden" name="recurring_invoices" value="No">
                    <input type="checkbox" name="recurring_invoices" value="Yes"
                        {{ isset($accountmanagment) && $accountmanagment->recurring_invoices === 'Yes' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="form-row">
                <label for="account-created">Quotes</label>
                <label class="switch">
                    <input type="hidden" name="quotes" value="No">
                    <input type="checkbox" name="quotes" value="Yes"
                        {{ isset($accountmanagment) && $accountmanagment->quotes === 'Yes' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="form-row">
                <label for="account-name">Credits</label>
                <label class="switch">
                    <input type="hidden" name="credits" value="No">
                    <input type="checkbox" name="credits" value="Yes"
                        {{ isset($accountmanagment) && $accountmanagment->credits === 'Yes' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="form-row">
                <label for="account-status">Projects</label>
                <label class="switch">
                    <input type="hidden" name="projects" value="No">
                    <input type="checkbox" name="projects" value="Yes"
                        {{ isset($accountmanagment) && $accountmanagment->projects === 'Yes' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="form-row">
                <label for="account-created">Tasks</label>
                <label class="switch">
                    <input type="hidden" name="tasks" value="No">
                    <input type="checkbox" name="tasks" value="Yes"
                        {{ isset($accountmanagment) && $accountmanagment->tasks === 'Yes' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>

            <div class="form-row">
                <label for="account-created">Vendors</label>
                <label class="switch">
                    <input type="hidden" name="vendors" value="No">
                    <input type="checkbox" name="vendors" value="Yes"
                        {{ isset($accountmanagment) && $accountmanagment->vendors === 'Yes' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>


            <div class="form-row">
                <label for="account-created">Expenses</label>
                <label class="switch">
                    <input type="hidden" name="expenses" value="No">
                    <input type="checkbox" name="expenses" value="Yes"
                        {{ isset($accountmanagment) && $accountmanagment->expenses === 'Yes' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>


            <div class="form-row">
                <label for="account-created">Purchase Orders</label>
                <label class="switch">
                    <input type="hidden" name="purchase_orders" value="No">
                    <input type="checkbox" name="purchase_orders" value="Yes"
                        {{ isset($accountmanagment) && $accountmanagment->purchase_orders === 'Yes' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>


            <div class="form-row">
                <label for="account-created">Recurring Expenses</label>
                <label class="switch">
                    <input type="hidden" name="recurring_expenses" value="No">
                    <input type="checkbox" name="recurring_expenses" value="Yes"
                        {{ isset($accountmanagment) && $accountmanagment->recurring_expenses === 'Yes' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>


            <div class="form-row">
                <label for="account-created">Transactions</label>
                <label class="switch">
                    <input type="hidden" name="transactions" value="No">
                    <input type="checkbox" name="transactions" value="Yes"
                        {{ isset($accountmanagment) && $accountmanagment->transactions === 'Yes' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="form-actions">
                <a href="{{ route('settings.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-save">Save Changes</button>
            </div>


        </div>
    </form>

    <!-- Security Tab Content -->
    <div id="account-security-tab" class="tab-content">
        <h4>Security Settings</h4>

        <div class="form-row">
            <label>End All Sessions <br><span style="color: gray;">Logs out all users and requires all active users
                    to
                    reauthenticate.</span></label>
            <label class="logoutbutton">
                <input type="button" id="logout" class="logout-btn" value="Logout" onclick="handleLogout()">
            </label>

        </div>

    </div>


    <!-- Danger Zone Tab Content -->
    <div id="account-danger-tab" class="tab-content">
        <h4>Danger Zone</h4>
        <div class="danger-zone">
            <div class="danger-item">
                <div class="danger-info">
                    <h5>Delete Account</h5>
                    <p>Permanently delete your account and all associated data</p>
                </div>
                <form  id="deleteAccountForm"  action="{{ route('accountmanagment.destroy') }}" method="POST" >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete My Account</button>
                </form>




            </div>
        </div>
    </div>


</div>

<style>
    .current-plan {
        background: #f0f9ff;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #0ea5e9;
        margin-bottom: 20px;
    }

    .plan-features ul {
        list-style: none;
        padding: 0;
        margin: 15px 0 0 0;
    }

    .plan-features li {
        padding: 5px 0;
        color: #22c55e;
    }


    .plan-actions {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    .btn-upgrade,
    .btn-downgrade {
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
    }

    .btn-upgrade {
        background-color: var(--primary-blue);
        color: white;
    }

    .btn-upgrade:hover {
        background-color: #ffcc00;
    }

    .btn-downgrade {
        background-color: #f3f4f6;
        color: #374151;
        border: 1px solid #d1d5db;
    }



    .logout-btn {
        background-color: var(--primary-blue);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .logout-btn:hover {
        background-color: #ffcc00;
    }




    .danger-zone {
        border: 1px solid #fecaca;
        border-radius: 8px;
        overflow: hidden;
    }

    .danger-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid #fecaca;
    }

    .danger-item:last-child {
        border-bottom: none;
    }

    .danger-info h5 {
        margin: 0 0 5px 0;
        color: #dc2626;
    }

    .danger-info p {
        margin: 0;
        color: #6b7280;
    }

    .btn-danger {
        background-color: #dc2626;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
    }
</style>

<script>
    function showAccountTab(tabName, event) {
        // Hide all tab content
        const allTabContent = document.querySelectorAll('.tab-content');
        allTabContent.forEach(content => content.classList.remove('active'));

        // Show selected tab
        const targetTab = document.getElementById('account-' + tabName + '-tab');
        if (targetTab) targetTab.classList.add('active');

        // Update active tab state
        const allTabs = document.querySelectorAll('.tab');
        allTabs.forEach(tab => tab.classList.remove('active'));
        event.target.classList.add('active');
    }
</script>
<script>
    function handleLogout() {
        alert('Logout clicked!');
        // Add your logout logic here
    }
</script>

<script>
    //for delete account button
document.getElementById('deleteAccountForm').addEventListener('submit', function(e) {
    if (!confirm("⚠️ Are you sure you want to delete this account?")) {
        e.preventDefault(); // stop form submission
    }
});
</script>
