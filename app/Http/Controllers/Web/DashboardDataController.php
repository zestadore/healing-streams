<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Region;
use App\Models\Pledge;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DashboardDataController extends Controller
{
    public function index(Request $request)
    {   
        $startDate=Carbon::parse($request->start_date)->format('Y-m-d');
        $endDate=Carbon::parse($request->end_date)->format('Y-m-d');
        if($startDate==$endDate){
            $endDate=Carbon::parse(Carbon::parse($request->start_date)->addDay())->format('Y-m-d');
        }
        $oneOffData=$this->getOneOffPayments($startDate,$endDate);
        $pledgeData=$this->getPledgePayments($startDate,$endDate);
        $pledgePromiseData=$this->getPledgePromisePayments($startDate,$endDate);
        $monthlyData=$this->getMonthlyPayments($startDate,$endDate);
        $regionOneoff=$this->getRegionOneOffPayments($startDate,$endDate);
        $regionMonthly=$this->getRegionMonthlyPayments($startDate,$endDate);
        $regionPledge=$this->getRegionPledgePayments($startDate,$endDate);
        $regionPledgePromised=$this->getRegionPledgePromisedPayments($startDate,$endDate);
        $response=[
            'oneOffPayments'=>$oneOffData,
            'pledgePayments'=>$pledgeData,
            'pledgePromisePayments'=>$pledgePromiseData,
            'monthlyPayments'=>$monthlyData,
            'regionOneOffPayments'=>$regionOneoff,
            'regionMonthlyPayments'=>$regionMonthly,
            'regionPledgePayments'=>$regionPledge,
            'regionPledgePromised'=>$regionPledgePromised
        ];
        return $response;
    }

    private function getOneOffPayments($startDate,$endDate)
    {
        $oneoffPayments=Payment::where('choice',0)->where('payment_status',1)->whereBetween('created_at', [$startDate,$endDate])->get();
        $sum=0;
        if(count($oneoffPayments)>0){
            $sum=$oneoffPayments->sum('amount_usd');
        }
        $partnerCount=Payment::where('choice',0)->where('payment_status',1)->whereBetween('created_at', [$startDate,$endDate])->distinct()->get(['email_id']);
        $response=[
            'payments'=>'$ '.number_format(round($sum,2),2),
            'count'=>count($partnerCount)
        ];
        return $response;
    }

    private function getPledgePayments($startDate,$endDate)
    {
        $payments=Payment::where('choice',2)->where('payment_status',1)->whereBetween('created_at', [$startDate,$endDate])->get();
        $sum=0;
        if(count($payments)>0){
            $sum=$payments->sum('amount_usd');
        }
        $partnerCount=Payment::where('choice',2)->where('payment_status',1)->whereBetween('created_at', [$startDate,$endDate])->distinct()->get(['email_id']);
        $response=[
            'payments'=>'$ '.number_format(round($sum,2),2),
            'count'=>count($partnerCount)
        ];
        return $response;
    }

    private function getPledgePromisePayments($startDate,$endDate)
    {
        $payments=Pledge::where('status',1)->whereBetween('created_at', [$startDate,$endDate])->get();
        $sum=0;
        if(count($payments)>0){
            $sum=$payments->sum('amount_usd');
        }
        $partnerCount=Pledge::where('status',1)->whereBetween('created_at', [$startDate,$endDate])->distinct()->get(['email_id']);
        $response=[
            'payments'=>'$ '.number_format(round($sum,2),2),
            'count'=>count($partnerCount)
        ];
        return $response;
    }

    private function getMonthlyPayments($startDate,$endDate)
    {
        $payments=Payment::where('choice',1)->where('payment_status',1)->whereBetween('created_at', [$startDate,$endDate])->get();
        $sum=0;
        if(count($payments)>0){
            $sum=$payments->sum('amount_usd');
        }
        $partnerCount=Payment::where('choice',1)->where('payment_status',1)->whereBetween('created_at', [$startDate,$endDate])->distinct()->get(['email_id']);
        $response=[
            'payments'=>'$ '.number_format(round($sum,2),2),
            'count'=>count($partnerCount)
        ];
        return $response;
    }

    private function getRegionOneOffPayments($startDate,$endDate)
    {
        $datas=Region::select('regions.region','regions.id')->selectRaw('SUM(payments.amount_usd) AS sum')->selectRaw('COUNT(payments.email_id) AS count')
            ->join('countries','countries.region_id','=','regions.id')
            ->join('payments','payments.country_id','=','countries.id')->where('payments.choice',0)->where('payments.payment_status',1)
            ->where('regions.status',1)->whereBetween('payments.created_at', [$startDate,$endDate])
            ->groupBy('payments.email_id', 'regions.id','regions.region')->get();
        $regions=Region::where('status',1)->get();
        $html='<tr style="color:rgb(176, 55, 7);">
                <td><b>Region</b></td>
                <td><b>Amount</b></td>
                <td><b>Partners</b></td>
            </tr>';
        
        foreach($regions as $region){
            $sum=0;
            $count=0;
            foreach($datas as $data){
                if($region->id==$data->id){
                    $sum+=$data->sum;
                    $count++;
                }
            }
            $html=$html.'<tr>
                <td>'.$region->region.'</td>
                <td>$ '.number_format(round($sum,2),2).'</td>
                <td>'.$count.'</td>
            </tr>';
        }
        return $html;
    }

    private function getRegionMonthlyPayments($startDate,$endDate)
    {
        $datas=Region::select('regions.region','regions.id')->selectRaw('SUM(payments.amount_usd) AS sum')->selectRaw('COUNT(payments.email_id) AS count')
            ->join('countries','countries.region_id','=','regions.id')
            ->join('payments','payments.country_id','=','countries.id')->where('payments.choice',1)->where('payments.payment_status',1)
            ->where('regions.status',1)->whereBetween('payments.created_at', [$startDate,$endDate])
            ->groupBy('payments.email_id', 'regions.id','regions.region')->get();
        $regions=Region::where('status',1)->get();
        $html='<tr style="color:purple;">
                <td><b>Region</b></td>
                <td><b>Amount</b></td>
                <td><b>Partners</b></td>
            </tr>';
        
        foreach($regions as $region){
            $sum=0;
            $count=0;
            foreach($datas as $data){
                if($region->id==$data->id){
                    $sum+=$data->sum;
                    $count++;
                }
            }
            $html=$html.'<tr>
                <td>'.$region->region.'</td>
                <td>$ '.number_format(round($sum,2),2).'</td>
                <td>'.$count.'</td>
            </tr>';
        }
        return $html;
    }

    private function getRegionPledgePayments($startDate,$endDate)
    {
        $datas=Region::select('regions.region','regions.id')->selectRaw('SUM(payments.amount_usd) AS sum')->selectRaw('COUNT(payments.email_id) AS count')
            ->join('countries','countries.region_id','=','regions.id')
            ->join('payments','payments.country_id','=','countries.id')->where('payments.choice',2)->where('payments.payment_status',1)
            ->where('regions.status',1)->whereBetween('payments.created_at', [$startDate,$endDate])
            ->groupBy('payments.email_id', 'regions.id','regions.region')->get();
        $regions=Region::where('status',1)->get();
        $html='<tr style="color:rgb(104, 15, 58);">
                <td><b>Region</b></td>
                <td><b>Amount</b></td>
                <td><b>Partners</b></td>
            </tr>';
        foreach($regions as $region){
            $sum=0;
            $count=0;
            foreach($datas as $data){
                if($region->id==$data->id){
                    $sum+=$data->sum;
                    $count++;
                }
            }
            $html=$html.'<tr>
                <td>'.$region->region.'</td>
                <td id="pledge_amount_'.Str::slug($region->region).'">$'.number_format(round($sum,2),2).'</td>
                <td id="pledge_count_'.Str::slug($region->region).'">'.$count.'</td>
            </tr>';
        }
        return $html;
    }

    private function getRegionPledgePromisedPayments($startDate,$endDate)
    {
        $datas=Region::select('regions.region','regions.id')->selectRaw('SUM(pledges.amount_usd) AS sum')->selectRaw('COUNT(pledges.email_id) AS count')
            ->join('countries','countries.region_id','=','regions.id')
            ->join('pledges','pledges.country_id','=','countries.id')->where('pledges.status',1)
            ->where('regions.status',1)->whereBetween('pledges.created_at', [$startDate,$endDate])
            ->groupBy('pledges.email_id', 'regions.id','regions.region')->get();
            $regions=Region::where('status',1)->get();
            $html=[];
            foreach($regions as $region){
                $sum=0;
                $count=0;
                foreach($datas as $data){
                    if($region->id==$data->id){
                        $sum+=$data->sum;
                        $count++;
                    }
                }
                $html[]=[
                    'region'=>Str::slug($region->region),
                    'payments'=>'$ '.number_format(round($sum,2),2),
                    'count'=>$count
                ];
            }
            return $html;
    }
}
