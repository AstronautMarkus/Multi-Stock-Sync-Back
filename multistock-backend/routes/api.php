<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\ClientesController;

use App\Http\Controllers\BrandsController;
use App\Http\Controllers\StockController;

use App\Http\Controllers\WarehouseCompaniesController;
use App\Http\Controllers\InfoController;

use App\Http\Controllers\MercadoLibreProductController;
use App\Http\Controllers\MercadoLibreDocumentsController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public routes
Route::post('/login', [AuthController::class, 'login']); // Login user
Route::post('/users', [UserController::class, 'store']); // Create user

// CRUD routes for Clientes
Route::get('/clientes', [ClientesController::class, 'index']); // Get all clients
Route::post('/clientes', [ClientesController::class, 'store']); // Create a client
Route::get('/clientes/{id}', [ClientesController::class, 'show']); // Get a client
Route::patch('/clientes/{id}', [ClientesController::class, 'update']); // Update a client
Route::delete('/clientes/{id}', [ClientesController::class, 'destroy']); // Delete a client

// CRUD routes for Marcas
Route::get('/marcas', [BrandsController::class, 'index']); // Get all brands
Route::post('/marcas', [BrandsController::class, 'store']); // Create a brand
Route::get('/marcas/{id}', [BrandsController::class, 'show']); // Get a brand
Route::put('/marcas/{id}', [BrandsController::class, 'update']); // Update a brand
Route::patch('/marcas/{id}', [BrandsController::class, 'patch']); // Patch a brand
Route::delete('/marcas/{id}', [BrandsController::class, 'destroy']); // Delete a brand

// Company-specific routes
Route::get('/companies', [WarehouseCompaniesController::class, 'company_list_all']); // List all companies
Route::post('/companies', [WarehouseCompaniesController::class, 'company_store']); // Create a company
Route::patch('/companies/{id}', [WarehouseCompaniesController::class, 'company_update']); // Update a company's name
Route::get('/companies/{id}', [WarehouseCompaniesController::class, 'company_show']); // Get a company by its ID
Route::delete('/companies/{id}', [WarehouseCompaniesController::class, 'company_delete']); // Delete a company

// Warehouse-specific routes
Route::get('/warehouses', [WarehouseCompaniesController::class, 'warehouse_list_all']); // List all warehouses
Route::post('/warehouses', [WarehouseCompaniesController::class, 'warehouse_store']); // Create a warehouse
Route::patch('/warehouses/{id}', [WarehouseCompaniesController::class, 'warehouse_update']); // Update a warehouse
Route::get('/warehouses/{id}', [WarehouseCompaniesController::class, 'warehouse_show']); // Get a warehouse by its ID
Route::delete('/warehouses/{id}', [WarehouseCompaniesController::class, 'warehouse_delete']); // Delete a warehouse

// Get stock by warehouse
Route::get('/warehouse-stock/{warehouse_id}', [WarehouseCompaniesController::class, 'getStockByWarehouse']);

// Stock-specific routes
Route::post('/warehouse-stock', [WarehouseCompaniesController::class, 'stock_store']); // Create stock for a warehouse
Route::patch('/warehouse-stock/{id}', [WarehouseCompaniesController::class, 'stock_update']); // Update stock for a warehouse
Route::delete('/warehouse-stock/{id}', [WarehouseCompaniesController::class, 'stock_delete']); // Delete stock for a warehouse

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'index']); // Get full users list
    Route::post('/logout', [AuthController::class, 'logout']); // Logout user
});


use App\Http\Controllers\MercadoLibreController;

// Save MercadoLibre credentials
Route::post('/mercadolibre/save-credentials', [MercadoLibreController::class, 'saveCredentials']);
// Generate MerccadoLibre login Auth 2.0 URL
Route::post('/mercadolibre/login', [MercadoLibreController::class, 'login']);
// Handle MercadoLibre callback
Route::get('/mercadolibre/callback', [MercadoLibreController::class, 'handleCallback']);
// Check MercadoLibre connection status
Route::get('/mercadolibre/test-connection/{client_id}', [MercadoLibreController::class, 'testAndRefreshConnection']);
// Get MercadoLibre credentials if are saved in db
Route::get('/mercadolibre/credentials', [MercadoLibreController::class, 'getAllCredentialsData']);
// Get MercadoLibre credentials by client_id
Route::get('/mercadolibre/credentials/{client_id}', [MercadoLibreController::class, 'getCredentialsByClientId']);
// Delete credentials using client_id
Route::delete('/mercadolibre/credentials/{client_id}', [MercadoLibreController::class, 'deleteCredentials']);


// Get MercadoLibre products list by client_id
Route::get('/mercadolibre/products/{client_id}', [MercadoLibreProductController::class, 'listProductsByClientId']);

// Search MercadoLibre products by client_id and search term
Route::get('/mercadolibre/products/search/{client_id}', [MercadoLibreProductController::class, 'searchProducts']);

// Get product reviews by product_id
Route::get('/mercadolibre/products/reviews/{product_id}', [MercadoLibreProductController::class, 'getProductReviews']);

// Get product reviews by product_id and client_id
Route::get('/mercadolibre/products/reviews/{product_id}', [MercadoLibreProductController::class, 'getProductReviews']);

// Get MercadoLibre invoice report by client_id
Route::get('/mercadolibre/invoices/{client_id}', [MercadoLibreDocumentsController::class, 'getInvoiceReport']);

// Get refunds or returns by category
Route::get('/mercadolibre/refunds-by-category/{client_id}', [MercadoLibreDocumentsController::class, 'getRefundsByCategory']);

// Get MercadoLibre sales by month by client_id
Route::get('/mercadolibre/sales-by-month/{client_id}', [MercadoLibreDocumentsController::class, 'getSalesByMonth']);

// Get MercadoLibre annual sales by client_id
Route::get('/mercadolibre/annual-sales/{client_id}', [MercadoLibreDocumentsController::class, 'getAnnualSales']);

// Get weeks of the month
Route::get('/mercadolibre/weeks-of-month', [MercadoLibreDocumentsController::class, 'getWeeksOfMonth']);

// Get total sales for a specific week
Route::get('/mercadolibre/sales-by-week/{client_id}', [MercadoLibreDocumentsController::class, 'getSalesByWeek']);

// Get daily sales
Route::get('/mercadolibre/daily-sales/{client_id}', [MercadoLibreDocumentsController::class, 'getDailySales']);

// Get top selling products
Route::get('/mercadolibre/top-selling-products/{client_id}', [MercadoLibreDocumentsController::class, 'getTopSellingProducts']);

// Get order statuses
Route::get('/mercadolibre/order-statuses/{client_id}', [MercadoLibreDocumentsController::class, 'getOrderStatuses']);

// Get top payment methods
Route::get('/mercadolibre/top-payment-methods/{client_id}', [MercadoLibreDocumentsController::class, 'getTopPaymentMethods']);

// Get summary
Route::get('/mercadolibre/summary/{client_id}', [MercadoLibreDocumentsController::class, 'summary']);

// Compare sales data between two months
Route::get('/mercadolibre/compare-sales-data/{client_id}', [MercadoLibreDocumentsController::class, 'compareSalesData']);

// Compare sales data between two years
Route::get('/mercadolibre/compare-annual-sales-data/{client_id}', [MercadoLibreDocumentsController::class, 'compareAnnualSalesData']);

// Info route
Route::get('/info', [InfoController::class, 'getInfo']);

// Get product titles by client_id
Route::get('/mercadolibre/product-titles/{client_id}', [MercadoLibreProductController::class, 'getProductTitles']);


// Save products from API to database
Route::get('/mercadolibre/save-products/{client_id}', [MercadoLibreProductController::class, 'saveProducts']);

// Get sales by date range
Route::get('/mercadolibre/sales-by-date-range/{client_id}', [MercadoLibreDocumentsController::class, 'getSalesByDateRange']);