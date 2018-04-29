<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Register;
use App\Models\Answer;

class AnswersController extends Controller
{
   	function checkResponse(Request $request){

   		$code = $request->code;
   		$answer = $request->answer;
   		$a = Answer::where('code',$code)->first();

   		$register = new Register;
   		$register->user_id = auth()->user()->id;
   		$register->code = $code;
   		$register->answer = $answer;
   
   		if($a->answer == $answer){

			$register->correct = 1;
			$register->save();

   			return response()->json([
			    'status' => 'Respuesta correcta.',
             'correct' => $answer
			]);
   		}else{

   			$register->correct = 0;
   			$register->save();
   			
   			return response()->json([
			    'status' => 'Error en la respuesta.',
             'correct' => $a->answer
			]);
   		}
   	}
}
