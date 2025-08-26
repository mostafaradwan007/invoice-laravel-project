<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New vendor - Bee Company</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --bee-yellow: #ffcc00;
            --bee-black: #1a1a1a;
            --bee-light-gray: #e5e7eb;
            --primary-blue: #3b82f6;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8fafc;
            margin: 0;
        }

        /* Main Content Area */
        .main-content {
            margin-left: 280px;
            margin-top: 70px;
            padding: 0;
            min-height: calc(100vh - 70px);
        }

        /* Breadcrumb */
        .breadcrumb-container {
            padding: 16px 24px;
            background: #f8fafc;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
            font-size: 14px;
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: ">";
            color: #6b7280;
            margin: 0 8px;
        }

        .breadcrumb-item a {
            color: #6b7280;
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: #1f2937;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 10px 12px;
            font-size: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 6px;
        }

        .container {
            padding-top: 30px;
            display: flex;
            gap: 20px;
            justify-content: space-between;
            align-items: flex-start;

        }


        .panel {
            background: white;
            padding: 20px;
            border-radius: 10px;
            flex: 1;
            min-width: 300px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .expense-total p {
            text-align: center;
            margin: 0%;
            padding-bottom: 10px;

        }

        .panel h3 {
            margin-bottom: 15px;
            font-weight: 50;
        }

        .panel label {
            display: block;
            margin-top: 10px;
            font-size: 14px;
            color: #333;
        }

        .panel input[type="text"],
        .panel input[type="date"],
        .panel select,
        .panel textarea {
            width: 100%;
            padding: 6px;
            margin-top: 4px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        textarea {
            height: 60px;
            resize: vertical;
        }

        .panel input[type="checkbox"] {
            margin-right: 8px;
        }

        .form-row {
            display: flex;
            align-items: center;
            margin-top: 10px;
            gap: 10px;
            /* spacing between label and select */
        }

        .form-row label {
            width: 200px;
            /* fixed width */
            margin: 0;
            font-size: 14px;
        }

        .form-row select,
        .form-row input {
            flex: 1;
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 5px;

            color: grey;

        }

        /*start buttons */
        .button-row {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;

        }

        .button-row button {
            width: 30%;
            color: black;
            background-color: #ffcc00;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            margin-top: 20px;
            margin-right: 10px;
        }

        .button-row button:hover {
            background-color: black;
            color: white;
        }

        /*end buttons */


        /* start close button */
        .close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 28px;
            cursor: pointer;
            color: #666;
        }


        .close:hover {
            color: #000;
        }

        /* end close button */


        .modal.hidden {
            display: none;
        }

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: inline-flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: white;
            padding: 30px;
            width: 90%;
            max-width: 500px;
            max-height: 90%;
            overflow-y: auto;
            border-radius: 10px;
            position: relative;
        }

        .modal-content1 {
            background: white;
            padding: 30px;
            width: 97%;
            max-width: 1200px;
            max-height: 98%;
            overflow-y: auto;
            border-radius: 10px;
            position: relative;
        }

        .modal-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px 20px;
            margin-top: 10px;
        }

        .modal h3 {
            margin-top: 0;
            margin-bottom: 20px;
            color: #1f2937;
        }

        .modal label {
            display: block;
            margin-bottom: 5px;
            margin-top: 15px;
            font-weight: 500;
            color: #374151;
        }

        .modal input,
        .modal textarea,
        .modal select {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .modal textarea {
            resize: vertical;
            min-height: 100px;
        }

        .modal .full-width {
            grid-column: span 2;
        }


        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 34px;
            width: 52px;

        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #ffcc00;
        }

        input:checked+.slider:before {
            transform: translateX(26px);
        }

        .slider.round {
            border-radius: 34px;
        }

        .right-column {
            display: flex;
            flex-direction: column;
            gap: 20px;
            flex: 1;
            min-width: 300px;
        }

        /* Form Actions */
        .form-actions {
            margin-top: 40px;
            padding-top: 24px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .btn-cancel {
            background-color: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-cancel:hover {
            background-color: #e5e7eb;
            color: #374151;
            text-decoration: none;
        }

        .btn-save {
            background-color: var(--primary-blue);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
        }

        .btn-save:hover {
            background-color: #ffcc00;
            ;
        }
    </style>


</head>

<body>
    <!-- Include header and sidebar -->


    @include('layouts.navbar')

    @include('layouts.sidebar')

    <div class="main-content">
        <!-- Breadcrumb -->
        <div class="breadcrumb-container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="./index.php"><i class="bi bi-house-door"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('recurring_expense.index') }}">Recurring Expenses</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">New Recurring Expenses</li>
                </ol>
            </nav>
        </div>
        <form action="{{ route('recurring_expense.store') }}" method="POST">
            <div class="container">

                @csrf
                <!-- Details Panel -->
                <div class="expense-total panel">
                    <p>Expense Total <span class="total">$0.00</span></p>

                    <div class="panel">
                        <h3>Details</h3>
                        <hr style="color:lightgray;">
                        <div class="form-row">
                            <!--vendor part-->
                            <label for="vendor" class="form-label">Vendor</label>
                            <select id="vendorSelect" class="form-control" name="vendor">
                                <option value="">-- Select Vendor --</option>
                                <option value="new">+ New Vendor</option>
                            </select>
                        </div>
                        <!-- Modal -->
                        <div class="modal hidden" id="vendorModal">
                            <div class="modal-content">
                                <span class="close" onclick="closevendorModal()">×</span>
                                <h3>New Vendor</h3>
                                <label>Name</label>
                                <input type="text" id="vendorName">
                                <label>Contact First Name</label>
                                <input type="text" id="vendorfirstname">
                                <label>Contact Last Name</label>
                                <input type="text" id="vendorlastname">
                                <label>Contact Email</label>
                                <input type="email" id="vendorEmail">
                                <label>Contact Phone</label>
                                <input type="tel" id="vendorphone">
                                <div class="button-row">
                                    <button type="button" onclick="openMoreFields(this)" data-url="#">More
                                        Info</button> <!--for vendor page-->
                                    <button type="button" id="save" onclick="savevendor()">Save</button>
                                </div>
                            </div>
                        </div>
                        <!--More info -->
                        <div class="modal hidden" id="moreFieldsModal">
                            <div class="modal-content1">
                                <span class="close" onclick="closeMoreFields()">×</span>
                                <h3>More Fields</h3>

                                <button type="button" onclick="closeMoreFields()">Done</button>
                            </div>
                        </div>
                        <!--end of vendor part-->
                        <!--start of client part-->
                       <div class="form-row">
    <label for="client" class="form-label">Client</label>
    <select id="clientSelect" class="form-control" name="client_id" required>
        <option value="">-- Select Client --</option>
        @foreach ($clients as $client)
            <option value="{{ $client->id }}">{{ $client->name }}</option>
        @endforeach
    </select>
</div>


                        <!--start of project part-->
                        <div class="form-row">
                            <label for="project" class="form-label">Project</label>
                            <select id="projectSelect" class="form-control" name=project>
                                <option value="">-- Select Project --</option>
                                <option value="new">+ New Project</option>
                            </select>
                        </div>
                        <div class="modal hidden" id="projectModal">
                            <div class="modal-content">
                                <span class="close" onclick="closeprojectModal()">×</span>
                                <h2>New Project</h2>
                                <div class="modal-grid">
                                    <div>
                                        <label>Project Name</label>
                                        <input type="text" id="projectName">
                                    </div>
                                    <div>

                                        <label for="client" class="form-label">Client</label>
                                        <select id="projectclientselect" class="form-control">
                                            <option value="">-- Select Client --</option>
                                            <option value="new">+ New Client</option>
                                        </select>
                                    </div>
                                    <div class="modal hidden" id="projectclientModal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeprojectclientModal()">×</span>
                                            <h3>New Client</h3>
                                            <label>Name</label>
                                            <input type="text" id="projectclientName">
                                            <label>Contact First Name</label>
                                            <input type="text" id="projectclientfirstname">
                                            <label>Contact Last Name</label>
                                            <input type="text" id="projectclientlastname">
                                            <label>Contact Email</label>
                                            <input type="email" id="projectclientEmail">
                                            <label>Contact Phone</label>
                                            <input type="tel" id="projectclientphone">
                                            <div class="button-row">
                                                <button type="button" onclick="openMoreFields(this)"
                                                    data-url="#">More Info</button>

                                                <button type="button" id="save"
                                                    onclick="saveprojectclient()">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--More info -->
                                    <div class="modal hidden" id="moreFieldsModal">
                                        <div class="modal-content1">
                                            <span class="close" onclick="closeMoreFields()">×</span>

                                            <button type="button" onclick="closeMoreFields()">Done</button>
                                        </div>
                                    </div>
                                    <!--end of client part-->
                                    <div>
                                        <label for="userSelect">User</label>
                                        <select id="userSelect" name="user">
                                            <option value="">-- User --</option>
                                            <option value="new">-- New User --</option>
                                        </select>

                                    </div>
                                    <div>
                                        <label>Due Date</label>
                                        <input type="date" id="dueDate">
                                    </div>
                                    <div>
                                        <label>Budgeted Hours</label>
                                        <input type="number" id="budgetedHours" value="0">
                                    </div>
                                    <div>
                                        <label>Task Rate</label>
                                        <input type="number" id="taskRate" value="0">
                                    </div>
                                    <div>
                                        <label>Public Notes</label>
                                        <textarea id="publicNotes"></textarea>
                                    </div>
                                    <div>
                                        <label>Private Notes</label>
                                        <textarea id="privateNotes"></textarea>
                                    </div>
                                </div>
                                <div class="button-row">
                                    <button type="button" onclick="saveproject()">Save</button>
                                </div>
                            </div>
                        </div>
                        <!--end of project part-->

                
                        <div class="form-row">
                            <label>Amount</label>
                            <input type="number" name="amount" required>
                        </div>

                        <div class="form-row">
                            <label>Date</label>
                            <input type="date" name="date" required>
                        </div>
                        <div class="form-row">
                            <label>Frequency</label>
                            <select name="frequency">
                                <option>Daily</option>
                                <option>Weekly</option>
                                <option>2 weeks</option>
                                <option>4 weeks</option>
                                <option>Monthly</option>
                                <option>2 Months</option>
                                <option>3 Months</option>
                                <option>4 Months</option>
                                <option>6 Months</option>
                                <option>Annualy</option>
                                <option>2 years</option>
                                <option>3 years</option>
                            </select>
                        </div>
                        <div class="form-row">
                            <label>Start Date</label>
                            <input type="date" name="start_date" required>
                        </div>
                        <div class="form-row">
                            <label>Remaining Cycles</label>
                            <select name="remaining_cycle">
                                <option>Endless</option>
                                <?php
                                for ($i = 0; $i <= 36; $i++) {
                                    echo "<option>$i</option>";
                                }
                                ?>
                            </select>

                        </div>
                    </div>
                </div>
                <!-- Notes Panel -->
                <div class="panel">
                    <h3>Notes</h3>
                    <hr style="color:lightgray;">
                    <label>Public Notes</label>
                    <textarea name="publicnotes"></textarea>
                    <label>Private Notes</label>
                    <textarea name="privatenotes"></textarea>
                </div>

                <!-- Additional Info Panel -->
                <div class="right-column">
                    <div class="panel">
                        <h3>Additional Info</h3>
                        <hr style="color:lightgray;">
                        <div class="form-row">
                            <label><b>Should Be Invoiced</b> <br><span style="color:grey;">Enable the expense to be
                                    invoiced</span></label>

                            <label class="switch">
                                <input type="checkbox">
                                <span class="slider round"></span>
                            </label>
                        </div>

                        <div class="form-row">
                            <label><b>Mark Paid
                                </b> <br><span style="color:grey;">Track the expense has been paid</span></label>

                            <label class="switch">
                                <input type="checkbox">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="form-row">
                            <label><b>Convert currency
                                </b> <br><span style="color:grey;">Set an exchange rate when creating an
                                    expense</span></label>

                            <label class="switch">
                                <input type="checkbox">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="form-row">
                            <label><b>Add Documents to Invoice
                                </b> <br><span style="color:grey;">Make the documents visible to vendor</span></label>

                            <label class="switch">
                                <input type="checkbox">
                                <span class="slider round"></span>
                            </label>
                        </div>


                    </div>
                    <div class="panel">
                        <div class="form-row">
                            <label><B>Item tax rates are disabled</B></label>
                            <a href="settings.php?tab=tax-settings" style="padding-left: 50px;">Settings</a>
                        </div>
                    </div>
                    <div class="form-actions">
                        <a href="{{ route('recurring_expense.index') }}" class="btn-cancel">Cancel</a>
                        <button type="submit" class="btn-save">Save Recurring Expense</button>
                    </div>


                </div>
            </div>
        </form>

    </div>


    <script>
        const colorInput = document.getElementById("categorycolor");
        const colorValue = document.getElementById("colorValue");

        colorInput.addEventListener("input", function() {
            colorValue.textContent = colorInput.value;
        });
    </script>

    <script>
        const vendorSelect = document.getElementById("vendorSelect");
        const vendorModal = document.getElementById("vendorModal");
        const clientSelect = document.getElementById("clientSelect");
        const clientModal = document.getElementById("clientModal");
        const categorySelect = document.getElementById("categorySelect");
        const categoryModal = document.getElementById("categoryModal");
        const projectSelect = document.getElementById("projectSelect");
        const projectModal = document.getElementById("projectModal");
        const projectclientselect = document.getElementById("projectclientselect");
        const projectclientModal = document.getElementById("projectclientModal");

        const moreFieldsModal = document.getElementById("moreFieldsModal");

        vendorSelect.addEventListener("change", function() {
            if (vendorSelect.value === "new") {
                vendorModal.classList.remove("hidden");
                vendorModal.style.display = "flex";
            }
        });
        clientSelect.addEventListener("change", function() {
            if (clientSelect.value === "new") {
                clientModal.classList.remove("hidden");
                clientModal.style.display = "flex";
            }
        });
        categorySelect.addEventListener("change", function() {
            if (categorySelect.value === "new") {
                categoryModal.classList.remove("hidden");
                categoryModal.style.display = "flex";
            }
        });

        projectSelect.addEventListener("change", function() {
            if (projectSelect.value === "new") {
                projectModal.classList.remove("hidden");
                projectModal.style.display = "flex";
            }
        });


        projectclientselect.addEventListener("change", function() {
            if (projectclientselect.value === "new") {
                projectclientModal.classList.remove("hidden");
                projectclientModal.style.display = "flex";
            }
        });





        function closevendorModal() {
            vendorModal.classList.add("hidden");
            vendorModal.style.display = "none";
            vendorSelect.value = "";
        }

        function closeclientModal() {
            clientModal.classList.add("hidden");
            clientModal.style.display = "none";
            clientSelect.value = "";
        }

        function closecategoryModal() {
            categoryModal.classList.add("hidden");
            categoryModal.style.display = "none";
            categorySelect.value = "";
        }

        function closeprojectModal() {
            projectModal.classList.add("hidden");
            projectModal.style.display = "none";
            projectSelect.value = "";
        }

        function closeprojectclientModal() {
            projectclientModal.classList.add("hidden");
            projectclientModal.style.display = "none";
            projectclientselect.value = "";
        }


        function savevendor() {
            const name = document.getElementById("vendorName").value;
            const email = document.getElementById("vendorEmail").value;

            if (name === "") {
                alert("Please enter a name.");
                return;
            }

            const option = document.createElement("option");
            option.value = name.toLowerCase().replace(/\s+/g, '-');
            option.textContent = name;
            vendorSelect.insertBefore(option, vendorSelect.lastElementChild); // Add before "New vendor"
            vendorSelect.value = option.value;

            closeModal();

            // Clear form fields
            document.getElementById("vendorName").value = "";
            document.getElementById("vendorEmail").value = "";
            document.getElementById("vendorfirstname").value = "";
            document.getElementById("vendorlastname").value = "";
            document.getElementById("vendorphone").value = "";
        }

        function saveclient() {
            const name = document.getElementById("clientName").value;
            const email = document.getElementById("clientEmail").value;

            if (name === "") {
                alert("Please enter a name.");
                return;
            }

            const option = document.createElement("option");
            option.value = name.toLowerCase().replace(/\s+/g, '-');
            option.textContent = name;
            clientSelect.insertBefore(option, clientSelect.lastElementChild); // Add before "New vendor"
            clientSelect.value = option.value;

            closeModal();

            // Clear form fields
            document.getElementById("clientName").value = "";
            document.getElementById("clientEmail").value = "";
            document.getElementById("clientfirstname").value = "";
            document.getElementById("clientlastname").value = "";
            document.getElementById("clientphone").value = "";
        }

        function savecategory() {
            const name = document.getElementById("categoryName").value;
            const email = document.getElementById("categorycolor").value;

            if (name === "") {
                alert("Please enter a name.");
                return;
            }

            const option = document.createElement("option");
            option.value = name.toLowerCase().replace(/\s+/g, '-');
            option.textContent = name;
            categorySelect.insertBefore(option, categorySelect.lastElementChild);
            categorySelect.value = option.value;

            closeModal();

            // Clear form fields
            document.getElementById("categoryName").value = "";
            document.getElementById("categorycolor").value = "";

        }

        function saveproject() {
            // Add saving logic here
            alert("Project saved.");
        }


        function openMoreFields(button) {
            const url = button.getAttribute("data-url");
            if (url) {
                window.location.href = url;
            }
        }

        function saveprojectclient() {
            const name = document.getElementById("projectclientName").value;
            if (name === "") {
                alert("Please enter a name.");
                return;
            }
            const option = document.createElement("option");
            option.value = name.toLowerCase().replace(/\s+/g, '-');
            option.textContent = name;
            projectclientselect.insertBefore(option, projectclientselect.lastElementChild);
            projectclientselect.value = option.value;
            closeprojectclientModal();
        }

        function closeMoreFields() {
            moreFieldsModal.classList.add("hidden");
            moreFieldsModal.style.display = "none";
        }

        // Close modal when clicking outside of it
        window.addEventListener('click', function(event) {
            if (event.target === vendorModal) {
                closevendorModal();
            }
            if (event.target === clientModal) {
                closeclientModal();
            }
            if (event.target === categoryModal) {
                closecategoryModal();
            }
            if (event.target === projectModal) {
                closeprojectModal();
            }
            if (event.target === projectclientModal) {
                closeprojectModal();
            }
            if (event.target === moreFieldsModal) {
                closeMoreFields();
            }
        });
        document.getElementById("userSelect").addEventListener("change", function() {
            if (this.value === "new") {
                window.location.href = "#";
            }
        });


    // Client dropdown functionality
    document.getElementById('client').addEventListener('click', function() {
      const dropdown = this.parentElement.querySelector('.client-dropdown-menu');
      dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
      const dropdown = document.querySelector('.client-dropdown-menu');
      const select = document.getElementById('client');
      if (!select.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.style.display = 'none';
      }
    });

    </script>
</body>

</html>
