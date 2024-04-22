<?php

namespace App\Livewire;

use App\Imports\NameImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\SimpleExcel\SimpleExcelReader;

class GenerateFromFile extends Component
{
	use WithFileUploads;
	public array $is_customs = [
		'position_x'=>false,
		'position_y'=>false,
		'anchor_X' => false,
		'anchor_y' => false
	];
	
	public $file;
	
    public function render()
    {
        return view('livewire.generate-from-file');
    }
	
	
	public function generate()
	{
//		dd($this->file);
		$data  = Excel::toArray(new NameImport(),$this->file);
		dd($data);
	}
}
