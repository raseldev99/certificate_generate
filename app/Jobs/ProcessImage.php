<?php

namespace App\Jobs;

use DantSu\PHPImageEditor\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class ProcessImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,IsMonitored;

	public array $names;
	public array $customize;
    /**
     * Create a new job instance.
     */
    public function __construct(array $names,$customize)
    {
        $this->names = $names;
		$this->customize = $customize;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
		if (File::exists(public_path('/certificates'))){
			File::deleteDirectory(public_path('/certificates'));
		}
		File::makeDirectory(public_path('/certificates'));
		
		if ($this->customize['type'] === 'jpg'){
			foreach ($this->names as $index => $name){
				Image::fromPath( $this->customize['src'])
					->writeText($name, $this->customize['font'],$this->customize['font_size'],$this->customize['font_color'],$this->customize['position_x'],$this->customize['position_y'],$this->customize['anchor_x'],$this->customize['anchor_y'],$this->customize['rotation'],$this->customize['letterSpacing'])
				->saveJPG(public_path('/certificates/').$index.'.'.$name.'.jpg',100);
		   }
		}elseif ($this->customize['type'] === 'png'){
			foreach ($this->names as $index => $name){
				Image::fromPath( $this->customize['src'])
					->writeText($name, $this->customize['font'],$this->customize['font_size'],$this->customize['font_color'],$this->customize['position_x'],$this->customize['position_y'],$this->customize['anchor_x'],$this->customize['anchor_y'],$this->customize['rotation'],$this->customize['letterSpacing'])
				->savePNG(public_path('/certificates/').$index.'.'.$name.'.jpg');
	     	}
		}
		
    }
}
