<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\RecurringInvoiceController;
use App\Http\Controllers\VendorController;    // Import VendorController
use App\Http\Controllers\TaskController;    // Import TaskController
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RecurringExpenseController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\settings\SettingsController;
use App\Http\Controllers\settings\CompanyDetailsController;
use App\Http\Controllers\settings\UserDetailsController;
use App\Http\Controllers\settings\PaymentSettingsController as SettingsPaymentController;
use App\Http\Controllers\settings\TaxController as SettingsTaxController;
use App\Http\Controllers\settings\TaskController as SettingsTaskController;
use App\Http\Controllers\settings\ProductsController;
use App\Http\Controllers\settings\ExpenseController as SettingsExpenseController;
use App\Http\Controllers\settings\AccountManagmentController;
use App\Http\Controllers\ExpenseController;
use Hamcrest\Core\Set;

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\NewClientController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\NewProjectController;

/*
|--------------------------------------------------------------------------
| Landing Pages (Homepage)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/home-products', function () {
    return view('Products.products');
})->name('home.products');

Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing');

Route::get('/pos-features', function () {
    return view('POS Features.pos-features');
})->name('pos-features');

Route::get('/why-us', function () {
    return view('whyus');
})->name('why-us');

Route::get('/how-it-works', function () {
    return view('how-it-works');
})->name('how-it-works');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'register'])->name('signup.post');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');


/*
|--------------------------------------------------------------------------
| Protected Routes (Require Authentication)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Profile Management
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Client Management
    |--------------------------------------------------------------------------
    */
    // Client listing and forms
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/client-create', [ClientController::class, 'create'])->name('client.create');
    Route::get('/client-import', [ClientController::class, 'import'])->name('client.import');

    // Client CRUD operations
    Route::post('/client-store', [ClientController::class, 'store'])->name('client.store');
    Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');
    Route::post('/clients/import_csv', [ClientController::class, 'import_csv'])->name('clients.import_csv');

    /*
    |--------------------------------------------------------------------------
    | Product Management
    |--------------------------------------------------------------------------
    */
    // Product listing and forms
    Route::get('/products-crud', [ProductController::class, 'index'])->name('products.index');
    Route::get('/product-create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products-import', [ProductController::class, 'import'])->name('products.import');

    // Product CRUD operations
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::post('/products-import', [ProductController::class, 'import'])->name('products.import');

    /*
    |--------------------------------------------------------------------------
    | Invoice Management
    |--------------------------------------------------------------------------
    */
    // Invoice listing and forms
    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoice-create', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::get('/invoices-import', [InvoiceController::class, 'import'])->name('invoices.import');

    // Invoice CRUD operations
    Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
    Route::get('/invoices/{invoice}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
    Route::put('/invoices/{invoice}', [InvoiceController::class, 'update'])->name('invoices.update');
    Route::delete('/invoices/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');

    /*
    |--------------------------------------------------------------------------
    | Recurring Invoice Management
    |--------------------------------------------------------------------------
    */
    // Recurring Invoice listing and forms
    Route::get('/recurring-invoices', [RecurringInvoiceController::class, 'index'])->name('recurring-invoices.index');
    Route::get('/recurring-invoice-create', [RecurringInvoiceController::class, 'create'])->name('recurring-invoices.create');
    Route::get('/recurring-invoice-import', [RecurringInvoiceController::class, 'import'])->name('recurring-invoices.import');

    // Recurring Invoice CRUD operations
    Route::post('/recurring-invoices', [RecurringInvoiceController::class, 'store'])->name('recurring-invoices.store');
    Route::get('/recurring-invoices/{invoice}', [RecurringInvoiceController::class, 'show'])->name('recurring-invoices.show');
    Route::get('/recurring-invoices/{invoice}/edit', [RecurringInvoiceController::class, 'edit'])->name('recurring-invoices.edit');
    Route::put('/recurring-invoices/{invoice}', [RecurringInvoiceController::class, 'update'])->name('recurring-invoices.update');
    Route::delete('/recurring-invoices/{invoice}', [RecurringInvoiceController::class, 'destroy'])->name('recurring-invoices.destroy');

    /*
    |--------------------------------------------------------------------------
    | Recurring Expense Management
    |--------------------------------------------------------------------------
    */
    // Recurring Expense listing and forms
    Route::get('/recurring-expenses', [RecurringExpenseController::class, 'index'])->name('recurring_expense.index');
    Route::get('/recurring-expenses-create', [RecurringExpenseController::class, 'create'])->name('recurring_expense.create');
    Route::get('/recurring-expenses-import', [RecurringExpenseController::class, 'import'])->name('recurring_expense.import');

    // Recurring Expense CRUD operations
    Route::post('/recurring-expenses', [RecurringExpenseController::class, 'store'])->name('recurring_expense.store');
    Route::get('/recurring_expenses/{id}/edit', [RecurringExpenseController::class, 'edit'])->name('recurring_expense.edit');
    Route::put('/recurring_expenses/{id}', [RecurringExpenseController::class, 'update'])->name('recurring_expense.update');
    Route::delete('/recurring_expenses/{recurring_expense}', [RecurringExpenseController::class, 'destroy'])->name('recurring_expense.destroy');

    /*
    |--------------------------------------------------------------------------
    | vendors Routes
    |--------------------------------------------------------------------------
    */
    // Custom routes for import and bulk actions   
    Route::delete('/vendors/bulk-delete', [VendorController::class, 'destroyMultiple'])->name('vendors.destroy.multiple');        // Routes for the import functionality
    Route::get('/vendors/import', [VendorController::class, 'showImportForm'])->name('vendors.import');
    Route::post('/vendors/import', [VendorController::class, 'handleImport'])->name('vendors.import.handle');
    //Main Routes
    Route::resource('/vendors', VendorController::class);

    /*
    |--------------------------------------------------------------------------
    | Tasks Routes
    |--------------------------------------------------------------------------
    */
    // Custom routes for import and bulk actions
    Route::delete('/tasks/bulk-delete', [TaskController::class, 'destroyMultiple'])->name('tasks.destroy.multiple');
    Route::get('/tasks/import', [TaskController::class, 'showImportForm'])->name('tasks.import');
    Route::post('/tasks/import', [TaskController::class, 'handleImport'])->name('tasks.import.handle');
    // Main Routes
    Route::resource('/tasks', TaskController::class);
    Route::get('/projects-by-client/{client}', function ($client) {
        $clientProjects = App\Models\Project::where('client_id', $client->id)->get();
        return view('tasks.index', compact('client', 'clientProjects'));
    });

    /*
    |--------------------------------------------------------------------------
    | Expenses Routes
    |--------------------------------------------------------------------------
    */
    // Custom routes for import and bulk actions
    Route::get('/expenses/import', [ExpenseController::class, 'showImportForm'])->name('expenses.import');
    Route::post('/expenses/import', [ExpenseController::class, 'handleImport'])->name('expenses.import.handle');
    Route::delete('/expenses/bulk-delete', [ExpenseController::class, 'destroyMultiple'])->name('expenses.destroy.multiple');
    // Standard resource route
    Route::resource('expenses', ExpenseController::class);


    /*
    |--------------------------------------------------------------------------
    | Transaction Management
    |--------------------------------------------------------------------------
    */
    // Transaction listing and forms
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions-create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::get('/transactions-import', [TransactionController::class, 'import'])->name('transactions.import');

    // Transaction CRUD operations
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions/{id}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
    Route::put('/transactions/{id}', [TransactionController::class, 'update'])->name('transactions.update');
    Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');

    /*
    |--------------------------------------------------------------------------
    | Settings Routes
    |--------------------------------------------------------------------------
    */
    // Main Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

    // Company Details
    Route::get('/settings/company-details', [CompanyDetailsController::class, 'index'])->name('companydetails.index');
    Route::put('/settings/companydetails/update-details', [CompanyDetailsController::class, 'updateDetails'])->name('companydetails.updateDetails');
    Route::put('/settings/companydetails/update-address', [CompanyDetailsController::class, 'updateAddress'])->name('companydetails.updateAddress');

    // User Details
    Route::get('/settings/user-details', [UserDetailsController::class, 'index'])->name('userdetails.index');
    Route::post('/settings/user-details', [UserDetailsController::class, 'store'])->name('userdetails.store');

    // Payment Settings
    Route::get('/settings/payment-settings', [SettingsPaymentController::class, 'index'])->name('payment.index');
    Route::post('/settings/payment-settings', [SettingsPaymentController::class, 'store'])->name('payment.store');

    // Tax Settings
    Route::get('/settings/tax-settings', [SettingsTaxController::class, 'index'])->name('tax.index');
    Route::post('/settings/tax-settings', [SettingsTaxController::class, 'store'])->name('tax.store');
    Route::post('/settings/tax-settings/update-settings', [SettingsTaxController::class, 'updateSettings'])->name('tax.updateSettings');
    Route::delete('/settings/tax-settings/{taxrate}', [SettingsTaxController::class, 'destroy'])->name('tax.destroy');

    // Product Settings
    Route::get('/settings/products-settings', [ProductsController::class, 'index'])->name('productsettings.index');
    Route::post('/settings/products-settings', [ProductsController::class, 'store'])->name('productsettings.store');

    // Task Settings
    Route::get('/settings/task-settings', [SettingsTaskController::class, 'index'])->name('task.settings.index');
    Route::post('/settings/task-settings', [SettingsTaskController::class, 'store'])->name('task.settings.store');

    // Expense Settings
    Route::get('/settings/expense-settings', [SettingsExpenseController::class, 'index'])->name('expense.settings.index');
    Route::post('/settings/expense-settings', [SettingsExpenseController::class, 'store'])->name('expense.settings.store');

    // Account Management
    Route::get('/settings/account-managment', [AccountManagmentController::class, 'index'])->name('accountmanagment.index');
    Route::post('/settings/account-managment', [AccountManagmentController::class, 'store'])->name('accountmanagment.store');
    Route::delete('/settings/account-managment', [AccountManagmentController::class, 'destroy'])->name('accountmanagment.destroy');


    // عرض كل الفواتير
    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');

    // عرض فورم إضافة فاتورة جديدة
    Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');

    // حفظ فاتورة جديدة
    Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');

    // عرض تفاصيل فاتورة واحدة
    Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');

    // عرض فورم تعديل فاتورة
    Route::get('/invoices/{invoice}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');

    // تحديث بيانات فاتورة
    Route::put('/invoices/{invoice}', [InvoiceController::class, 'update'])->name('invoices.update');

    // حذف فاتورة
    Route::delete('/invoices/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');






    // عرض كل الفواتير
    Route::get('/recurring-invoices', [RecurringInvoiceController::class, 'index'])->name('recurring-invoices.index');

    // عرض فورم إضافة فاتورة جديدة
    Route::get('/recurring-invoices/create', [RecurringInvoiceController::class, 'create'])->name('recurring-invoices.create');

    // حفظ فاتورة جديدة
    Route::post('/recurring-invoices', [RecurringInvoiceController::class, 'store'])->name('recurring-invoices.store');

    // عرض تفاصيل فاتورة واحدة
    Route::get('/recurring-invoices/{invoice}', [RecurringInvoiceController::class, 'show'])->name('recurring-invoices.show');

    // عرض فورم تعديل فاتورة
    Route::get('/recurring-invoices/{invoice}/edit', [RecurringInvoiceController::class, 'edit'])->name('recurring-invoices.edit');

    // تحديث بيانات فاتورة
    Route::put('/recurring-invoices/{invoice}', [RecurringInvoiceController::class, 'update'])->name('recurring-invoices.update');

    // حذف فاتورة
    Route::delete('/recurring-invoices/{invoice}', [RecurringInvoiceController::class, 'destroy'])->name('recurring-invoices.destroy');



    /*--------------------------------- Yassmin Routes-----------------------------*/
    // -------------------- PAYMENTS --------------------

    // Show import form + process import + download template
    Route::prefix('payments')->group(function () {
        Route::get('/import', [PaymentController::class, 'showImportForm'])->name('payments.import.form');
        Route::post('/import', [PaymentController::class, 'import'])->name('payments.import');
        Route::get('/template', [PaymentController::class, 'downloadTemplate'])->name('payments.template');
    });

    // Resource routes for payments (excluding show)
    Route::resource('payments', PaymentController::class)->except(['show']);


    // -------------------- QUOTES --------------------

    Route::prefix('quotes')->group(function () {
        Route::get('/', [QuoteController::class, 'index'])->name('quotes.index');           // List all quotes
        Route::get('/create', [QuoteController::class, 'create'])->name('quotes.create');    // Show create form
        Route::post('/store', [QuoteController::class, 'store'])->name('quotes.store');      // Store new quote

        Route::get('/import', [QuoteController::class, 'showImportForm'])->name('quotes.import.form'); // Show import form
        Route::get('/template', [QuoteController::class, 'downloadTemplate'])->name('quotes.template');

        Route::post('/import', [QuoteController::class, 'import'])->name('quotes.import');   // Process CSV import
    });




    // -------------------- Credits --------------------

    Route::prefix('credits')->group(function () {
        Route::get('/', [CreditController::class, 'index'])->name('credits.index');           // List all credits
        Route::get('/create', [CreditController::class, 'create'])->name('credits.create');    // Show create form
        Route::post('/store', [CreditController::class, 'store'])->name('credits.store');      // Store new credit


    });
    // -------------------- CLIENTS --------------------

    //Full resource routes for clients
    Route::resource('clients', ClientController::class);

    Route::get('/newprojects', [ProjectController::class, 'index'])->name('newprojects.index');
    Route::get('/newprojects/create', [ProjectController::class, 'create'])->name('newprojects.create');
    Route::post('/newprojects', [ProjectController::class, 'store'])->name('newprojects.store');

});
