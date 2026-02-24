<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WhatsAppService;

class WhatsAppController extends Controller
{
    protected $whatsappService;

    public function __construct(WhatsAppService $whatsappService)
    {
        $this->whatsappService = $whatsappService;
    }

    public function sendMessage(Request $request)
    {
        // Validate request input
        $request->validate([
            'to' => 'required',
            'message' => 'required',
        ]);

        $to = $request->input('to');         // E.g. +441234567890
        $message = $request->input('message');

        $result = $this->whatsappService->sendMessage($to, $message);

        return response()->json([
            'status' => 'success',
            'sid' => $result->sid,   // Twilio message SID
        ]);
    }
}
