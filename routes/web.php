<?php
	
	use App\Http\Controllers\Download;
	use App\Http\Controllers\Image;
	use App\Http\Controllers\Managefont;
	use Illuminate\Support\Facades\Route;
	
Route::middleware(['auth','verified'])->group(function (){
	Route::view('/', 'welcome');
	Route::get('/download',[Download::class,'index'])->name('download');
	Route::get('/download/{name}',[Download::class,'download'])->name('download_file');
	Route::get('/download_d/{name}',[Download::class,'delete'])->name('delete_file');
	Route::get('/select_or_upload_img',[Image::class,'index'])->name('select_or_upload');
	Route::post('/upload_template',[Image::class,'upload_template'])->name('upload_template');
	Route::get('/delete_template/{name}',[Image::class,'delete_template'])->name('delete_template');
	Route::get('/generate_certificates/{template_url}',[Image::class,'certificate'])->name('certificate');
	Route::get('upload_font',[Managefont::class,'index'])->name('upload_font');
	Route::post('upload_font',[Managefont::class,'upload'])->name('upload_font');
	Route::get('delete_font/{name}',[Managefont::class,'delete'])->name('delete_font');
});


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
