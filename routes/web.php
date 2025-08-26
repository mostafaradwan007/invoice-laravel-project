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
use App\Http\Controllers\VendorController;    // Import VendorController
use App\Http\Controllers\TaskController;    // Import TaskController
use App\Http\Controllers\ProjectController;


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

//Vendor    
Route::delete('/vendors/bulk-delete', [VendorController::class, 'destroyMultiple'])->name('vendors.destroy.multiple');        // Routes for the import functionality
Route::get('/vendors/import', [VendorController::class, 'showImportForm'])->name('vendors.import');
Route::post('/vendors/import', [VendorController::class, 'handleImport'])->name('vendors.import.handle');
//Main Routes
Route::resource('/vendors', VendorController::class);
//Tasks
// Custom routes for import and bulk actions
Route::delete('/tasks/bulk-delete', [TaskController::class, 'destroyMultiple'])->name('tasks.destroy.multiple');
Route::get('/tasks/import', [TaskController::class, 'showImportForm'])->name('tasks.import');
Route::post('/tasks/import', [TaskController::class, 'handleImport'])->name('tasks.import.handle');
// Main Routes
Route::resource('/tasks', TaskController::class);
Route::get('/projects-by-client/{client}', function($client){
    $clientProjects = App\Models\Project::where('client_id', $client->id)->get();
    return view('tasks.index', compact('client', 'clientProjects'));
});






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
