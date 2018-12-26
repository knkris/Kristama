<?php

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
Route::get('nicepay-callback', 'Front\GeneralController@nicepayCallback');
Route::get('calc-rating', 'Controller@avgRating');
Route::group(['middleware' => ['guest']], function () {
	Route::get('login', 'Auth\LoginController@showFrontLoginForm');
	Route::get('/sign-in', 'Auth\LoginController@showFrontLoginForm')->name('sign.in');
	Route::post('/sign-in', 'Auth\LoginController@loginweb')->name('postsign.in');
	Route::get('/sign-up', 'Auth\RegisterController@showRegistrationForm')->name('sign.up');
	Route::post('/sign-up', 'Auth\RegisterController@register')->name('postsign.up');
});

Route::group(['middleware' => ['guest:admin']], function () {
	Route::get('admin/login', function () {
		    return view('auth.adminlogin');
		})->name('admin.login');
	Route::post('admin/login', 'Auth\LoginController@loginAdmin');
});
Route::get('admin/logout', 'Auth\LoginController@logoutAdmin');


Route::group(['middleware' => ['auth:admin']], function () {

	Route::post('/upload_image', 'Controller@uploadImage');

    // Existing routes go here...
	Route::get('/admin/home', 'Admin\AdminController@dashboard');

	// Route::get('/admin/home', function () {
	//     return view('admin.index');
	// });

	Route::group(['middleware' => ['permission:manage admin']], function () {
		Route::get('/admin/admin', 'Admin\AdminController@showIndex');
		Route::post('/admin/admin', 'Admin\AdminController@index');
		Route::get('/admin/admin/create', 'Admin\AdminController@create');
		Route::post('/admin/admin/store', 'Admin\AdminController@store');
		Route::get('/admin/admin/edit/{id}', 'Admin\AdminController@edit');
		Route::post('/admin/admin/edit/{id}', 'Admin\AdminController@update');
		Route::post('/admin/admin/trash', 'Admin\AdminController@trash');
	});

	Route::get('/admin/customer-group', 'Admin\CustomerGroupController@showIndex');
	Route::post('/admin/customer-group', 'Admin\CustomerGroupController@index');
	Route::get('/admin/customer-group/create', 'Admin\CustomerGroupController@create');
	Route::group(['middleware' => ['permission:add customer-group']], function () {
		Route::post('/admin/customer-group/store', 'Admin\CustomerGroupController@store');
	});
	Route::get('/admin/customer-group/edit/{id}', 'Admin\CustomerGroupController@edit');
	Route::group(['middleware' => ['permission:edit customer-group']], function () {
		Route::post('/admin/customer-group/edit/{id}', 'Admin\CustomerGroupController@update');
	});
	Route::group(['middleware' => ['permission:delete customer-group']], function () {
		Route::post('/admin/customer-group/trash', 'Admin\CustomerGroupController@trash');
	});

	Route::get('/admin/customer', 'Admin\UserController@showIndex');
	Route::post('/admin/customer', 'Admin\UserController@index');
	Route::get('/admin/customer/create', 'Admin\UserController@create');
	Route::group(['middleware' => ['permission:add customer']], function () {
		Route::post('/admin/customer/store', 'Admin\UserController@store');
	});
	Route::get('/admin/customer/edit/{id}', 'Admin\UserController@edit');
	Route::group(['middleware' => ['permission:edit customer']], function () {
		Route::post('/admin/customer/edit/{id}', 'Admin\UserController@update');
	});
	Route::group(['middleware' => ['permission:delete customer']], function () {
		Route::post('/admin/customer/trash', 'Admin\UserController@trash');
	});

	Route::get('/admin/category', 'Admin\CategoryController@showIndex');
	Route::post('/admin/category', 'Admin\CategoryController@index');
	Route::get('/admin/category/create', 'Admin\CategoryController@create');
	Route::group(['middleware' => ['permission:add category']], function () {
		Route::post('/admin/category/store', 'Admin\CategoryController@store');
	});
		Route::get('/admin/category/edit/{id}', 'Admin\CategoryController@edit');
	Route::group(['middleware' => ['permission:edit category']], function () {
		Route::post('/admin/category/edit/{id}', 'Admin\CategoryController@update');
		Route::get('/admin/category/delete-image/{id}', 'Admin\CategoryController@deleteImage');
	});
	Route::group(['middleware' => ['permission:delete category']], function () {
		Route::post('/admin/category/trash', 'Admin\CategoryController@trash');
	});

	Route::get('/admin/manufacturer', 'Admin\ManufacturerController@showIndex');
	Route::post('/admin/manufacturer', 'Admin\ManufacturerController@index');
	Route::get('/admin/manufacturer/create', 'Admin\ManufacturerController@create');
	Route::group(['middleware' => ['permission:add manufacturer']], function () {
		Route::post('/admin/manufacturer/store', 'Admin\ManufacturerController@store');
	});
	Route::get('/admin/manufacturer/edit/{id}', 'Admin\ManufacturerController@edit');
	Route::group(['middleware' => ['permission:edit manufacturer']], function () {
		Route::post('/admin/manufacturer/edit/{id}', 'Admin\ManufacturerController@update');
		Route::get('/admin/manufacturer/delete-image/{id}', 'Admin\ManufacturerController@deleteImage');
	});
	Route::group(['middleware' => ['permission:delete manufacturer']], function () {
		Route::post('/admin/manufacturer/trash', 'Admin\ManufacturerController@trash');
	});
	

	Route::get('/admin/option', 'Admin\OptionController@showIndex');
	Route::post('/admin/option', 'Admin\OptionController@index');
	Route::get('/admin/option/create', 'Admin\OptionController@create');
	Route::group(['middleware' => ['permission:add option']], function () {
		Route::post('/admin/option/store', 'Admin\OptionController@store');
	});
	Route::get('/admin/option/edit/{id}', 'Admin\OptionController@edit');
	Route::group(['middleware' => ['permission:edit option']], function () {
		Route::post('/admin/option/edit/{id}', 'Admin\OptionController@update');
	});
	Route::group(['middleware' => ['permission:delete option']], function () {
		Route::post('/admin/option/trash', 'Admin\OptionController@trash');
	});

	Route::get('/admin/option/search', 'Admin\OptionController@search');
	Route::get('/admin/optionvalue/{id}/{index}', 'Admin\OptionController@optionValue');

	Route::get('/admin/product', 'Admin\ProductController@showIndex');
	Route::post('/admin/product', 'Admin\ProductController@index');
	Route::get('/admin/product/create', 'Admin\ProductController@create');
	Route::group(['middleware' => ['permission:add product']], function () {
		Route::post('/admin/product/store', 'Admin\ProductController@store');
	});
	Route::get('/admin/product/edit/{id}', 'Admin\ProductController@edit');
	Route::group(['middleware' => ['permission:edit product']], function () {
		Route::post('/admin/product/edit/{id}', 'Admin\ProductController@update');
		Route::post('/admin/product/{type}/{id}', 'Admin\ProductController@quickUpdate');
		Route::get('/admin/delete-product-image/{id}', 'Admin\ProductController@deleteProductImage');
	});
	Route::group(['middleware' => ['permission:delete product']], function () {
		Route::post('/admin/product/trash', 'Admin\ProductController@trash');
	});

	Route::get('/admin/search/sku', 'Admin\ProductController@searchSKU');
	Route::get('/admin/search/model', 'Admin\ProductController@searchModel');
	Route::get('/admin/recommended-product/search', 'Admin\ProductController@recommendedSearch');
	Route::get('/admin/related-product/search', 'Admin\ProductController@relatedSearch');
	Route::get('/admin/product/search', 'Admin\ProductController@search');
	Route::post('/admin/product/recommended-product', 'Admin\ProductController@postRecommendedProduct');
	Route::post('/admin/product/export-to-excel', 'Admin\ProductController@exportToExcel');
	Route::post('/admin/product/import-with-excel', 'Admin\ProductController@importWithExcel');
	Route::group(['middleware' => ['permission:edit product']], function () {
		Route::post('/admin/product/confirm-import-with-excel', 'Admin\ProductController@confirmImportWithExcel');
	});

	Route::get('/admin/review', 'Admin\ProductReviewController@showIndex');
	Route::post('/admin/review', 'Admin\ProductReviewController@index');
	Route::get('/admin/review/create', 'Admin\ProductReviewController@create');
	Route::group(['middleware' => ['permission:add review']], function () {
		Route::post('/admin/review/store', 'Admin\ProductReviewController@store');
	});
		Route::get('/admin/review/edit/{id}', 'Admin\ProductReviewController@edit');
	Route::group(['middleware' => ['permission:edit review']], function () {
		Route::post('/admin/review/edit/{id}', 'Admin\ProductReviewController@update');
	});
	Route::group(['middleware' => ['permission:delete review']], function () {
		Route::post('/admin/review/trash', 'Admin\ProductReviewController@trash');
	});

	Route::get('/admin/discussion', 'Admin\ProductDiscussionController@showIndex');
	Route::post('/admin/discussion', 'Admin\ProductDiscussionController@index');
	Route::get('/admin/discussion/create', 'Admin\ProductDiscussionController@create');
	Route::group(['middleware' => ['permission:add discussion']], function () {
		Route::post('/admin/discussion/store', 'Admin\ProductDiscussionController@store');
	});
		Route::get('/admin/discussion/edit/{id}', 'Admin\ProductDiscussionController@edit');
	Route::group(['middleware' => ['permission:edit discussion']], function () {
		Route::post('/admin/discussion/edit/{id}', 'Admin\ProductDiscussionController@update');
	});
	Route::get('/admin/discussion/conversation/{id}', 'Admin\ProductDiscussionController@conversation');
	Route::post('/admin/discussion/post-reply', 'Admin\ProductDiscussionController@postReply');
	Route::group(['middleware' => ['permission:delete discussion']], function () {
		Route::post('/admin/discussion/trash', 'Admin\ProductDiscussionController@trash');
	});

	Route::get('/admin/product-group', 'Admin\ProductGroupController@showIndex');
	Route::post('/admin/product-group', 'Admin\ProductGroupController@index');
	Route::get('/admin/product-group/create', 'Admin\ProductGroupController@create');
	Route::group(['middleware' => ['permission:add product-group']], function () {
		Route::post('/admin/product-group/store', 'Admin\ProductGroupController@store');
	});
	Route::get('/admin/product-group/edit/{id}', 'Admin\ProductGroupController@edit');
	Route::post('/admin/product-group/product/{id}', 'Admin\ProductGroupController@productIndex');
	Route::post('/admin/product-group-1/product/{id}', 'Admin\ProductGroupController@productIndex1');
	Route::get('/admin/product-group/search-product/{id}', 'Admin\ProductGroupController@searchProduct');
	Route::group(['middleware' => ['permission:edit product-group']], function () {
		Route::post('/admin/product-group/edit/{id}', 'Admin\ProductGroupController@update');
		Route::post('/admin/product-group/status/{id}', 'Admin\ProductGroupController@quickStatusUpdate');

		Route::post('/admin/product-group/add-product/{id}', 'Admin\ProductGroupController@addProduct');
		Route::post('/admin/product-group-1/add-product/{id}', 'Admin\ProductGroupController@addProduct1');
		Route::get('/admin/product-group/delete-product/{id}', 'Admin\ProductGroupController@deleteProduct');
	});
	Route::group(['middleware' => ['permission:delete product-group']], function () {
		Route::post('/admin/product-group/trash', 'Admin\ProductGroupController@trash');
	});

	Route::get('/admin/vouchers', 'Admin\VoucherController@showIndex');
	Route::post('/admin/vouchers', 'Admin\VoucherController@index');
	Route::get('/admin/vouchers/create', 'Admin\VoucherController@create');
	Route::group(['middleware' => ['permission:add vouchers']], function () {
		Route::post('/admin/vouchers/store', 'Admin\VoucherController@store');
	});
		Route::get('/admin/vouchers/edit/{id}', 'Admin\VoucherController@edit');
	Route::group(['middleware' => ['permission:edit vouchers']], function () {
		Route::post('/admin/vouchers/edit/{id}', 'Admin\VoucherController@update');
	});
	Route::group(['middleware' => ['permission:delete vouchers']], function () {
		Route::post('/admin/vouchers/trash', 'Admin\VoucherController@trash');
	});

	Route::get('/admin/voucher-theme', 'Admin\VoucherThemeController@showIndex');
	Route::post('/admin/voucher-theme', 'Admin\VoucherThemeController@index');
	Route::get('/admin/voucher-theme/create', 'Admin\VoucherThemeController@create');
	Route::group(['middleware' => ['permission:add voucher-theme']], function () {
		Route::post('/admin/voucher-theme/store', 'Admin\VoucherThemeController@store');
	});
		Route::get('/admin/voucher-theme/edit/{id}', 'Admin\VoucherThemeController@edit');
	Route::group(['middleware' => ['permission:edit voucher-theme']], function () {
		Route::post('/admin/voucher-theme/edit/{id}', 'Admin\VoucherThemeController@update');
		Route::get('/admin/voucher-theme/delete-image/{id}', 'Admin\VoucherThemeController@deleteImage');
	});
	Route::group(['middleware' => ['permission:delete voucher-theme']], function () {
		Route::post('/admin/voucher-theme/trash', 'Admin\VoucherThemeController@trash');
	});

	Route::get('/admin/attribute', 'Admin\AttributeController@showIndex');
	Route::post('/admin/attribute', 'Admin\AttributeController@index');
	Route::get('/admin/attribute/create', 'Admin\AttributeController@create');
	Route::get('/admin/attribute/search-attribute', 'Admin\AttributeController@searchAttribute');
	Route::group(['middleware' => ['permission:add attribute']], function () {
		Route::post('/admin/attribute/store', 'Admin\AttributeController@store');
	});
		Route::get('/admin/attribute/edit/{id}', 'Admin\AttributeController@edit');
	Route::group(['middleware' => ['permission:edit attribute']], function () {
		Route::post('/admin/attribute/edit/{id}', 'Admin\AttributeController@update');
	});
	Route::group(['middleware' => ['permission:delete attribute']], function () {
		Route::post('/admin/attribute/trash', 'Admin\AttributeController@trash');
	});

	Route::get('/admin/attribute-group', 'Admin\AttributeGroupController@showIndex');
	Route::post('/admin/attribute-group', 'Admin\AttributeGroupController@index');
	Route::get('/admin/attribute-group/create', 'Admin\AttributeGroupController@create');
	Route::group(['middleware' => ['permission:add attribute-group']], function () {
		Route::post('/admin/attribute-group/store', 'Admin\AttributeGroupController@store');
	});
		Route::get('/admin/attribute-group/edit/{id}', 'Admin\AttributeGroupController@edit');
	Route::group(['middleware' => ['permission:edit attribute-group']], function () {
		Route::post('/admin/attribute-group/edit/{id}', 'Admin\AttributeGroupController@update');
	});
	Route::group(['middleware' => ['permission:delete attribute-group']], function () {
		Route::post('/admin/attribute-group/trash', 'Admin\AttributeGroupController@trash');
	});

	Route::get('/admin/coupon', 'Admin\CouponController@showIndex');
	Route::post('/admin/coupon', 'Admin\CouponController@index');
	Route::get('/admin/coupon/create', 'Admin\CouponController@create');
	Route::group(['middleware' => ['permission:add coupon']], function () {
		Route::post('/admin/coupon/store', 'Admin\CouponController@store');
	});
		Route::get('/admin/coupon/edit/{id}', 'Admin\CouponController@edit');
	Route::group(['middleware' => ['permission:edit coupon']], function () {
		Route::post('/admin/coupon/edit/{id}', 'Admin\CouponController@update');
	});
	Route::group(['middleware' => ['permission:delete coupon']], function () {
		Route::post('/admin/coupon/trash', 'Admin\CouponController@trash');
	});
	
	Route::get('/admin/blog', 'Admin\BlogController@showIndex');
	Route::post('/admin/blog', 'Admin\BlogController@index');
	Route::get('/admin/blog/create', 'Admin\BlogController@create');
	Route::group(['middleware' => ['permission:add blog']], function () {
		Route::post('/admin/blog/store', 'Admin\BlogController@store');
	});
		Route::get('/admin/blog/edit/{id}', 'Admin\BlogController@edit');
	Route::group(['middleware' => ['permission:edit blog']], function () {
		Route::post('/admin/blog/edit/{id}', 'Admin\BlogController@update');
		Route::get('/admin/blog/delete-image/{id}', 'Admin\BlogController@deleteImage');
		Route::get('/admin/blog/delete-cover/{id}', 'Admin\BlogController@deleteCover');
	});
	Route::group(['middleware' => ['permission:delete blog']], function () {
		Route::post('/admin/blog/trash', 'Admin\BlogController@trash');
	});

	Route::get('/admin/search/blog-category', 'Admin\BlogController@searchBlogCategory');

	Route::get('/admin/payment-method', 'Admin\PaymentMethodController@showIndex');
	Route::post('/admin/payment-method', 'Admin\PaymentMethodController@index');
	// Route::get('/admin/payment-method/create', 'Admin\PaymentMethodController@create');
	// Route::group(['middleware' => ['permission:add payment-method']], function () {
	// 	Route::post('/admin/payment-method/store', 'Admin\PaymentMethodController@store');
	// });
		Route::get('/admin/payment-method/edit/{id}', 'Admin\PaymentMethodController@edit');
	Route::group(['middleware' => ['permission:edit payment-method']], function () {
		Route::post('/admin/payment-method/edit/{id}', 'Admin\PaymentMethodController@update');
		Route::post('/admin/payment-method/{id}', 'Admin\PaymentMethodController@quickStatusUpdate');
	});
	// Route::group(['middleware' => ['permission:delete payment-method']], function () {
	// 	Route::post('/admin/payment-method/trash', 'Admin\PaymentMethodController@trash');
	// });

	Route::get('/admin/shipping-method', 'Admin\ShippingMethodController@showIndex');
	Route::post('/admin/shipping-method', 'Admin\ShippingMethodController@index');
	Route::get('/admin/shipping-method/create', 'Admin\ShippingMethodController@create');
	Route::group(['middleware' => ['permission:add shipping-method']], function () {
		Route::post('/admin/shipping-method/store', 'Admin\ShippingMethodController@store');
	});
		Route::get('/admin/shipping-method/edit/{id}', 'Admin\ShippingMethodController@edit');
	Route::group(['middleware' => ['permission:edit shipping-method']], function () {
		Route::post('/admin/shipping-method/edit/{id}', 'Admin\ShippingMethodController@update');
		Route::post('/admin/shipping-method/{id}', 'Admin\ShippingMethodController@quickStatusUpdate');
			Route::post('/admin/free-shipping', 'Admin\FreeShippingController@index');
			Route::get('/admin/free-shipping/create', 'Admin\FreeShippingController@create');
			Route::post('/admin/free-shipping/store', 'Admin\FreeShippingController@store');
			Route::get('/admin/free-shipping/edit/{id}', 'Admin\FreeShippingController@edit');
			Route::post('/admin/free-shipping/edit/{id}', 'Admin\FreeShippingController@update');
			Route::post('/admin/free-shipping/trash', 'Admin\FreeShippingController@trash');
			Route::post('/admin/free-shipping/{id}', 'Admin\FreeShippingController@quickStatusUpdate');

			Route::post('/admin/kreasi2go', 'Admin\Kreasi2goController@index');
			Route::get('/admin/kreasi2go/create', 'Admin\Kreasi2goController@create');
			Route::post('/admin/kreasi2go/store', 'Admin\Kreasi2goController@store');
			Route::get('/admin/kreasi2go/edit/{id}', 'Admin\Kreasi2goController@edit');
			Route::post('/admin/kreasi2go/edit/{id}', 'Admin\Kreasi2goController@update');
			Route::post('/admin/kreasi2go/trash', 'Admin\Kreasi2goController@trash');
			Route::post('/admin/kreasi2go/{id}', 'Admin\Kreasi2goController@quickStatusUpdate');
	});
	Route::group(['middleware' => ['permission:delete shipping-method']], function () {
		Route::post('/admin/shipping-method/trash', 'Admin\ShippingMethodController@trash');
	});

	Route::get('/admin/shipping-courier', 'Admin\ShippingCourierController@showIndex');
	Route::post('/admin/shipping-courier/{id}', 'Admin\ShippingCourierController@index');
	Route::get('/admin/shipping-courier/create', 'Admin\ShippingCourierController@create');
	Route::group(['middleware' => ['permission:add shipping-courier']], function () {
		Route::post('/admin/shipping-courier/store', 'Admin\ShippingCourierController@store');
	});
		Route::get('/admin/shipping-courier/edit/{id}', 'Admin\ShippingCourierController@edit');
	Route::group(['middleware' => ['permission:edit shipping-courier']], function () {
		Route::post('/admin/shipping-courier/edit/{id}', 'Admin\ShippingCourierController@update');
	});
	Route::group(['middleware' => ['permission:delete shipping-courier']], function () {
		Route::post('/admin/shipping-courier/trash', 'Admin\ShippingCourierController@trash');
	});
	

	Route::post('images-upload', 'Admin\ProductController@imagesUploadPost')->name('images.upload');

	Route::get('/admin/stock', 'Admin\StockController@showIndex');
	Route::post('/admin/stock', 'Admin\StockController@index');

	Route::post('/admin/stock/report', 'Admin\StockController@report');
	Route::post('/admin/stock/excel-report', 'Admin\StockController@excelReport');
	Route::get('/admin/stock/edit/{id}', 'Admin\StockController@edit');
	Route::group(['middleware' => ['permission:edit stock']], function () {
		Route::post('/admin/stock/edit/{id}', 'Admin\StockController@update');
	});

	Route::get('/admin/combination', 'Admin\StockController@showIndexCombination');
	Route::post('/admin/combination', 'Admin\StockController@index');
	Route::group(['middleware' => ['permission:edit stock']], function () {
		Route::post('/admin/update-combination', 'Admin\StockController@updateCombination');
	});

	Route::get('/admin/order', 'Admin\OrderController@showIndex');
	Route::post('/admin/order', 'Admin\OrderController@index');
	Route::get('/admin/order/create', 'Admin\OrderController@create');
	Route::group(['middleware' => ['permission:add order']], function () {
		Route::post('/admin/order/store', 'Admin\OrderController@store');
	});
	Route::get('/admin/order/view/{id}', 'Admin\OrderController@show');
	Route::group(['middleware' => ['permission:add order history']], function () {
		Route::post('/admin/order/add-history/{id}', 'Admin\OrderController@addHistory');
		Route::post('/admin/order/quick-add-order-history/{id}', 'Admin\OrderController@quickAddOrderHistory');
	});
	Route::group(['middleware' => ['permission:delete order']], function () {
		Route::post('/admin/order/trash', 'Admin\OrderController@trash');
	});
	Route::get('/admin/order/edit/{page}/{id}', 'Admin\OrderController@edit');
	Route::group(['middleware' => ['permission:edit order']], function () {
		Route::post('/admin/order/edit/{page}/{id}', 'Admin\OrderController@update');
	});

	Route::group(['middleware' => ['permission:print invoice']], function () {
		Route::post('/admin/order/print-invoice', 'Admin\OrderController@printInvoice');
	});

	Route::group(['middleware' => ['permission:print shipping label']], function () {
		Route::post('/admin/order/print-shipping-label', 'Admin\OrderController@printShippingLabel');
	});
	Route::post('/admin/order/export-to-excel', 'Admin\OrderController@exportToExcel');

	Route::get('/admin/order/search-user', 'Admin\OrderController@searchUser');
	Route::get('/admin/order/get-user/{id}', 'Admin\OrderController@getUser');
	Route::get('/admin/order/search-product', 'Admin\OrderController@searchProduct');
	Route::get('/admin/order/get-product/{cust_group}/{id}/{stock_id}/{qty}/{sqty}', 'Admin\OrderController@getProduct');
	Route::get('/admin/order/get-product-option/{id}', 'Admin\OrderController@getProductOption');
	Route::get('/admin/order/check-stock', 'Admin\OrderController@checkStock');
	Route::post('/admin/order/update-qty/{id}', 'Admin\OrderController@updateQty');
	Route::post('/admin/order/delete-detail/{id}', 'Admin\OrderController@deleteDetail');
	Route::get('/admin/order/search-address-by-user/{id}', 'Admin\OrderController@searchAddressByUser');
	Route::get('/admin/order/search-address/{id}', 'Admin\OrderController@searchAddress');
	Route::get('/admin/order/get-address-by-user/{id}', 'Admin\OrderController@getAddressByUser');
	Route::get('/admin/order/get-address/{id}', 'Admin\OrderController@getAddress');
	Route::get('/admin/user/search-city', 'Admin\UserController@searchCity');
	Route::get('/admin/order/search-city', 'Admin\OrderController@searchCity');
	Route::post('/admin/order/get-cost', 'Admin\OrderController@getShippingCost');

	Route::get('/admin/order/search-blog', 'Admin\OrderController@searchBlog');

	Route::get('/admin/order/test-cost', 'Admin\OrderController@testCost');
	//Route::get('/admin/order/generate-invoice', 'Admin\OrderController@generateInvoice');

});


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
	Route::get('blog/like/{slug}', 'Front\BlogController@handleLike');
	Route::post('post-comment/{slug}', 'Front\BlogController@postComment');
	Route::post('post-comment-reply/{id}', 'Front\BlogController@postCommentReply');
	Route::get('blog-comment/up-vote/{id}', 'Front\BlogController@handleUpvote');
	Route::get('blog-comment/down-vote/{id}', 'Front\BlogController@handleDownvote');
	Route::get('dashboard', 'Front\GeneralController@dashboard')->name('dashboard');
	Route::get('/support-email-preference', 'Front\GeneralController@support_email_preference');
	Route::post('/support-email-preference', 'Front\GeneralController@postSupportEmailPreference');
	Route::get('order-history', 'Front\GeneralController@orderHistory')->name('orderhistory');
	Route::get('my-order', 'Front\GeneralController@orderMydashboard')->name('orderMydashboard');
	Route::get('my-return', 'Front\GeneralController@orderMyreturn')->name('orderMyreturn');
	Route::get('order/{inv}', 'Front\GeneralController@order')->name('order.show');
	Route::get('address', 'Front\GeneralController@address')->name('address');
	Route::get('/address-book', 'Front\GeneralController@address_book');
	Route::get('add-address', 'Front\GeneralController@addAddress')->name('address.add');
	Route::post('add-address', 'Front\GeneralController@createAddress')->name('address.create');
	Route::get('edit-address/{id}', 'Front\GeneralController@editAddress')->name('address.edit');
	Route::post('update-address/{id}', 'Front\GeneralController@updateAddress')->name('address.update');
	Route::get('set-main-address/{id}', 'Front\GeneralController@setMainAddress')->name('address.setmain');
	Route::get('delete-address/{id}', 'Front\GeneralController@deleteAddress')->name('address.delete');
	Route::post('update-profile', 'Front\GeneralController@updateProfile')->name('profile.update');
	Route::post('update-email', 'Front\GeneralController@updateEmail')->name('profile.update.email');
	Route::post('update-password', 'Front\GeneralController@updatePassword')->name('profile.update.password');
	Route::post('post-discussion/{slug}', 'Front\GeneralController@postDiscussion')->name('discussion.post');
	Route::post('add-to-cart', 'Front\GeneralController@addToCart');
	Route::get('cart', 'Front\GeneralController@cart')->name('cart');
	Route::get('handle-wishlist/{id}', 'Front\GeneralController@handleWishlist')->name('wishlist.handle');
	Route::get('wishlist', 'Front\GeneralController@wishlist')->name('wishlist');
	Route::get('check-cart-total', 'Front\GeneralController@checkCartTotal')->name('cart.total');
	Route::get('clear-cart', 'Front\GeneralController@clearCart')->name('cart.clear');
	Route::get('update-cart-xhr', 'Front\GeneralController@updateCartXhr');
	Route::post('update-cart', 'Front\GeneralController@updateCart');
	Route::post('remove-cart-item', 'Front\GeneralController@removeCartItem');
	Route::post('submit-coupon', 'Front\GeneralController@submitCoupon');

	Route::get('/checkout', 'Front\GeneralController@checkoutNew')->name('checkout');
	//Route::get('checkout', 'Front\GeneralController@checkout')->name('checkout');
	Route::post('checkout', 'Front\GeneralController@postCheckout')->name('checkout.post');
	//Route::get('confirmation/{invoice}', 'Front\GeneralController@confirmation')->name('confirmation');
	Route::get('/confirmation/{invoice}', 'Front\GeneralController@confirmationNew')->name('confirmation');
	
	Route::get('submit-review/{inv}', 'Front\GeneralController@showSubmitReview');
	Route::post('submit-review/{id}', 'Front\GeneralController@postSubmitReview');
	Route::post('return/{inv}', 'Front\GeneralController@return')->name('order.return');
	Route::get('return/{inv}', 'Front\GeneralController@showReturnForm')->name('order.createreturn');
	Route::get('/return', 'Front\GeneralController@returns');

	Route::post('support-issue', 'Front\GeneralController@postSupportIssue')->name('supportissue.post');
	Route::get('support-issue-detail/{id}', 'Front\GeneralController@showSupportIssueDetail');
	Route::get('download-attachment/{id}', 'Front\GeneralController@downloadAttachment');
	Route::get('/support-issue', 'Front\GeneralController@support_issue');
	Route::get('/support-issue-detail', 'Front\GeneralController@support_issue_detail');

	Route::get('check-payment/{order_id}', 'Front\NicepayController@checkStatus')->name('checkstatus');
});

Route::get('blog/shared/{slug}', 'Front\BlogController@handleShared');

Route::get('tentang-kami', 'Front\GeneralController@tentangKami')->name('tentangKami');
Route::get('faq/akun', 'Front\GeneralController@akun')->name('akun');
Route::get('faq/cara-belanja', 'Front\GeneralController@caraBelanja')->name('caraBelanja');
Route::get('faq/form-retur', 'Front\GeneralController@formRetur')->name('formRetur');
Route::get('faq/garansi', 'Front\GeneralController@garansi')->name('garansi');
Route::get('faq/hubungi-kami', 'Front\GeneralController@hubungiKami')->name('hubungiKami');
Route::get('faq/kenapa-beli', 'Front\GeneralController@kenapaBeli')->name('kenapaBeli');
Route::get('faq/kupon-diskon', 'Front\GeneralController@kuponDiskon')->name('kuponDiskon');
Route::get('faq/mitra-kami', 'Front\GeneralController@mitraKami')->name('mitraKami');
Route::get('faq/pembayaran', 'Front\GeneralController@pembayaran')->name('pembayaran');
Route::get('faq/pengiriman', 'Front\GeneralController@pengiriman')->name('pengiriman');
Route::get('faq/retur', 'Front\GeneralController@returFaq')->name('returFaq');
Route::get('faq/service-center', 'Front\GeneralController@serviceCenter')->name('serviceCenter');
Route::get('faq/umum', 'Front\GeneralController@umum')->name('umum');
Route::get('faq', 'Front\GeneralController@faq')->name('faq');
//tambahan cbd
// Route::get('/checkoutNew', 'Front\GeneralController@checkoutNew');
// Route::get('/confirmationNew', 'Front\GeneralController@confirmationNew');
Route::get('/recent', 'Front\GeneralController@recent');
Route::get('/review', 'Front\GeneralController@review');
Route::get('/advanced-search', 'Front\GeneralController@advanced_search');
Route::get('/contact-us', 'Front\GeneralController@contact_us');
Route::get('/contact-us-form', 'Front\GeneralController@postContactUs');
// Route::get('/address-book', 'Front\GeneralController@address_book');
Route::get('/new-issue-contact-us', 'Front\GeneralController@new_issue_contact_us');
Route::get('/dashboard-orders', 'Front\GeneralController@dashboard_orders');
// Route::get('/support-email-preference', 'Front\GeneralController@support_email_preference');


Route::get('/support-issue-detail', 'Front\GeneralController@support_issue_detail');
Route::get('/order-detail-order-finished', 'Front\GeneralController@order_detail_order_finished');
Route::get('/order-detail-order-made', 'Front\GeneralController@order_detail_order_made');
Route::get('/order-detail-order-paid', 'Front\GeneralController@order_detail_order_paid');
Route::get('/order-detail-order-receive', 'Front\GeneralController@order_detail_order_receive');
Route::get('/order-detail-order-sent', 'Front\GeneralController@order_detail_order_sent');
Route::get('/rating', 'Front\GeneralController@rating');
Route::get('/return-form', 'Front\GeneralController@return_form');
Route::get('/return-item', 'Front\GeneralController@return_item');
//end tambahan cbd
Route::get('api-search', 'Front\GeneralController@apiSearch');
Route::get('find', 'Front\GeneralController@find');
Route::get('find-blog', 'Front\BlogController@find');

Route::get('search-city', 'Front\GeneralController@searchCity');
Route::get('search-subdistrict', 'Front\GeneralController@searchSubdistrict');
Route::get('search-postal-code', 'Front\GeneralController@searchPostalCode');
Route::post('check-stock', 'Front\GeneralController@checkStock');

Route::get('/', 'Front\GeneralController@index')->name('index');


Route::get('register/verify/{confirmationCode}', [
	'as' => 'confirmation_path',
	'uses' => 'Front\GeneralController@confirm'
]);

Route::get('login/{provider}',          'Auth\SocialAccountController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback');

Route::get('search',  ['as' => 'search', 'uses' => 'Front\GeneralController@search']);
Route::get('search/{cat?}',  ['as' => 'search', 'uses' => 'Front\GeneralController@search']);

Route::get('test-mail/{inv}', 'Front\GeneralController@testCheckoutMail');

Route::get('news', 'Front\BlogController@index');
Route::get('berita', 'Front\BlogController@index');
Route::get('blog', 'Front\BlogController@index')->name('blog');
Route::get('blog/{slug}', 'Front\BlogController@show')->name('blog.detail');
Route::get('blog/tag/{category}', 'Front\BlogController@indexTag')->name('blog.tag');
Route::get('blog/retrieve-comment/{slug}', 'Front\BlogController@retrieveComment');
Route::get('discussion/{slug}', 'Front\GeneralController@viewProductDiscussion');
Route::get('review/{slug}', 'Front\GeneralController@viewProductReview');
Route::get('{slug}', 'Front\GeneralController@viewProduct');
