<!-- Form Content -->
<div class="form-content">

    <div id="product-settings-tab" class="tab-content active">
        <h4>Settings</h4>
        <hr style="color:lightgray;">

        <form action="{{ route('productsettings.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <label for="trackinventory">Track Inventory<br><span style="color: gray;">Display a product stock field
                        and update when invoices are sent</span></label>
                <label class="switch">
                    <input type="hidden" name="track_inventory" value="No">
                    <input type="checkbox" name="track_inventory" value="Yes"
                        {{ isset($product) && $product->track_inventory === 'Yes' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="form-row">
                <label for="stocknotifications">Stock Notifications<br><span style="color: gray;">Send an email when the
                        stock reaches the threshold
                    </span></label>
                <label class="switch">
                    <input type="hidden" name="stock_notifications" value="No">
                    <input type="checkbox" name="stock_notifications" value="Yes"
                        {{ isset($product) && $product->stock_notifications === 'Yes' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>

            <div class="form-row">
                <label for="Notification Threshold">Notification Threshold
                </label>
                <input type="text" id="Notification_Threshold" class="form-control" name="notification_threshold"
                value="{{ old('notification_threshold', $product->notification_threshold ?? '') }}"/>

            </div>

            <hr style="color: gray;">


            <div class="form-row">
                <label for="showproducts">Show Products<br><span style="color: gray;">Display a line item discount
                        field</span></label>
                <label class="switch">
                    <input type="hidden" name="show_products" value="No">
                    <input type="checkbox" name="show_products" value="Yes"
                        {{ isset($product) && $product->show_products === 'Yes' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="form-row">
                <label for="productcost">Show Products Cost<br><span style="color: gray;">Display a product cost field
                        to track the markup/profit</span></label>
                <label class="switch">
                    <input type="hidden" name="show_products_cost" value="No">
                    <input type="checkbox" name="show_products_cost" value="Yes"
                        {{ isset($product) && $product->show_products_cost === 'Yes' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>

            <div class="form-row">
                <label for="productquantity">Show Products Quantity<br><span style="color: gray;">Display a product
                        quantity field, otherwise default to one</span></label>
                <label class="switch">
                    <input type="hidden" name="show_products_quantity" value="No">
                    <input type="checkbox" name="show_products_quantity" value="Yes"
                        {{ isset($product) && $product->show_products_quantity === 'Yes' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="form-row">
                <label for="defaultquantity">Default Quantity<br><span style="color: gray;">Automatically set the line
                        item quantity to one

                    </span></label>
                <label class="switch">
                    <input type="hidden" name="default_quantity" value="No">
                    <input type="checkbox" name="default_quantity" value="Yes"
                        {{ isset($product) && $product->default_quantity === 'Yes' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>
            <hr style="color: gray;">
            <div class="form-row">
                <label for="Auto-fillproducts">Auto-fill products<br><span style="color: gray;">Selecting a product will
                        automatically fill in the description and cost</span></label>
                <label class="switch">
                    <input type="hidden" name="auto_fill_products" value="No">
                    <input type="checkbox" name="auto_fill_products" value="Yes"
                        {{ isset($product) && $product->auto_fill_products === 'Yes' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>


            <div class="form-row">
                <label for="Auto-updateproducts">Auto-update products<br><span style="color: gray;">Updating an invoice
                        will automatically update the product library</span></label>
                <label class="switch">
                    <input type="hidden" name="auto_update_products" value="No">
                    <input type="checkbox" name="auto_update_products" value="Yes"
                        {{ isset($product) && $product->auto_update_products === 'Yes' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>


            <div class="form-row">
                <label for="ConvertProducts">Convert Products<br><span style="color: gray;">Automatically convert
                        product prices to the client's currency</span></label>
                <label class="switch">
                    <input type="hidden" name="convert_products" value="No">
                    <input type="checkbox" name="convert_products" value="Yes"
                        {{ isset($product) && $product->convert_products === 'Yes' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>
   <div class="form-actions">
        <a href="{{ route('settings.index') }}" class="btn-cancel">Cancel</a>
        <button type="submit" class="btn-save">Save Changes</button>
    </div>
</form>

    </div>


</div>
