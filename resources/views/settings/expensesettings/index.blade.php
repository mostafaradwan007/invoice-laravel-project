<!-- Expense Settings -->

<div id="expense-settings" class="tab-content active">
    <div class="form-content">
        <div class="form-title">Expense Settings</div>

        <div class="tabs">
            <div class="tab-list">
                <div class="tab active" data-tab="expense-general">General</div>
            </div>
        </div>
        <form action="{{ route('expense.settings.store') }}" method="POST">
            @csrf
            <div id="expense-general" class="tab-content active">
                <div class="form-row">
                    <label>Should be Invoiced:</label>
                    <label class="switch">
                        <input type="hidden" name="should_be_invoiced" value="No">
                        <input type="checkbox" " name="should_be_invoiced" value="Yes"
                        {{ isset($expense) && $expense->should_be_invoiced === 'Yes' ? 'checked' : '' }}>
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="form-row">
                    <label>Mark Paid:</label>
                    <label class="switch">
                        <input type="hidden" name="mark_paid" value="No">
                        <input type="checkbox" " name="mark_paid" value="Yes"
                        {{ isset($expense) && $expense->mark_paid === 'Yes' ? 'checked' : '' }}>
                        <span class="slider round"></span>
                    </label>
                </div>
           
                <div class="form-row">
                    <label>Convert Currency:</label>
                    <label class="switch">
                        <input type="hidden" name="convert_currency" value="No">
                        <input type="checkbox" " name="convert_currency" value="Yes"
                        {{ isset($expense) && $expense->convert_currency === 'Yes' ? 'checked' : '' }}>
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="form-row">
                    <label>Inclusive Taxes:</label>
                    <label class="switch">

                        <input type="hidden" name="inclusive_taxes" value="No">
                        <input type="checkbox" " name="inclusive_taxes" value="Yes"
                        {{ isset($expense) && $expense->inclusive_taxes === 'Yes' ? 'checked' : '' }}>
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn-cancel">Cancel</button>
                    <button type="submit" class="btn-save">Save Expense Settings</button>
                </div>
            </div>
        </form>



    </div>
</div>
