<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class NotifyProjectEndDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:project-end';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a notification when a project reaches its end date';

    /**
     * Telegram Bot Token.
     *
     * @var string
     */
    protected $botToken = '7230286486:AAFJIXTFrjvxfLGliIr5tJi6UG_Gici4Qzs';

    /**
     * Telegram Chat ID.
     *
     * @var string
     */
    protected $chatId = '5758548856';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Get the current date
        $today = Carbon::today();

        // Find all projects with the end date of today
        $projects = Project::whereDate('end_date', $today)->get();

        foreach ($projects as $project) {
            // Construct the message
            $message = "{$project->client->company_name} {$project->end_date} da loyihani yakunlashingiz kerak, admin panel orqali loyiha holatini o'zgartiring";

            // Send the message via Telegram Bot
            $this->sendTelegramMessage($message);
        }

        $this->info('Notifications sent for projects ending today.');

        return 0;
    }

    /**
     * Send a message via Telegram Bot.
     *
     * @param string $message
     * @return void
     */
    private function sendTelegramMessage(string $message)
    {
        $url = "https://api.telegram.org/bot{$this->botToken}/sendMessage";

        $response = Http::post($url, [
            'chat_id' => $this->chatId,
            'text' => $message,
        ]);

        if ($response->failed()) {
            $this->error('Failed to send Telegram message: ' . $response->body());
        }
    }
}
