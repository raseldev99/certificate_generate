<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class Download extends Controller
{
    public function index()
	{
		$path = storage_path("certificates");
		$files = File::allFiles($path);
		$file_names = [];
		foreach ($files as $file) {
			$file_names[] = basename($file);
		}
		return view('download',['file_names'=>$file_names]);
	}
	
	public function download($name)
	{
		$path = storage_path("certificates");
		return response()->download($path.'/'.$name);
	}
	
	public function delete($name)
	{
		$path = storage_path("certificates/".$name);
		if (File::exists($path)){
			File::delete($path);
		}
		flash()->addSuccess('Delete successfully');
		return redirect()->back();
	}
}
