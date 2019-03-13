<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MessagesService;
use App\Services\LocaleService;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class MessagesController extends Controller
{
    protected $messagesservice;
    protected $localeservice;

    public function __construct(
        MessagesService $messagesservice,
        LocaleService $localeservice
        ) {
        $this->messagesservice  = $messagesservice;
        $this->localeservice    = $localeservice;
    }
    public function sendMessage(Request $request)
    {
        try {
            $params = $request->Only("name", "email", "subject", "message", "locale");
            $this->messagesservice->send($params);
            return response()->json(['success' => true], Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false], Response::HTTP_OK);
        }
    }
}
