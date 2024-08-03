<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class NotifyProjectPaymentStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:project-payment-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Telegram notifications for project payment statuses on the 25th of each month';

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
        // Check if today is the 25th
        if (Carbon::today()->day !== 25) {
            $this->info('Today is not the 25th. Skipping notifications.');
            return 0;
        }

        // Fetch all projects with their agreements and transactions
        $projects = Project::with(['agreement.transactions'])->get();

        foreach ($projects as $project) {
            $agreement = $project->agreement;

            if ($agreement) {
                // Calculate total amount paid
                $totalPaid = $agreement->transactions->sum('profit');
                $latestTransactionDate = $agreement->transactions->max('payment_date');
                $remainingAmount = $agreement->price - $totalPaid;

                // Send Telegram message based on payment status
                if ($remainingAmount <= 0) {
                    $project->payment_status = 'paid';
                    $this->info("Project {$project->company_name} is fully paid.");
                } elseif ($totalPaid > 0) {
                    $project->payment_status = 'partially_paid';
                    $this->sendPartialPaymentNotification($project, $totalPaid, $remainingAmount, $latestTransactionDate);
                } else {
                    $project->payment_status = 'unpaid';
                    $this->sendUnpaidNotification($project);
                }

                // Save the updated project status
                $project->save();
            }
        }

        $this->info('Payment status notifications sent successfully.');
        return 0;
    }

    /**
     * Send a partial payment notification via Telegram.
     *
     * @param \App\Models\Project $project
     * @param float $totalPaid
     * @param float $remainingAmount
     * @param string $latestTransactionDate
     * @return void
     */
    private function sendPartialPaymentNotification(Project $project, float $totalPaid, float $remainingAmount, $latestTransactionDate)
    {
        $message = "{$project->company_name} {$totalPaid} to'lovini {$latestTransactionDate} da amalga oshirgan! Qoldiq: {$remainingAmount} to’lovni amalga oshirishingiz kerak";

        $this->sendTelegramMessage($message);
    }

    /**
     * Send an unpaid notification via Telegram.
     *
     * @param \App\Models\Project $project
     * @return void
     */
    private function sendUnpaidNotification(Project $project)
    {
        $message = "{$project->company_name} to’lov amalga oshirilmadi!";

        $this->sendTelegramMessage($message);
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

