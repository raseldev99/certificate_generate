<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use romanzipp\QueueMonitor\Traits\IsMonitored;
use ZipArchive;

class GenerateZip implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,IsMonitored;

    /**
     * Create a new job instance.
     */
	public string $path;
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
		$folderPath = public_path('/certificates/');
		$zip = new ZipArchive;
		if ($zip->open($this->path, ZipArchive::CREATE) === TRUE) {
			$files = File::allFiles($folderPath);
			foreach ($files as $file) {
				$relativePath = basename($file);
				$zip->addFile($file, $relativePath);
			}
			$zip->close();
			File::deleteDirectory($folderPath);
		} else {
			//
		}
    }
}
