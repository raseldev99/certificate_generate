<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Image extends Controller
{
    public function index()
	{
		$path = public_path('/templates');
		$files = File::allFiles($path);
		$file_names = [];
		foreach ($files as $file) {
			$file_names[] = basename($file);
		}
		
		return view('select_or_upload',compact('file_names','path'));
	}
	
	public function certificate($template_url)
	{
		return view('welcome',compact('template_url'));
	}
	
	public function upload_template(Request $request)
	{
		$request->validate([
			'template'=>'required|image|mimes:jpeg,png,jpg|max:3072',
			'template_name' => 'required|string|max:100|regex:/^[a-zA-Z0-9\s]+$/'
		], [
			'template.max'=>'The image size cannot exceed 3MB.'
		]);
	    $template = $request->file('template');
		$path = public_path('templates');
		$file_name = Str::slug($request->template_name) . '.'. $template->getClientOriginalExtension();
		
		if (file_exists($path.'/'.$file_name)){
			return redirect()->back()->withErrors(['template_name'=>'This name already exist. Choose defendant name'])->withInput(['template_name'=>$request->template_name]);
		}
		
		$template->move($path, $file_name);
		
		flash()->addSuccess('Template uploaded successfully');
		return  redirect()->back();
	}
	public function delete_template($name)
	{
		$path = public_path("templates/".$name);
		if (File::exists($path)){
			File::delete($path);
		}
		
		flash()->addSuccess('Template Delete successfully');
		return  redirect()->back();
	}
}
