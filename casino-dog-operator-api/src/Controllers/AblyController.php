<?php
namespace Wainwright\CasinoDogOperatorApi\Controllers;

use Ably;
use Illuminate\Support\Facades\Log;

class AblyController
{
    public function send_message(string $channel, string $type, $message) 
    {
        try {
            $token = \Ably::auth()->requestToken(['clientId' => $channel]); // Ably\Models\TokenDetails
            \Ably::channel($channel)->publish($type, $message);
        } catch(\Exception $e) {
            Log::notice('error'.json_encode($e));
        }
    }
}