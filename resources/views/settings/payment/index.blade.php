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

<div class="tabs">
    <div class="tab-list">

        <div class="tab active" onclick="showTab('payment-settings')">Payment Settings</div>

    </div>
</div>
<!-- Payment Settings Tab -->
<div id="payment-settings" class="form-content tab-content active">

    <h4>Auto Bill Settings</h4>
    <br>
    <form action="{{ route('payment.store') }}" method="POST">
        @csrf
        <div class="form-row">
            <label>Auto Bill Standard Invoices <br><span style="color: gray;">Auto bill standard invoices on the due
                    date</span></label>
            <label class="switch">
                <input type="hidden" name="standard_invoices" value="No">
                <input type="checkbox"  name="standard_invoices" value="Yes"
                    {{ isset($payment) && $payment->standard_invoices === 'Yes' ? 'checked' : '' }}>
                <span class="slider round"></span>
            </label>
        </div>
        <br>
        <div class="fomr-row">
            <label>Auto Bill Recurring Invoices<br><span style="color: gray;">Disabled (Option is not
                    shown)</span></label>
            <label class="switch">
                <input type="hidden" name="recurring_invoices" value="No">
                <input type="checkbox"  name="recurring_invoices" value="Yes"
                    {{ isset($payment) && $payment->recurring_invoices === 'Yes' ? 'checked' : '' }}>
                <span class="slider round"></span>
            </label>
        </div>


        <div class="form-row">
            <label>Auto Bill On <br><span style="color: #6b7280; font-size: 13px;">Auto bill on send date OR due date
                    (recurring invoices)</span></label>
            <select class="form-select" name="auto_bill_on">
                <option value="Send Date"
                    {{ old('auto_bill_on', optional($payment)->auto_bill_on) == 'Send Date' ? 'selected' : '' }}>Send Date</option>
                <option value="Due Date"
                    {{ old('auto_bill_on', optional($payment)->auto_bill_on) == 'Due Date' ? 'selected' : '' }}>Due Date
                </option>

            </select>
        </div>

        <div class="form-row">
            <label>Use Available Credits <br><span style="color: gray;">Apply any credit balances to payments prior to
                    charging a payment method</span></label>
            <label class="switch">
                <input type="hidden" name="use_available_credits" value="No">
                <input type="checkbox"  name="use_available_credits" value="Yes"
                    {{ isset($payment) && $payment->use_available_credits === 'Yes' ? 'checked' : '' }}>
                <span class="slider round"></span>
            </label>
        </div>

        <div class="form-row">

            <label>Use Unapplied Payments <br><span style="color: gray;">Apply any payment balances prior to charging a
                    payment method</span></label>
            <label class="switch">
                <input type="hidden" name="use_unapplied_payments" value="No">
                <input type="checkbox"  name="use_unapplied_payments" value="Yes"
                    {{ isset($payment) && $payment->use_unapplied_payments === 'Yes' ? 'checked' : '' }}>
                <span class="slider round"></span>
            </label>
        </div>

        <hr style="color: gray;">

        <div class="form-row">
            <label>Payment Type <span style="color: gray;">The default payment type to be used for
                    payments</span></label>
            <select class="form-select" name="payment_type">
                <option value="Cash"
                    {{ old('payment_type', optional($payment)->payment_type) == 'Cash' ? 'selected' : '' }}>Cash
                </option>
                <option value="Check"
                    {{ old('payment_type', optional($payment)->payment_type) == 'Check' ? 'selected' : '' }}>Check
                </option>
                <option value="Credit Card"
                    {{ old('payment_type', optional($payment)->payment_type) == 'Credit Card' ? 'selected' : '' }}>
                    Credit Card</option>
                <option value="Bank Transfer"
                    {{ old('payment_type', optional($payment)->payment_type) == 'Bank Transfer' ? 'selected' : '' }}>
                    Bank Transfer</option>
                <option value="Other"
                    {{ old('payment_type', optional($payment)->payment_type) == 'Other' ? 'selected' : '' }}>Other
                </option>
                <option value="PayPal"
                    {{ old('payment_type', optional($payment)->payment_type) == 'PayPal' ? 'selected' : '' }}>PayPal
                </option>

            </select>

        </div>

        <div class="form-row">
            <label>Quote Valid Until <span style="color: gray;">The number of days that the quote is valid
                    for</span></label>
            <input type="number" class="form-input" placeholder="30" min="1" name="quote_valid_until"
                value="{{ old('quote_valid_until', $payment->quote_valid_until ?? '') }}">
        </div>

        <div class="form-row">
            <label>Expense Payment Type <span style="color: gray;">The default payment payment type to be
                    used</span></label>
            <select class="form-select" name="expense_payment_type">
                <option value="Cash"
                    {{ old('expense_payment_type', optional($payment)->expense_payment_type) == 'Cash' ? 'selected' : '' }}>
                    Cash</option>
                <option value="Check"
                    {{ old('expense_payment_type', optional($payment)->expense_payment_type) == 'Check' ? 'selected' : '' }}>
                    Check</option>
                <option value="Credit Card"
                    {{ old('expense_payment_type', optional($payment)->expense_payment_type) == 'Credit Card' ? 'selected' : '' }}>
                    Credit Card</option>
                <option value="Bank Transfer"
                    {{ old('expense_payment_type', optional($payment)->expense_payment_type) == 'Bank Transfer' ? 'selected' : '' }}>
                    Bank Transfer</option>
                <option value="Other"
                    {{ old('expense_payment_type', optional($payment)->expense_payment_type) == 'Other' ? 'selected' : '' }}>
                    Other</option>
            </select>
        </div>


        <div class="form-row">

            <label>Manual Payment Email <span style="color: gray;">Send an email when manually entering a
                    payment</span></label>
            <label class="switch">
                <input type="hidden" name="manual_payment_email" value="No">
                <input type="checkbox"  name="manual_payment_email" value="Yes"
                    {{ isset($payment) && $payment->manual_payment_email === 'Yes' ? 'checked' : '' }}>
                <span class="slider round"></span>
            </label>
        </div>

        <div class="form-row">

            <label>Online Payment Email <span style="color: gray;">Send an email when an online payment is
                    made</span></label>

            <label class="switch">
                <input type="hidden" name="online_payment_email" value="No">
                <input type="checkbox"  name="online_payment_email" value="Yes"
                    {{ isset($payment) && $payment->online_payment_email === 'Yes' ? 'checked' : '' }}>
                <span class="slider round"></span>
            </label>
        </div>

        <div class="form-row">

            <label>Mark Paid Payment Email <span style="color: gray;">Send an email when marking an invoice as
                    paid</span></label>

            <label class="switch">
                <input type="hidden" name="mark_paid_payment_email" value="No">
                <input type="checkbox"  name="mark_paid_payment_email" value="Yes"
                    {{ isset($payment) && $payment->mark_paid_payment_email === 'Yes' ? 'checked' : '' }}>
                <span class="slider round"></span>
            </label>
        </div>

        <div class="form-row">

            <label>Payment Email To All Contacts <span style="color: gray;">Sends the payment email to all contacts
                    when
                    enabled</span></label>

            <label class="switch">
                <input type="hidden" name="payment_email_to_all_contacts" value="No">
                <input type="checkbox"  name="payment_email_to_all_contacts" value="Yes"
                    {{ isset($payment) && $payment->payment_email_to_all_contacts === 'Yes' ? 'checked' : '' }}>
                <span class="slider round"></span>
            </label>
        </div>


        <div class="form-row">

            <label>Manual Overpayments <span style="color: gray;">Support adding an overpayment amount manually on a
                    payment</span></label>


            <label class="switch">
                <input type="hidden" name="manual_overpayments" value="No">
                <input type="checkbox"  name="manual_overpayments" value="Yes"
                    {{ isset($payment) && $payment->manual_overpayments === 'Yes' ? 'checked' : '' }}>
                <span class="slider round"></span>
            </label>
        </div>

        <div class="form-row">

            <label>Allow Overpayment <span style="color: gray;">Support paying extra to accept tips</span></label>

            <label class="switch">
                <input type="hidden" name="allow_overpayment" value="No">
                <input type="checkbox"  name="allow_overpayment" value="Yes"
                    {{ isset($payment) && $payment->allow_overpayment === 'Yes' ? 'checked' : '' }}>
                <span class="slider round"></span>
            </label>
        </div>

        <div class="form-row">

            <label>Allow Underpayment <span style="color: gray;">Support paying at minimum the partial/deposit
                    amount</span></label>

            <label class="switch">
                <input type="hidden" name="allow_underpayment" value="No">
                <input type="checkbox"  name="allow_underpayment" value="Yes"
                    {{ isset($payment) && $payment->allow_underpayment === 'Yes' ? 'checked' : '' }}>
                <span class="slider round"></span>
            </label>
        </div>

        <div class="form-row">

            <label>Client Initiated Payments <span style="color: gray;">Support making a payment in the client portal
                    without an invoice</span></label>

            <label class="switch">
                <input type="hidden" name="client_initiated_payments" value="No">
                <input type="checkbox"  name="client_initiated_payments" value="Yes"
                    {{ isset($payment) && $payment->client_initiated_payments === 'Yes' ? 'checked' : '' }}>
                <span class="slider round"></span>
            </label>
        </div>

        <div class="form-row">

            <label>One-Page Checkout <span style="color: gray;">Enable the new single page payment flow</span></label>

            <label class="switch">
                <input type="hidden" name="one_page_checkout" value="No">
                <input type="checkbox"  name="one_page_checkout" value="Yes"
                    {{ isset($payment) && $payment->one_page_checkout === 'Yes' ? 'checked' : '' }}>
                <span class="slider round"></span>
            </label>
        </div>

        <div class="form-row">

            <label>Unlock Documents After Payment <span style="color: gray;">Allows client access to invoice documents
                    when
                    an invoice has been paid</span></label>

            <label class="switch">
                <input type="hidden" name="unlock_documents" value="No">
                <input type="checkbox"  name="unlock_documents" value="Yes"
                    {{ isset($payment) && $payment->unlock_documents === 'Yes' ? 'checked' : '' }}>
                <span class="slider round"></span>
            </label>
        </div>
        <div class="form-actions">

            <a href="{{ route('payment.index') }}" class="btn-cancel" onclick="showuserTab('usermanage')">Cancel</a>
            <button type="submit" class="btn-save">Save</button>
        </div>
    </form>
</div>




</div>
