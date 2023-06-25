<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\PaymentMail;
use App\Models\MonthlyAutomatic;
use App\Models\Pledge;
use App\Models\PaymentsThisMonth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EmailPayments implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public function __construct()
    {
        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $date=Carbon::parse(Now())->format('d');
        if($date==5){
            $ids=[];
            $payments=PaymentsThisMonth::where('status',0)->where('refrence','monthly')->get();
            foreach($payments as $payment){
                // info("Test");
                $ids[]=$payment->reference_id;
            }
            if(count($ids)>0){
                $monthlies=MonthlyAutomatic::whereIn('id',$ids)->get();
                foreach($monthlies as $payment){
                    Mail::to($payment->email_id)->send(new PaymentMail($payment));
                }
            }
        }else{
            $ids=[];
            $payments=PaymentsThisMonth::where('status',0)->where('refrence','pledge')->where('initialising_date',$date)->get();
            foreach($payments as $payment){
                // info("Test");
                $ids[]=$payment->reference_id;
            }
            if(count($ids)>0){
                $monthlies=Pledge::whereIn('id',$ids)->get();
                foreach($monthlies as $payment){
                    Mail::to($payment->email_id)->send(new PaymentMail($payment));
                }
            }
        }
    }
}
