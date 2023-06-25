<?php

namespace App\Console\Commands;
use App\Models\MonthlyAutomatic;
use App\Models\Pledge;
use App\Models\PaymentsThisMonth;
use Illuminate\Console\Command;

class ThisMonthPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monthly:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will defines all payments for the current month';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $insertData=[];
        $automatics=MonthlyAutomatic::where('status',1)->get();
        if(count($automatics)>0){
            foreach($automatics as $automatic){
                $insertData[]=[
                    'refrence'=>'monthly',
                    'reference_id'=>$automatic->id,
                    'initialising_date'=>5,
                    'created_at'=>Now()
                ];
            }
        }
        $pledges=Pledge::where('status',1)->get();
        if(count($pledges)>0){
            foreach($pledges as $pledge){
                $insertData[]=[
                    'refrence'=>'pledge',
                    'reference_id'=>$pledge->id,
                    'initialising_date'=>$pledge->initialising_date,
                    'created_at'=>Now()
                ];
            }
        }
        if(count($insertData)>0){
            PaymentsThisMonth::insert($insertData);
        }
    }
}
