<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Register;
use Carbon\Carbon;

class WebController extends Controller
{
    function index(){

    	$user_id = auth()->user()->id;
        $user_role = auth()->user()->role;

    	$answered = Register::where('user_id', $user_id)->distinct()->pluck('code');

        if($user_role == 'admin'){
            $question = Question::inRandomOrder()->where('active', 1)->whereNotIn('code', $answered)->first();
        }else{
            $question = Question::inRandomOrder()->where('status', null)->where('active', 1)->whereNotIn('code', $answered)->first();
        }

        $goods = Register::where('user_id', $user_id)->where('correct', 1)->count();
    	$bads = Register::where('user_id', $user_id)->where('correct', 0)->count();


        $totals = $goods + $bads;
        if($totals>0){
            $totals_goods_percent = ($goods * 100) / $totals;
            $totals_goods_percent = number_format($totals_goods_percent, 2);
            $totals_bads_percent = ($bads * 100) / $totals;
            $totals_bads_percent = number_format($totals_bads_percent, 2);
        }else{
            $totals_goods_percent = 0;
            $totals_bads_percent = 0;
        }

        $from = Carbon::now()->subDay(1)->toDateTimeString();
        $to = Carbon::now()->toDateTimeString();

        $today_goods = Register::where('user_id', $user_id)->where('correct', 1)->whereBetween('created_at', [$from, $to])->count();
        $today_bads = Register::where('user_id', $user_id)->where('correct', 0)->whereBetween('created_at', [$from, $to])->count();

        $totals_today = $today_goods + $today_bads;
        if($totals_today>0){
            $today_goods_percent = ($today_goods * 100) / $totals_today;
            $today_goods_percent = number_format($today_goods_percent, 2);
            $today_bads_percent = ($today_bads * 100) / $totals_today;
            $today_bads_percent = number_format($today_bads_percent, 2);
        }else{
            $today_goods_percent = 0;
            $today_bads_percent = 0;
        }


    	return view('web.home', compact('question', 'goods', 'bads','today_goods','today_bads','today_goods_percent', 'today_bads_percent','totals_goods_percent','totals_bads_percent'));
    }

    function show($code){

    	$user_id = auth()->user()->id;

    	$question = Question::where('code', $code)->first();

    	$goods = Register::where('user_id', $user_id)->where('correct', 1)->count();
    	$bads = Register::where('user_id', $user_id)->where('correct', 0)->count();

    	return view('web.home', compact('question', 'goods', 'bads'));
    }

    function stadistics(){

        $user_id = auth()->user()->id;
        $total_goods = $this->calculateGoodsForCharData();
        $total_bads= $this->calculateBadsForCharData();

        return view('web.stadistics', compact('total_goods', 'total_bads'));
    }

     /**
     * @return  $buenas
     */
    private function calculateGoodsForCharData()
    {
        $dt = Carbon::now()->subDay(1);
        $today = $dt->toDateTimeString();
        $total_goods = [];
        $user_id = auth()->user()->id;

        for ($i = 1; $i < 8; $i++) {

            $from = Carbon::now()->subDay($i)->toDateTimeString();
            $to = Carbon::now()->subDay($i - 1)->toDateTimeString();

            $goods = Register::where('user_id', $user_id)->where('correct', 1)->whereBetween('created_at', [$from, $to])->count();

            $total_goods = array_prepend($total_goods, $goods);
        }

        return $total_goods;
    }

     /**
     * @return  $malas
     */
    private function calculateBadsForCharData()
    {
        $dt = Carbon::now()->subDay(1);
        $today = $dt->toDateTimeString();
        $total_bads = [];
        $user_id = auth()->user()->id;

        for ($i = 1; $i < 8; $i++) {

            $from = Carbon::now()->subDay($i)->toDateTimeString();
            $to = Carbon::now()->subDay($i - 1)->toDateTimeString();

            $bads = Register::where('user_id', $user_id)->where('correct', 0)->whereBetween('created_at', [$from, $to])->count();

            $total_bads = array_prepend($total_bads, $bads);
        }

        return $total_bads;
    }
}
