<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\CategoryPost;

class updatepostactiveJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private   $categorypost = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CategoryPost $categorypost)
    {
        $this->categorypost = $categorypost;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->categorypost->posts()->get() as $item)  
        {
         $item->update(['stauts' => '1']);
        }
    }
}
