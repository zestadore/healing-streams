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
        $currentDate=$date;
        $after2DaysMailDate=$date-2;
        $date+=3;
        //Mailing before 3 days
        $ids=[];
        $payments=PaymentsThisMonth::where('status',0)->where('refrence','monthly')->where('initialising_date',$date)->get();
        if(count($payments)>0){
            foreach($payments as $payment){
                // info("Test");
                $ids[]=$payment->reference_id;
            }
        }
        if(count($ids)>0){
            $monthlies=MonthlyAutomatic::whereIn('id',$ids)->get();
            foreach($monthlies as $payment){
                Mail::to($payment->email_id)->send(new PaymentMail($payment));
            }
        }
        $ids=[];
        $payments=PaymentsThisMonth::where('status',0)->where('refrence','pledge')->where('initialising_date',$date)->get();
        if(count($payments)>0){
            foreach($payments as $payment){
                // info("Test");
                $ids[]=$payment->reference_id;
            }
        }
        if(count($ids)>0){
            $monthlies=Pledge::whereIn('id',$ids)->get();
            foreach($monthlies as $payment){
                Mail::to($payment->email_id)->send(new PaymentMail($payment));
            }
        }
        //Mailing after 2 days
        $ids=[];
        $payments=PaymentsThisMonth::where('status',0)->where('refrence','monthly')->where('initialising_date',$after2DaysMailDate)->get();
        if(count($payments)>0){
            foreach($payments as $payment){
                // info("Test");
                $ids[]=$payment->reference_id;
            }
        }
        if(count($ids)>0){
            $monthlies=MonthlyAutomatic::whereIn('id',$ids)->get();
            foreach($monthlies as $payment){
                Mail::to($payment->email_id)->send(new PaymentMail($payment));
            }
        }
        $ids=[];
        $payments=PaymentsThisMonth::where('status',0)->where('refrence','pledge')->where('initialising_date',$after2DaysMailDate)->get();
        if(count($payments)>0){
            foreach($payments as $payment){
                // info("Test");
                $ids[]=$payment->reference_id;
            }
        }
        if(count($ids)>0){
            $monthlies=Pledge::whereIn('id',$ids)->get();
            foreach($monthlies as $payment){
                Mail::to($payment->email_id)->send(new PaymentMail($payment));
            }
        }
        //Mailing current date
        $ids=[];
        $payments=PaymentsThisMonth::where('status',0)->where('refrence','monthly')->where('initialising_date',$currentDate)->get();
        if(count($payments)>0){
            foreach($payments as $payment){
                // info("Test");
                $ids[]=$payment->reference_id;
            }
        }
        if(count($ids)>0){
            $monthlies=MonthlyAutomatic::whereIn('id',$ids)->get();
            foreach($monthlies as $payment){
                Mail::to($payment->email_id)->send(new PaymentMail($payment));
            }
        }
        $ids=[];
        $payments=PaymentsThisMonth::where('status',0)->where('refrence','pledge')->where('initialising_date',$currentDate)->get();
        if(count($payments)>0){
            foreach($payments as $payment){
                // info("Test");
                $ids[]=$payment->reference_id;
            }
        }
        if(count($ids)>0){
            $monthlies=Pledge::whereIn('id',$ids)->get();
            foreach($monthlies as $payment){
                Mail::to($payment->email_id)->send(new PaymentMail($payment));
            }
        }
    }
}
