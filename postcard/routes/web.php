<?php
use App\Http\Middleware\LocalizationMiddleware;


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

// default
// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function(){
    $view = view('en.welcome_message_card');
    $view->with( 'current_route_name', 'welcome_message_card' );
    return $view; 
});
// out of auth so that indivisual user can download pdf
Route::any('/download_proc/{id}', 'HomeController@singleDownloadProc')->name('single_download_proc');

Route::group( ['middleware' => 'auth'],function(){
    Route::any('/admin', 'HomeController@index')->name('home');
    Route::any('/home', 'HomeController@index')->name('home');
    Route::any('/dashboard', 'HomeController@goDashboard')->name('dashboard');
    Route::any('/entry_import_file', 'HomeController@entryImportFile')->name('entry_import_file');
    Route::post('/import_csv', 'HomeController@importCsv')->name('import_csv');
    Route::any('/order_list', 'HomeController@showOrderList')->name('order_list');
    Route::any('/message_list', 'HomeController@showMessageList')->name('message_list');
    Route::post('/multi_download_proc', 'HomeController@multiDawnloadProc')->name('multi_download_proc');
} );
Route::group([ 'prefix' => '/{lang}/', 'middleware' => 'localization' ], function(){
    Route::any('/', 'PDFController@welcome_message_card')->name('welcome_message_card');
    Route::any( '/select_card_type', 'PDFController@selectCardType' )->name( 'select_card_type' );
    Route::any('/upload', 'PDFController@upload')->name('upload');
    Route::post('/upload_proc', 'PDFController@uploadProc')->name('upload_proc');
    Route::any('/preview/{id}', 'PDFController@preview')->name('preview');
    Route::any('/register_proc', 'PDFController@registerProc')->name('register_proc');
    Route::any('/createpdf/{id}', 'PDFController@createPdf')->name('create_pdf');
    Route::any('/resize', 'PDFController@resizeImage' )->name('resize');
    Route::any('/download_pdf/{id}', 'PDFController@downloadPdf' )->name('download_pdf');
});
Route::any('/entry_orderid', 'PDFController@entry_orderid')->name('entry_orderid'); // corperate use
Route::post('/check_orderid', 'PDFController@check_orderid')->name('check_orderid'); // corperate use
Route::any('/complete', 'PDFController@complete' )->name('complete'); // corperate use

Route::get('/sys_img/{id}', 'ImageController@get'); // haven't done yet! Do it to protect img

