<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\RemunerationBenefit;
use PDF; // If you're generating PDF

class GenerateGiftReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $adminId; // If you need to notify a specific admin
    protected $email;   // If you want to email the report

    public function __construct($adminId = null, $email = null)
    {
        $this->adminId = $adminId;
        $this->email = $email;
    }

    public function handle()
    {
        // Get active users
        $users = User::where('status', 1)
                    ->where('block', 0)
                    ->where('is_deleted', 0)
                    ->get();
                    
        // Add rank to each user and filter only those with rank
        $usersWithRank = $users->map(function($user) {
            $user->rank = $this->get_rank_instantly($user->id);
            return $user;
        })->filter(function($user) {
            return !empty($user->rank);
        });
        
        $data = [
            'title' => 'Gift Report',
            'usersWithRank' => $usersWithRank,
            'generated_at' => now()->format('Y-m-d H:i:s'),
        ];

        // Here you can:
        // 1. Store the report in storage
        // 2. Email it to someone
        // 3. Store it in database
        // 4. Or just prepare the data for later use

        // Example: Generate PDF and store it
        $pdf = PDF::loadView('admin.reports.gift_report_pdf', $data);
        $filename = 'gift-report-'.now()->format('Y-m-d').'.pdf';
        $path = storage_path('app/reports/'.$filename);
        $pdf->save($path);

        // You could also store the report data in cache or database
        // cache()->put('last-gift-report', $data, now()->addHours(24));
    }

    protected function get_rank_instantly($user_id)
    {
        $total_left_business = calculate_left_business($user_id);
        $total_right_business = calculate_right_business($user_id);

        $achieved_target = RemunerationBenefit::where('target', '<=', $total_left_business)
                            ->where('target', '<=', $total_right_business)
                            ->orderBy('target', 'DESC')
                            ->first();
        
        return $achieved_target->rank ?? '';
    }

    // In your GenerateGiftReport job's handle() method:
    // public function handle()
    // {
    //     $users = User::where('status', 1)
    //                 ->where('block', 0)
    //                 ->where('is_deleted', 0)
    //                 ->get();
                    
    //     $usersWithDetails = $users->map(function($user) {
    //         $rankInfo = $this->get_rank_instantly($user->id);
    //         return [
    //             'name' => $user->name,
    //             'id' => $user->id,
    //             'rank' => $rankInfo->rank ?? '',
    //             'target_achieved' => $rankInfo->target ?? 0,
    //             'amount' => $rankInfo->amount ?? 0,
    //             'month_validity' => $rankInfo->month_validity ?? '',
    //         ];
    //     })->filter(function($user) {
    //         return !empty($user['rank']);
    //     });
        
    //     $data = [
    //         'title' => 'Gift Report',
    //         'users' => $usersWithDetails,
    //         'generated_at' => now()->format('Y-m-d H:i:s'),
    //     ];

    //     // Generate PDF or Excel
    //     $pdf = PDF::loadView('admin.reports.gift_report_pdf', $data);
    //     $filename = 'gift-report-'.now()->format('Y-m-d').'.pdf';
    //     $path = storage_path('app/reports/'.$filename);
    //     $pdf->save($path);

    //     // Or generate Excel
    //     // Excel::store(new GiftReportExport($usersWithDetails), 'reports/gift-report-'.now()->format('Y-m-d').'.xlsx');
    // }
}