<?php

namespace App\Livewire;

use Livewire\Component;

class GenerateFromFile extends Component
{
	public array $is_customs = [
		'position_x'=>false,
		'position_y'=>false,
		'anchor_X' => false,
		'anchor_y' => false
	];
    public function render()
    {
        return view('livewire.generate-from-file');
    }
}
