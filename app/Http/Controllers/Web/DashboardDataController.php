<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Region;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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
        $monthlyData=$this->getMonthlyPayments($startDate,$endDate);
        $regionOneoff=$this->getRegionOneOffPayments($startDate,$endDate);
        $regionMonthly=$this->getRegionMonthlyPayments($startDate,$endDate);
        $regionPledge=$this->getRegionPledgePayments($startDate,$endDate);
        $response=[
            'oneOffPayments'=>$oneOffData,
            'pledgePayments'=>$pledgeData,
            'monthlyPayments'=>$monthlyData,
            'regionOneOffPayments'=>$regionOneoff,
            'regionMonthlyPayments'=>$regionMonthly,
            'regionPledgePayments'=>$regionPledge
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
            'payments'=>'$ '.$sum,
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
            'payments'=>'$ '.$sum,
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
            'payments'=>'$ '.$sum,
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
        $html='<tr>
                <td>Region</td>
                <td>Amount</td>
                <td>Partners</td>
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
                <td>$ '.$sum.'</td>
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
        $html='<tr>
                <td>Region</td>
                <td>Amount</td>
                <td>Partners</td>
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
                <td>$ '.$sum.'</td>
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
        $html='<tr>
                <td>Region</td>
                <td>Amount</td>
                <td>Partners</td>
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
                <td>$ '.$sum.'</td>
                <td>'.$count.'</td>
            </tr>';
        }
        return $html;
    }
}
