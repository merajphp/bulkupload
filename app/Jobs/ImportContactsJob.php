<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class ImportContactsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 10;
    protected $filePath;
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function handle()
   {
        try {
            ini_set('memory_limit', '2024M');
            if (!file_exists($this->filePath)) {
                Log::error("The file at path {$this->filePath} does not exist.");
                return;
            }
            $xml = simplexml_load_file($this->filePath);
            if ($xml === false) {
                Log::error("Failed to load XML file: {$this->filePath}");
                return;
            }
            $contacts = [];
            foreach ($xml->contact as $contact) {
                $contacts[] = [
                    'name' => (string) $contact->name,
                    'number' =>  $contact->number,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            foreach (array_chunk($contacts, 1000) as $chunk) {
                DB::table('contacts')->insert($chunk);
            }
            unlink($this->filePath);
            Log::info("File imported and deleted: {$this->filePath}");

        } catch (\Exception $e) {
            Log::error("Error processing contacts import: " . $e->getMessage());
        }
   }

}
