<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Managefont extends Controller
{
    public function index()
	{
		$path = public_path('/fonts');
		$files = File::allFiles($path);
		$fonts = [];
		foreach ($files as $file) {
			$fonts[] = basename($file);
		}
		
		return view('upload_font',compact('fonts','path'));
	}
	
	public function upload(Request $request)
	{
		$request->validate([
			'font_name'=>'required|string|regex:/^[a-zA-Z0-9\s()]+$/|max:20',
			'font_file'=>'required|file|mimetypes:font/ttf,font/sfnt|max:1024'
		],[
			'font_file.max'=>'The font size cannot exceed 1MB.'
		]);
		$font_file= $request->file('font_file');

		$path = public_path('fonts');
		$file_name = $request->font_name . '.'. $font_file->getClientOriginalExtension();
		
		if (file_exists($path.'/'.$file_name)){
			return redirect()->back()->withErrors(['font_name'=>'This name already exist. Choose defendant name'])->withInput(['font_name'=>$request->font_name]);
		}
		
		$font_file->move($path, $file_name);
		
		flash()->addSuccess('font uploaded successfully');
		return  redirect()->back();
	}
	
	public function delete($name)
	{
		$path = public_path("fonts/".$name);
		if (File::exists($path)){
			File::delete($path);
		}
		
		flash()->addSuccess('Font delete successfully');
		return  redirect()->back();
	}
}
