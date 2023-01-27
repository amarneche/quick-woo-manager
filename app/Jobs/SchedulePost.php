<?php

namespace App\Jobs;

use App\Services\RadaarScheduler;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SchedulePost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $scheduler;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(RadaarScheduler $scheduler)
    {
        //
        $this->scheduler = $scheduler;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        $this->scheduler->send();
    }
}
