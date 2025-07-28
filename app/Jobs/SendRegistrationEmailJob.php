<?php

namespace App\Jobs;

use App\Mail\WelcomeJobSeekerMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendRegistrationEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $jobSeeker;

    /**
     * Create a new job instance.
     */
    public function __construct($jobSeeker)
    {
        $this->jobSeeker = $jobSeeker;
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Mail::to($this->jobSeeker->email)
        //     ->send(new WelcomeJobSeekerMail($this->jobSeeker));

        try {
            Mail::to($this->jobSeeker->email)
                ->send(new WelcomeJobSeekerMail($this->jobSeeker));
        } catch (\Exception $e) {
            Log::error("Mail sending failed: " . $e->getMessage());
        }
    }
}
