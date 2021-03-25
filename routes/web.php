<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Row;

Route::get('/index.php', function(){
    return redirect('/');
});

Auth::routes();
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});
//BACK
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('dashboard');
});


Route::prefix('admin')->middleware(['isAdmin'])->group(function () {
        Route::resource('/user', \App\Http\Controllers\Admin\UserManagment\UserController::class);
        Route::get('/review_client',[App\Http\Controllers\Admin\ReviewClientController::class,'showReview']);
        Route::post('/review_client/{id}/destroy',[App\Http\Controllers\Admin\ReviewClientController::class,'destroyReview'])->name('review.delete');
        Route::post('/review_client/{id}/update',[App\Http\Controllers\Admin\ReviewClientController::class,'updateReview'])->name('reviews.update');
        Route::post('/review_client/{id}/edit',[App\Http\Controllers\Admin\ReviewClientController::class,'updateReview'])->name('reviews.edit');


});


    Route::prefix('admin')->middleware(['isOperator'])->group(function () {
        Route::get('/orders', [App\Http\Controllers\Admin\DashboardController::class, 'orders'])->name('orders');
        Route::post('/product/image/{id}/delete/', [App\Http\Controllers\Admin\ProductController::class,'deleteImage' ])->name('product-image-delete');
        //Route::resource('/main', \App\Http\Controllers\Admin\MainController::class);
        Route::resource('/product', \App\Http\Controllers\Admin\ProductController::class);
        Route::resource('/about', \App\Http\Controllers\Admin\AboutController::class);
        Route::get('/sale', [\App\Http\Controllers\Admin\AboutController::class, 'createSale']);
        Route::post('/sale', [\App\Http\Controllers\Admin\AboutController::class, 'storeSale']);
        Route::get('/brands', [\App\Http\Controllers\Admin\AboutController::class, 'createBrands']);
        Route::post('/brands', [\App\Http\Controllers\Admin\AboutController::class, 'storeBrands']);
        Route::get('/service_page', [\App\Http\Controllers\Admin\AboutController::class, 'createService']);
        Route::post('/service_page', [\App\Http\Controllers\Admin\AboutController::class, 'storeService']);
        Route::get('/partners_page', [\App\Http\Controllers\Admin\AboutController::class, 'createPartner']);
        Route::post('/partners_page', [\App\Http\Controllers\Admin\AboutController::class, 'storePartner']);
        Route::post('/contact_page', [\App\Http\Controllers\Admin\AboutController::class, 'storeContact']);
        Route::post('/home_page', [\App\Http\Controllers\Admin\AboutController::class, 'storeHome']);
        //Route::get('/about-delete-img',[\App\Http\Controllers\Admin\AboutController::class,'deleteImg']);
        Route::resource('/description', \App\Http\Controllers\Admin\DescriptionController::class);
        Route::get('/link-description-delete/{id}', [\App\Http\Controllers\Admin\DescriptionController::class, 'destroyDesc']);
        Route::resource('/gallery', \App\Http\Controllers\Admin\AboutGalleryController::class);
        Route::resource('/service',\App\Http\Controllers\Admin\ServiceController::class);
        Route::get('/link-service-delete/{id}', [\App\Http\Controllers\Admin\ServiceController::class, 'destroyServ']);
        Route::resource('/slider',\App\Http\Controllers\Admin\SliderController::class);
        Route::resource('/banner',\App\Http\Controllers\Admin\BannerController::class);
        Route::get('/criterion',[App\Http\Controllers\Admin\CriterionController::class,'index'])->name('criterion.index');
        Route::resource('/brand', \App\Http\Controllers\Admin\BrandController::class);
        Route::resource('/filters', \App\Http\Controllers\Admin\FilterController::class);
        Route::resource('/color', \App\Http\Controllers\Admin\ColorController::class);
        Route::resource('/country', \App\Http\Controllers\Admin\CountryController::class);
        Route::resource('/category', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('/review', \App\Http\Controllers\Admin\ReviewController::class);
        Route::resource('/social', \App\Http\Controllers\Admin\SocialController::class);
        Route::resource('/contact', \App\Http\Controllers\Admin\ContactController::class);
        Route::resource('/info', \App\Http\Controllers\Admin\InfoShowController::class);

        Route::post('/api-update-status',[App\Http\Controllers\Admin\ProductController::class,'apiUpdateStatus'])->name('api_update_status');
        Route::post('/api-feature-add',[App\Http\Controllers\Admin\ProductController::class,'featureAdd'])->name('add_feature');
        Route::post('/api-feature-delete',[App\Http\Controllers\Admin\ProductController::class,'featureRemove'])->name('add_feature');
        Route::post('/api-filter-edit',[App\Http\Controllers\Admin\FilterController::class,'apiFilter'])->name('add_filter_edit');
        Route::get('/api-delete-position/{id}',[App\Http\Controllers\Admin\ProductController::class,'apiDeletePosition'])->name('api_delete_position');

        Route::get('/import',[App\Http\Controllers\Admin\ProductController::class,'import'])->name('import');
        Route::post('/import/import-excel',[App\Http\Controllers\Admin\ImportController::class,'importExcel'])->name('import_excel');
        Route::get('/export/export-excel',[App\Http\Controllers\Admin\ExportController::class,'exportExcel'])->name('export_excel');
        Route::get('/import-zip',[App\Http\Controllers\Admin\ProductController::class,'importZip'])->name('import_zip');
        Route::post('/import-zip/import-img-zip',[App\Http\Controllers\Admin\ImportController::class,'importZip'])->name('import_img_zip');
});

Route::prefix('admin')->middleware(['isManager','isAdmin'])->group(function () {
    Route::resource('/blog', \App\Http\Controllers\Admin\BlogController::class);
    Route::get('call/{id}/edit',[App\Http\Controllers\Admin\CallBackController::class,'editCall'])->name('call.edit');
    Route::get('callUrl/{id}/edit',[App\Http\Controllers\Admin\CallBackController::class,'editCallUrl'])->name('callUrl.edit');
    Route::put('call/{id}/update',[App\Http\Controllers\Admin\CallBackController::class,'updateCall'])->name('call.update');
    Route::put('callUrl/{id}/update',[App\Http\Controllers\Admin\CallBackController::class,'updateCallUrl'])->name('callUrl.update');
    Route::delete('call/{id}/destroy',[App\Http\Controllers\Admin\CallBackController::class,'destroyCall'])->name('call.destroy');
    Route::delete('callUrl/{id}/destroy',[App\Http\Controllers\Admin\CallBackController::class,'destroyCallUrl'])->name('callUrl.destroy');
});
Route::post('/api-filter',[App\Http\Controllers\Client\BlogInnerController::class,'apiFilter'])->name('api_filter');

Route::post('/api-favorites',[App\Http\Controllers\Client\BlogInnerController::class,'apiFavorites'])->name('api_favorites');
Route::post('/api-review',[App\Http\Controllers\Admin\ReviewController::class,'apiReview'])->name('api_review');

Route::get('/favorites', function () {
    return view('site.favorites')->render();
});



Route::post('/ajax-search',[App\Http\Controllers\Client\BlogInnerController::class,'ajaxSearch'])->name('ajax_search');
Route::post('/rating_count',[App\Http\Controllers\Client\BlogInnerController::class,'ratingCount']);
Route::get('/search',[App\Http\Controllers\Client\BlogInnerController::class,'search'])->name('search');

Route::get('/catalog/{catalog_name?}',[App\Http\Controllers\Client\CategoryController::class,'showCatalog'])->name('catalog_show');
Route::get('/catalog/{category}/{sub_category}',[App\Http\Controllers\Client\CategoryController::class,'showSubCatalog'])->name('sub_catalog_show');

Route::get('/product/{product_slug}',[App\Http\Controllers\Client\ProductInnerController::class,'show'])->name('product.inner');
Route::get('/',[App\Http\Controllers\Client\MainController::class,'show'])->name('main');
Route::get('about',[App\Http\Controllers\Client\AboutController::class,'show'])->name('about');
Route::get('sales',[App\Http\Controllers\Client\BlogInnerController::class,'sales'])->name('sales');
Route::get('service',[App\Http\Controllers\Client\ServiceController::class,'show'])->name('service');
Route::get('partners',[App\Http\Controllers\Client\BlogInnerController::class,'partners'])->name('partners');
Route::get('brands',[App\Http\Controllers\Client\BrandController::class,'show'])->name('brands');
Route::get('contact',[App\Http\Controllers\Client\ContactController::class,'show'])->name('contact');
Route::get('/brands/{name}',[App\Http\Controllers\Client\BrandController::class,'showInner'])->name('brand.inner');


//Route::post('/',[App\Http\Controllers\Admin\CallBackController::class,'createCall']);
Route::post('/product_url',[App\Http\Controllers\Admin\CallBackController::class,'createRequest']);
Route::post('/review',[App\Http\Controllers\Admin\ReviewClientController::class,'createReview']);
