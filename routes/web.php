<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\RecurringInvoiceController;
use App\Http\Controllers\ProjectController;






use App\Http\Controllers\ReportsController;

use App\Models\Transactions;
use App\Http\Controllers\TransactionController;

use App\Models\RecurringExpense;
use App\Http\Controllers\RecurringExpenseController;
use App\Http\Controllers\RecurringExpenseCreateController;

use App\Http\Controllers\settings\SettingsController;
use App\Http\Controllers\settings\CompanyDetailsController;

use App\Http\Controllers\settings\UserDetailsController;
use App\Http\Controllers\settings\PaymentController;
use App\Http\Controllers\settings\TaxController;
use App\Http\Controllers\settings\TaskController;
use App\Http\Controllers\settings\ProductsController;
use App\Http\Controllers\settings\ExpenseController;

use App\Http\Controllers\settings\WorkFlowController;
use App\Http\Controllers\settings\CreditcardANDbankcontroller;
use App\Http\Controllers\settings\AccountManagmentController;
use App\Http\Controllers\settings\EmailSettingsController;
use App\Http\Controllers\settings\ClientPortalController;
use App\Http\Controllers\settings\GroupSettingsController;
use App\Http\Controllers\settings\PaymentLinksController;
use App\Http\Controllers\settings\UserManagmentController;



use App\Models\CompanyDetails;
use App\Models\Settings\Expense;
use App\Models\Transaction;
use Faker\Provider\ar_EG\Payment;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/clients', [ClientController::class, 'index'])->name('clients');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices');
Route::get('/recurring-invoices', [RecurringInvoiceController::class, 'index'])->name('recurring.invoices');
Route::get('/client-create', [ClientController::class, 'create'])->name('client.create');
Route::get('/client-import', [ClientController::class, 'import'])->name('client.import');
Route::get('/product-create', [ProductController::class, 'create'])->name('product.create');
Route::get('/invoice-create', [InvoiceController::class, 'create'])->name('invoice.create');
Route::get('/recurring-invoice-create', [RecurringInvoiceController::class, 'create'])->name('recurring.invoice.create');

Route::get('/products-import', [ProductController::class, 'import'])->name('products.import');
Route::get('/invoices-import', [InvoiceController::class, 'import'])->name('invoices.import');
Route::get('/invoice-create', [InvoiceController::class, 'create'])->name('invoice.create');
Route::get('/recurring-invoice-create', [RecurringInvoiceController::class, 'create'])->name('recurring.invoice.create');
Route::get('/recurring-invoice-import', [RecurringInvoiceController::class, 'import'])->name('recurring.invoice.import');




Route::post('/client-store', [ClientController::class, 'store'])->name('client.store');
Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');
Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');
Route::post('/clients/import_csv', [ClientController::class, 'import_csv'])->name('clients.import_csv');






// Display all products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Show form to create a new product
Route::get('/product-create', [ProductController::class, 'create'])->name('products.create');

// Store a new product
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// Show form to edit an existing product
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

// Update an existing product
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

// Delete a product
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// Show import page (optional route if you’re using it)

// Handle file import (optional)
Route::post('/products-import', [ProductController::class, 'import'])->name('products.import');



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







//recurring-expenses page
Route::get('/recurring-expenses', [RecurringExpenseController::class, 'index'])->name('recurring_expense.index');
Route::get('/recurring-expenses-create', [RecurringExpenseController::class, 'create'])->name('recurring_expense.create');
Route::get('/recurring-expenses-import', [RecurringExpenseController::class, 'import'])->name('recurring_expense.import');
Route::post('/recurring-expenses', [RecurringExpenseController::class, 'store'])->name('recurring_expense.store');
Route::delete('recurring_expenses/{recurring_expense}', [RecurringExpenseController::class, 'destroy'])->name('recurring_expense.destroy');
Route::get('/recurring_expenses/{id}/edit',  [RecurringExpenseController::class, 'edit'])->name('recurring_expense.edit');
Route::put('/recurring_expenses/{id}', [RecurringExpenseController::class, 'update'])->name('recurring_expense.update');

//transaction page
Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
Route::get('/transactions-create', [TransactionController::class, 'create'])->name('transactions.create');
Route::get('/transactions-import', [TransactionController::class, 'import'])->name('transactions.import');
Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
Route::delete('transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
Route::get('/transactions/{id}/edit',  [TransactionController::class, 'edit'])->name('transactions.edit');
Route::put('/transactions/{id}', [TransactionController::class, 'update'])->name('transactions.update');



//settings page
Route::get( '/settings', [SettingsController::class, 'index'])->name('settings.index');

Route::get( '/settings/company-details', [CompanyDetailsController::class, 'index'])->name('companydetails.index');

Route::put('/settings/companydetails/update-details', [CompanyDetailsController::class, 'updateDetails'])->name('companydetails.updateDetails');
Route::put('/settings/companydetails/update-address', [CompanyDetailsController::class, 'updateAddress'])->name('companydetails.updateAddress');

Route::get('/settings/user-details', [UserDetailsController::class, 'index'])->name('userdetails.index');
Route::post('/settings/user-details', [UserDetailsController::class, 'store'])->name('userdetails.store');

Route::get('/settings/payment-settings', [PaymentController::class, 'index'])->name('payment.index');
Route::post('/settings/payment-settings',  [PaymentController::class, 'store'])->name(name: 'payment.store');
///////////////////////////////////////////////////////////

// Tax settings page
Route::get('/settings/tax-settings', [TaxController::class, 'index'])->name('tax.index');

// Add new tax rate
Route::post('/settings/tax-settings', [TaxController::class, 'store'])->name('tax.store');

// Update global tax settings (toggles, selects, etc.)
Route::post('/settings/tax-settings/update-settings', [TaxController::class, 'updateSettings'])->name('tax.updateSettings');

// Delete a tax rate
Route::delete('/settings/tax-settings/{taxrate}', [TaxController::class, 'destroy'])->name('tax.destroy');



/////////////////////////////////////////////
Route::get('/settings/products-settings', [ProductsController::class, 'index'])->name('productsettings.index');
Route::post('/settings/products-settings',  [ProductsController::class, 'store'])->name(name: 'productsettings.store');

Route::get('/settings/task-settings', [TaskController::class, 'index'])->name('task.index');
Route::post('/settings/task-settings', [TaskController::class, 'store'])->name(name: 'task.store');

Route::get('/settings/expense-settings', [ExpenseController::class, 'index'])->name('expense.index');
Route::post('/settings/expense-settings', [ExpenseController::class, 'store'])->name(name: 'expense.store');

Route::get('/settings/account-managment', action: [AccountManagmentController::class, 'index'])->name(name: 'accountmanagment.index');
Route::post('/settings/account-managment', [AccountManagmentController::class, 'store'])->name(name: 'accountmanagment.store');
Route::delete('settings/account-managment', [AccountManagmentController::class, 'destroy'])->name('accountmanagment.destroy');
