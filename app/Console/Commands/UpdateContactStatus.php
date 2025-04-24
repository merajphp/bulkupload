<?php

namespace App\Console\Commands;
use App\Models\Contact;
use Illuminate\Console\Command;
use Log;
class UpdateContactStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-contact-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Contact::query()->update(['number' => '2222222222']);
        $this->info('User statuses updated at ' . now());
        \Log::info('Contact status updated at ' . now());

    }
}
