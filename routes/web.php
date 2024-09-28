<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Users\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('home', [AdminController::class, 'showHome'])->name('show-home');
Route::get('product', [UsersController::class, 'product'])->name('show-product');
Route::get('admin', [AdminController::class, 'showAdmin'])->name('show-admin')->middleware('auth');
Route::get('collection', [AdminController::class, 'showCollection'])->name('show-collection');
Route::post('create-menu', [AdminController::class, 'createMenu'])->name('create-menu');
Route::post('edit-menu', [AdminController::class, 'editMenu'])->name('edit-menu');
Route::delete('delete-menu', [AdminController::class, 'deleteMenu'])->name('delete-menu');

Route::get('manager_product', [AdminController::class, 'showManagerProduct'])->name('show-manager_product');
Route::get('add_product', [AdminController::class, 'showAddProduct'])->name('show-add_product');
Route::get('manager_user', [AdminController::class, 'showManagerUser'])->name('show-manager_user');
Route::delete('delete_user', [AdminController::class, 'deleteUser'])->name('deleteUser');

Route::post('add_product', [AdminController::class, 'addProduct'])->name('addProduct');

Route::post('edit_product', [AdminController::class, 'editProduct'])->name('editProduct');

Route::get('details_product', [UsersController::class, 'showDetailsProduct'])->name('show-details_product');
Route::get('category_product', [UsersController::class, 'showCategoryProduct'])->name('show-category_product');
Route::get('category', [UsersController::class, 'showCategory'])->name('show-category');
Route::get('cart_product', [UsersController::class, 'showCartProduct'])->name('show-cart_product');

Route::post('addCart', [UsersController::class, 'addCart'])->name('addCart');
Route::delete('delete_cart', [UsersController::class, 'deleteCart'])->name('deleteCart');

Route::delete('delete_product', [AdminController::class, 'deleteProduct'])->name('deleteProduct');
Route::get('next_edit_product', [AdminController::class, 'nextEditProduct'])->name('nextEditProduct');


Route::get('register', [AuthController::class, 'showRegister'])->name('show-register');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('login', [AuthController::class, 'showLogin'])->name('show-login')->middleware('guest');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/user', [UsersController::class, 'showUser'])->name('show-user')->middleware('auth');
Route::get('user.order', [UsersController::class, 'showUserOrder'])->name('show-userOrder')->middleware('auth');
Route::get('change_user', [UsersController::class, 'showChangeUser'])->name('show-change-user')->middleware('auth');
Route::post('changeInfo', [UsersController::class, 'changeInfo'])->name('changeInfo');
Route::get('/search', [UsersController::class, 'search'])->name('search');
Route::post('/updateCart', [UsersController::class, 'updateCart'])->name('updateCart');


Route::get('pay', [UsersController::class, 'pay'])->name('show-pay')->middleware('auth');
Route::get('manager_sale', [AdminController::class, 'showSale'])->name('show-sale')->middleware('auth');
Route::get('manager_slide', [AdminController::class, 'showSlide'])->name('show-slide')->middleware('auth');
Route::get('manager_post', [AdminController::class, 'showPost'])->name('show-post')->middleware('auth');
Route::get('manager_rate', [AdminController::class, 'showRate'])->name('show-rate')->middleware('auth');
Route::get('manager_contact', [AdminController::class, 'showContact'])->name('show-contact')->middleware('auth');
Route::post('addSale', [AdminController::class, 'addSale'])->name('addSale');
Route::post('addSlide', [AdminController::class, 'addSlide'])->name('addSlide');
Route::post('addPost', [AdminController::class, 'addPost'])->name('addPost');
Route::post('/updateSale', [AdminController::class, 'updateSale'])->name('updateSale');
Route::post('/updateSlide', [AdminController::class, 'updateSlide'])->name('updateSlide');
Route::post('/updatePost', [AdminController::class, 'updatePost'])->name('updatePost');
Route::delete('delete_sale', [AdminController::class, 'deleteSale'])->name('deleteSale');
Route::delete('delete_slide', [AdminController::class, 'deleteSlide'])->name('deleteSlide');
Route::delete('delete_post', [AdminController::class, 'deletePost'])->name('deletePost');

Route::post('cancelOrder', [UsersController::class, 'cancelOrder'])->name('cancelOrder');

Route::post('order', [UsersController::class, 'order'])->name('order');
Route::post('acpOrder', [AdminController::class, 'acpOrder'])->name('acpOrder');
Route::delete('deleteOrder', [AdminController::class, 'deleteOrder'])->name('deleteOrder');
Route::get('manager_order', [AdminController::class, 'showOrder'])->name('show-order')->middleware('auth');


Route::post('createRate', [UsersController::class, 'createRate'])->name('createRate');
Route::get('blog', [UsersController::class, 'blog'])->name('blog');
Route::get('contact', [UsersController::class, 'contact'])->name('contact');
Route::get('chat', [UsersController::class, 'chat'])->name('chat')->middleware('auth');
Route::post('sendMessage', [UsersController::class, 'sendMessage'])->name('sendMessage')->middleware('auth');
