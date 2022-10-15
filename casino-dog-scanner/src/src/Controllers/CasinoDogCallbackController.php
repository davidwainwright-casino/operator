<?php
namespace Wainwright\CasinoDogOperatorApi\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;
use Wainwright\CasinoDogOperatorApi\Models\PlayerBalances;

class CasinoDogCallbackController
{
    protected $operator_key;

    public function __construct()
    {
        $this->operator_key = config('casino-dog-operator-api.access.key');
        $this->operator_secret = config('casino-dog-operator-api.access.secret');
    }

    public function callback(Request $request)
    {
        if($request->action === 'ping') {
            return $this->pong($request);
        }

        if($request->action === 'balance') {
            return $this->balance($request);
        }

        if($request->action === 'game') {
            return $this->game($request);
        }

        abort(403, 'Empty action.');
        
    }

    public function pong(Request $request)
    {
        $pong_hash = hash_hmac('md5', $this->operator_secret, $request->salt_sign);
        $data = [
            'status' => 200,
            'data' => [
                'pong' => $pong_hash,
            ],
        ];
        return response()->json($data, 200);
    }

    public function balance(Request $request)
    {
        $player = new PlayerBalances;
        $select_player = $player->select_player($request->player_operator_id, $request->currency);

        $data = [
            'status' => 200,
            'data' => [
                'balance' => (int) $select_player->balance,
            ],
        ];
        return response()->json($data, 200);
    }

    public function game(Request $request)
    {
        $player = new PlayerBalances;
        $balance_after_game = $player->process_game($request->player_operator_id, $request->bet, $request->win, $request->currency, $request);
        $select_player = $player->select_player($request->player_operator_id, $request->currency);

        $data = [
            'status' => 200,
            'data' => [
                'balance' =>  (int) $select_player->balance,
            ],
          ];
          return response()->json($data, 200);
    }


}
