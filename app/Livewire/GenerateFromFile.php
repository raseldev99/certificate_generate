<?php

namespace App\Livewire;
use App\Imports\NameImport;
use App\Jobs\GenerateZip;
use App\Jobs\ProcessImage;
use Carbon\Carbon;
use DantSu\PHPImageEditor\Image;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;

class GenerateFromFile extends Component
{
	use WithFileUploads;
	public array $is_customs = [
		'position_x'=>false,
		'position_y'=>true,
		'anchor_x' => false,
		'anchor_y' => false
	];
	
	public  $file;
	public string $template_url;
	public $font_size = 100;
	public $font_color  = '#000000';
	public $position_x_s = Image::ALIGN_CENTER;
	public $position_x = 0;
	public $position_y_s = Image::ALIGN_TOP;
	public $position_y = 1446;
	
	public $anchor_x = 0;
	public $anchor_x_s = Image::ALIGN_CENTER;
	public $anchor_y = 0;
	public $anchor_y_s = Image::ALIGN_TOP;
	public $rotation = 0;
	public $letterSpacing = 1.5;
	public array $form_errors = [];
	
	public array $names = [];
	public string $issue_date = '18 April, 2024';
	public string $successful_text = 'Has successfully achieved the certificate of the 6 hours long';
	public string $course_name = "‘Digital Marketing (3 days training)’.";
	
	public string $preview_img;
	public string $preview_name = "Rasel Ahmed";
	
	public string $type = 'jpg';
	public string $font = 'font.ttf';
	public bool $isDefault = true;
	
    public function render()
    {
		$this->font_size = (float) $this->font_size;
		$this->position_x = (float) $this->position_x;
		$this->position_y = (float) $this->position_y;
		$this->anchor_x = (float) $this->anchor_x;
		$this->anchor_y = (float) $this->anchor_y;
		$this->rotation = (float) $this->rotation;
		$this->letterSpacing = (float) $this->letterSpacing;
		
		$position_x = $this->is_customs['position_x'] ? $this->position_x : $this->position_x_s;
		$position_y = $this->is_customs['position_y'] ? $this->position_y : $this->position_y_s;
		
		$anchor_x = $this->is_customs['anchor_x'] ? $this->anchor_x : $this->anchor_x_s;
		$anchor_y = $this->is_customs['anchor_y'] ? $this->anchor_y : $this->anchor_y_s;
		
		if ($this->font === 'font.ttf'){
			$font_path = base_path('public/'.$this->font);
		}elseif (!file_exists(base_path('public/fonts/'.$this->font))){
			return flash()->addWarning('Font not found!');
		}else{
			$font_path = base_path('public/fonts/'.$this->font);
		}
		
		if (!empty($this->template_url)){
			$this->preview_img = Image::fromPath(base_path('public/templates/'.$this->template_url))
				->writeText($this->preview_name,$font_path,$this->font_size,$this->font_color,$position_x,$position_y,$anchor_x,$anchor_y,$this->rotation,$this->letterSpacing)
				->getBase64SourcePNG(100);
		}else{
			$this->preview_img = Image::fromPath( base_path('/public/default_template.jpg'))
				->writeText($this->preview_name,$font_path,$this->font_size,$this->font_color,$position_x,$position_y,$anchor_x,$anchor_y,$this->rotation,$this->letterSpacing)
				->writeText($this->successful_text,base_path('public/roboto-light.ttf'),48,'#000000',Image::ALIGN_CENTER,1630,Image::ALIGN_CENTER,Image::ALIGN_TOP)
				->writeText($this->course_name,base_path('public/font.ttf'),48,'#000000',Image::ALIGN_CENTER,1723,Image::ALIGN_CENTER,Image::ALIGN_TOP)
				->writeText($this->issue_date,base_path('public/roboto-regular.ttf'),36,'#000000',722,2087,Image::ALIGN_LEFT,Image::ALIGN_TOP)
				->getBase64SourcePNG(100);
		}
		
		$path = public_path('/fonts');
		$files = File::allFiles($path);
		$fonts = [];
		foreach ($files as $file) {
			$fonts[basename($file)] = pathinfo($file->getFilename(), PATHINFO_FILENAME);
		}
        return view('livewire.generate-from-file',compact('fonts'));
    }
	
	protected function rules()
	{
		return[
			'file'=>'required|file|mimes:xlsx,xls,csv',
			'type'=> 'required|string|in:jpg,png',
			'font'=> 'required',
			'preview_name'=>'required'
		];
	}
	
	public function preview()
	{
		$this->dispatch('$refresh');
	}
	
	
	public function download()
	{
		$this->font_size = (float) $this->font_size;
		$this->position_x = (float) $this->position_x;
		$this->position_y = (float) $this->position_y;
		$this->anchor_x = (float) $this->anchor_x;
		$this->anchor_y = (float) $this->anchor_y;
		$this->rotation = (float) $this->rotation;
		$this->letterSpacing = (float) $this->letterSpacing;
		
		$position_x = $this->is_customs['position_x'] ? $this->position_x : $this->position_x_s;
		$position_y = $this->is_customs['position_y'] ? $this->position_y : $this->position_y_s;
		
		$anchor_x = $this->is_customs['anchor_x'] ? $this->anchor_x : $this->anchor_x_s;
		$anchor_y = $this->is_customs['anchor_y'] ? $this->anchor_y : $this->anchor_y_s;
		
		if ($this->font === 'font.ttf'){
			$font_path = base_path('public/'.$this->font);
		}elseif (!file_exists(base_path('public/fonts/'.$this->font))){
			return flash()->addWarning('Font not found!');
		}else{
			$font_path = base_path('public/fonts/'.$this->font);
		}
		
		if (!empty($this->template_url) && !file_exists(base_path('public/templates/'.$this->template_url))){
			return flash()->addWarning('Selected Template not Exist!');
		}elseif (!empty($this->template_url)){
			$src = base_path('public/templates/'.$this->template_url);
		}else{
			$src = base_path('/public/default_template.jpg');
		}
		
		$path = public_path('/temp_certificates');
	 
		if ($this->isDefault){
			if ($this->type === 'png'){
				Image::fromPath($src)
					->writeText($this->preview_name,$font_path,$this->font_size,$this->font_color,$position_x,$position_y,$anchor_x,$anchor_y,$this->rotation,$this->letterSpacing)
					->writeText($this->successful_text,base_path('public/roboto-light.ttf'),48,'#000000',Image::ALIGN_CENTER,1630,Image::ALIGN_CENTER,Image::ALIGN_TOP)
					->writeText($this->course_name,base_path('public/font.ttf'),48,'#000000',Image::ALIGN_CENTER,1723,Image::ALIGN_CENTER,Image::ALIGN_TOP)
					->writeText($this->issue_date,base_path('public/roboto-regular.ttf'),36,'#000000',722,2087,Image::ALIGN_LEFT,Image::ALIGN_TOP)
					->savePNG($path.'/'.$this->preview_name.'.png');
				return response()->download($path.'/'.$this->preview_name.'.png')->deleteFileAfterSend(true);
			}else{
				Image::fromPath($src)
					->writeText($this->preview_name,$font_path,$this->font_size,$this->font_color,$position_x,$position_y,$anchor_x,$anchor_y,$this->rotation,$this->letterSpacing)
					->writeText($this->successful_text,base_path('public/roboto-light.ttf'),48,'#000000',Image::ALIGN_CENTER,1630,Image::ALIGN_CENTER,Image::ALIGN_TOP)
					->writeText($this->course_name,base_path('public/font.ttf'),48,'#000000',Image::ALIGN_CENTER,1723,Image::ALIGN_CENTER,Image::ALIGN_TOP)
					->writeText($this->issue_date,base_path('public/roboto-regular.ttf'),36,'#000000',722,2087,Image::ALIGN_LEFT,Image::ALIGN_TOP)
					->saveJPG($path.'/'.$this->preview_name.'.jpg',100);
				return response()->download($path.'/'.$this->preview_name.'.jpg')->deleteFileAfterSend(true);
			}
		}else{
			if ($this->type === 'png'){
				Image::fromPath($src)
					->writeText($this->preview_name,$font_path,$this->font_size,$this->font_color,$position_x,$position_y,$anchor_x,$anchor_y,$this->rotation,$this->letterSpacing)
					->savePNG($path.'/certificates'.'.png');
				return response()->download($path.'/certificates'.'.png')->deleteFileAfterSend(true);
			}else{
				Image::fromPath($src)
					->writeText($this->preview_name,$font_path,$this->font_size,$this->font_color,$position_x,$position_y,$anchor_x,$anchor_y,$this->rotation,$this->letterSpacing)
					->saveJPG($path.'/certificates'.'.jpg',100);
				return response()->download($path.'/certificates'.'.jpg')->deleteFileAfterSend(true);
			}
		}
	}
	
	
	public function generate()
	{
		$this->validate();
		$data  = Excel::toArray(new NameImport(),$this->file);
		foreach ($data[0] as $item){
			if (is_array($item) && isset($item['name'])) {
				$this->names[] = $item['name'];
			}
		}
		if (count($this->names) < 1){
			return $this->form_errors['file'] = 'Not getting any error from this file. Please modify this file there must have a name header';
		}
		$this->font_size = (float) $this->font_size;
		$this->position_x = (float) $this->position_x;
		$this->position_y = (float) $this->position_y;
		$this->anchor_x = (float) $this->anchor_x;
		$this->anchor_y = (float) $this->anchor_y;
		$this->rotation = (float) $this->rotation;
		$this->letterSpacing = (float) $this->letterSpacing;
		
		$position_x = $this->is_customs['position_x'] ? $this->position_x : $this->position_x_s;
		$position_y = $this->is_customs['position_y'] ? $this->position_y : $this->position_y_s;
		
		$anchor_x = $this->is_customs['anchor_x'] ? $this->anchor_x : $this->anchor_x_s;
		$anchor_y = $this->is_customs['anchor_y'] ? $this->anchor_y : $this->anchor_y_s;
		
		if (!empty($this->template_url) && !file_exists(base_path('public/templates/'.$this->template_url))){
			return flash()->addWarning('Selected Template not Exist!');
		}elseif (!empty($this->template_url)){
			$src = base_path('public/templates/'.$this->template_url);
		}else{
			$src = base_path('/public/default_template.jpg');
		}
		if ($this->font === 'font.ttf'){
			$font_path = public_path($this->font);
		}elseif (!file_exists(public_path('fonts/'.$this->font))){
			return flash()->addWarning('Font not found!');
		}else{
			$font_path = public_path('fonts/'.$this->font);
		}
//	   ProcessImage::withChain([new GenerateZip($path)])->dispatch($this->names,[
//		   'font_size'=>$this->font_size,
//		   'font_color'=>$this->font_color,
//		   'position_x'=>$position_x,
//		   'position_y'=>$position_y,
//		   'anchor_x'=>$anchor_x,
//		   'anchor_y'=>$anchor_y,
//		   'rotation' => $this->rotation,
//		   'letterSpacing' => $this->letterSpacing,
//		   'src'=> $src,
//		   'type'=>$this->type,
//		   'font'=>$font_path
//	   ]);
		
		if (File::exists(public_path('/certificates'))){
			File::deleteDirectory(public_path('/certificates'));
		}
		File::makeDirectory(public_path('/certificates'));
		$store_path = public_path('/certificates/');
		$light_font = base_path('public/roboto-light.ttf');
		$medium_font = base_path('public/font.ttf');
		$regular_font = base_path('public/roboto-regular.ttf');
		if ($this->isDefault){
			if ($this->type === 'jpg'){
				foreach ($this->names as $index => $name){
					Image::fromPath($src)
						->writeText($name, $font_path,$this->font_size,$this->font_color,$position_x,$position_y,$anchor_x,$anchor_y,$this->rotation,$this->letterSpacing)
						->writeText($this->successful_text,$light_font,48,'#000000',Image::ALIGN_CENTER,1630,Image::ALIGN_CENTER,Image::ALIGN_TOP)
						->writeText($this->course_name,$medium_font,48,'#000000',Image::ALIGN_CENTER,1723,Image::ALIGN_CENTER,Image::ALIGN_TOP)
						->writeText($this->issue_date,$regular_font,36,'#000000',722,2087,Image::ALIGN_LEFT,Image::ALIGN_TOP)
						->saveJPG($store_path.($index + 1).'.'.$name.'.jpg',100);
				}
			}elseif ($this->type === 'png'){
				foreach ($this->names as $index => $name){
					Image::fromPath($src)
						->writeText($name, $font_path,$this->font_size,$this->font_color,$position_x,$position_y,$anchor_x,$anchor_y,$this->rotation,$this->letterSpacing)
						->writeText($this->successful_text,$light_font,48,'#000000',Image::ALIGN_CENTER,1630,Image::ALIGN_CENTER,Image::ALIGN_TOP)
						->writeText($this->course_name,$medium_font,48,'#000000',Image::ALIGN_CENTER,1723,Image::ALIGN_CENTER,Image::ALIGN_TOP)
						->writeText($this->issue_date,$regular_font,36,'#000000',722,2087,Image::ALIGN_LEFT,Image::ALIGN_TOP)
						->savePNG($store_path.($index + 1).'.'.$name.'.png');
				}
			}
		}else{
			if ($this->type === 'jpg'){
				foreach ($this->names as $index => $name){
					Image::fromPath($src)
						->writeText($name, $font_path,$this->font_size,$this->font_color,$position_x,$position_y,$anchor_x,$anchor_y,$this->rotation,$this->letterSpacing)
						->saveJPG($store_path.($index + 1).'.'.$name.'.jpg',100);
				}
			}elseif ($this->type === 'png'){
				foreach ($this->names as $index => $name){
					Image::fromPath($src)
						->writeText($name, $font_path,$this->font_size,$this->font_color,$position_x,$position_y,$anchor_x,$anchor_y,$this->rotation,$this->letterSpacing)
						->savePNG($store_path.($index + 1).'.'.$name.'.png');
				}
			}
		}
		
		//Generate zip file of certificates
		$folderPath = public_path('/certificates/');
		$current_date = Carbon::now()->format('d-m-Y_H-i-s');
		$path = storage_path("certificates/certificates({$current_date}).zip");
		$zip = new ZipArchive;
		if ($zip->open($path, ZipArchive::CREATE) === TRUE) {
			$files = File::allFiles($folderPath);
			foreach ($files as $file) {
				$relativePath = basename($file);
				$zip->addFile($file, $relativePath);
			}
			$zip->close();
			File::deleteDirectory($folderPath);
		} else {
			flash()->addWarning('Something was wrong.');
		}
	   flash()->addSuccess('Certificate generate successfully.');
	   return redirect()->route('download');
	}
	
}
