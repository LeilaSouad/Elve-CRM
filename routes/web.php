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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('/admin')->namespace ('App\Http\Controllers\Admin')->group(function () {
Route::match(['get','post'],'/','AdminController@login');
Route::group(['middleware'=>['admin']],function(){
Route::get('dashboard','AdminController@dashboard');
Route::get('password','AdminController@password');
Route::get('update-password','AdminController@updatePassword');
//Admins
Route::get('admins','AdminController@admins');
Route::match(['get','post'],'/add-admin','AdminController@addAdmin');
//Users
Route::get('users','UserController@users');
Route::match(['get','post'],'add-edit-user-{id?}','UserController@addeditUser');
Route::get('delete-user-{id}','UserController@deleteUser');
//Reset Passwords
Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');
//Роли
Route::get('roles','RoleController@roles');
Route::match(['get','post'],'add-edit-role-{id?}','RoleController@addeditRole');
Route::get('delete-role-{id}','RoleController@deleteRole');
Route::get('logout','AdminController@logout');
Route::post('check-current-pwd', 'AdminController@chkCurrentPassword');
Route::post('update-current-pwd', 'AdminController@updateCurrentPassword');
Route::match(['get','post'],'admin-details','AdminController@updateAdminDetails');
//Sections
Route::get('sections',"SectionController@sections");
Route::post('update-section-status', 'SectionController@updateSectionStatus');
//Categories
Route::get('categories', 'CategoryController@categories');
Route::post('update-category-status', 'CategoryController@updateCategoryStatus');
Route:: match(['get','post'],'add-edit-category-{id?}','CategoryController@addeditCategory');
Route::post('append-categories-level', 'CategoryController@appendCategoryLevel');
Route::get('delete-category-image-{id}','CategoryController@deleteCategoryImage');
Route::get('delete-category-{id}','CategoryController@deleteCategory');
//Products Route
Route::get('products','ProductController@products');
Route::post('update-product-status', 'ProductController@updateProductStatus');
Route::get('delete-product-{id}','ProductController@deleteProduct');
Route::match(['get','post'],'add-edit-product-{id?}','ProductController@addEditProduct');
Route::get('delete-productimage-{id}','ProductController@deleteProductImage');
Route::get('delete-productvideo-{id}','ProductController@deleteProductVideo');
//Images
Route::match(['get','post'],'add-images-{id?}','ProductsController@addImages');
Route::post('update-image-status', 'ProductsController@updateImageStatus');
Route::get('delete-image-{id}','ProductsController@deleteImage');
//Brands
Route::get('brands','BrandController@brands');
Route::post('update-brand-status', 'BrandController@updateBrandStatus');
Route::match(['get','post'],'add-edit-brand-{id?}','BrandController@addeditBrand');
Route::get('delete-brand-{id}','BrandController@deleteBrand');
Route::get('delete-brandimage-{id}','BrandController@deleteBrandImage');
//Suppliers
Route::get('suppliers','SupplierController@suppliers');
Route::match(['get','post'],'add-edit-supplier-{id?}','SupplierController@addeditSupplier');
Route::get('delete-supplier-{id}','SupplierController@deleteSupplier');
//Customers
Route::get('customers','CustomerController@customers');
Route::match(['get','post'],'add-edit-customer-{id?}','CustomerController@addeditCustomer');
Route::get('delete-customer-{id}','CustomerController@deleteCustomer');
//Валюты
Route::get('currency','CurrencyController@currency');
Route::post('update-currency-status', 'CurrencyController@updateCurrencyStatus');
Route::match(['get','post'],'add-edit-currency-{id?}','CurrencyController@addeditCurrency');
Route::get('delete-currency-{id}','CurrencyController@deleteCurrency');
//Склады
Route::get('warehouses','WarehouseController@warehouses');
Route::post('update-warehouse-status', 'WarehouseController@updateWarehouseStatus');
Route::match(['get','post'],'add-edit-warehouse-{id?}','WarehouseController@addeditWarehouse');
Route::get('delete-warehouse-{id}','WarehouseController@deleteWarehouse');
//Приходные
Route::get('receipts','ReceiptController@receipts');
Route::match(['get','post'],'add-edit-receipt-{id?}','ReceiptController@addeditReceipt');
Route::get('delete-receipt-{id}','ReceiptController@deleteReceipt');
Route::get('receipt-pdf-{id}','ReceiptController@createPDF');
//Расходные
Route::get('salesinvoices','SalesinvoiceController@salesinvoices');
Route::match(['get','post'],'add-edit-salesinvoice-{id?}','SalesinvoiceController@addeditSalesInvoice');
Route::get('delete-salesinvoice-{id}','SalesinvoiceController@deleteSalesInvoice');
Route::get('salesinvoice-pdf-{id}','SalesinvoiceController@createPDF');
//Списание
Route::get('adjustments','AdjustmentController@adjustments');
Route::match(['get','post'],'add-edit-adjustment-{id?}','AdjustmentController@addeditAdjustment');
Route::get('delete-adjustment-{id}','AdjustmentController@deleteAdjustment');
Route::get('adjustment-pdf-{id}','AdjustmentController@createPDF');
//Banners
Route::get('banners','BannerController@banners');
Route::match(['get','post'],'add-edit-banner-{id?}', 'BannerController@addeditBanner');
Route::post('update-banner-status', 'BannerController@updateBannerStatus');
Route::get('delete-banner-{id}','BannerController@deleteBanner');
});
	});

//Front Group
Route::namespace('App\Http\Controllers\Front')->group(function(){
	Route::get('/', 'IndexController@index');
	Route::get('/{url}', 'ProductsController@listing');
});