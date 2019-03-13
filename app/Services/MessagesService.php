<?php

namespace App\Services;

use App\Services\BaseService;
use App\Repositories\LocaleRepository;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;

class MessagesService extends BaseService
{
    public function __construct()
    {
    }

    public function send($params)
    {
        // "name", "email", "subject", "message"

        $objDemo = new \stdClass();
        $objDemo->demo_one = 'Demo One Value';
        $objDemo->demo_two = 'Demo Two Value';
        $objDemo->sender = 'SenderUserName';
        $objDemo->receiver = 'ReceiverUserName';

        Mail::to($params["email"])->send(new DemoEmail($objDemo));
    }
}
