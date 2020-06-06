<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Course;


class CreateCoursesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    //set initial id (user_id) to 1
    public $id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
            $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            $Course = new \App\Course();
            $createMassCourses = $Course->createMassCourses($this->id);
        }catch(\Exception $e){
            Log::error($e->getMessage());
        }
    }
}
