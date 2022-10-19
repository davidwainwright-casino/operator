<?php
namespace Wainwright\CasinoDogOperatorApi\Controllers\Playground;

use Illuminate\Http\Request;
use Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Wainwright\CasinoDogOperatorApi\Models\OperatorGameslist;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Wainwright\CasinoDogOperatorApi\Traits\CasinoDogOperatorTrait;

class ExampleRespinController
{
    use CasinoDogOperatorTrait;

    public function check_valid_session($response) {
        try {
        return $response['message']['session_url'];
        } catch(\Exception $e) {
            return "0";
        }
    }


    public function toggle_respin(Request $request)
    {
        if(!$request->pid) {
            abort(403, 'Pid not specified');
        }

        $generate_player_id =  md5($request->DogGetIP().env('APP_URL'));

        if($generate_player_id === $request->pid) {
           $toggle_url =  config('casino-dog-operator-api.endpoints.toggle_respin').'?action=toggle_respin&operator_player_id='.$generate_player_id;
           $result = Http::get($toggle_url);
        }

        return 'respin_enabled='.$result;
    }



    public function view_model($url, $player_id)
    {
        $data = [
            'session_url' => $url,
            'player_id' => $player_id,
        ];
        return view('wainwright::playground.respin-example', compact('data'));
    }

     public function show(Request $request) {
        
        $format_time_to_hour = Carbon\Carbon::parse(now())->format('H');
        $format_time_to_day = Carbon\Carbon::parse(now())->format('d');
        $player_id = md5($request->DogGetIP().$format_time_to_hour.$format_time_to_day);
        // if mascot game fails, try 3oaks game
        $create_session_request = $this->create_session('3oaks-thunder_of_olympus', $player_id, 'USD', 'real');

        
        if($this->check_valid_session($create_session_request) !== "0") {
            return $this->view_model($this->check_valid_session($create_session_request), $player_id);
        }
        // trying to create playson game
        $create_session_request = $this->create_session('infin:LuxorGoldHoldandWin', $player_id, 'USD', 'real');

        if($this->check_valid_session($create_session_request) !== "0") {
            return $this->view_model($this->check_valid_session($create_session_request), $player_id);
        }

        // if playson game fails, try mascot game
        $create_session_request = $this->create_session('mascot:primal_bet_rockways', $player_id, 'USD', 'real');

        if($this->check_valid_session($create_session_request) !== "0") {
            return $this->view_model($this->check_valid_session($create_session_request), $player_id);
        }

        return $this->view_model($this->check_valid_session($create_session_request), $player_id);

        abort(403, 'Error trying to create session, possibly provider code has changed by design else try another provider.');
     }
     
}