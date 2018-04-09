<?php

namespace App\Jobs;

use App\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessImageThumbnail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $path;
    protected $thumb_path;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($path,$thumb_path)
    {
        $this->path = $path;
        $this->thumb_path = $thumb_path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // create image thumbs from the original image
        $img = \Image::make($this->path)->resize(300, 200);
        $img->save($this->thumb_path);
    }
}
