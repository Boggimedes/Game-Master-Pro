<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessAging implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $region;
    protected $years;
    protected $timeout = 1800;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($region, $years)
    {
        $this->region = $region;
        $this->years = $years;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
		ini_set('max_execution_time', 1800);
        $this->region->processing = true;
        $this->region->save();
        $this->region->age($this->years);
        $this->region->processing = false;
        $this->region->save();

    }
    public function failed(\Exception $e = null)
    {
        \Log::error($e);
        $this->region->processing = false;
        $this->region->save();
    }
}
