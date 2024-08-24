<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BotTelegram;
use App\Models\TemplateDokumen;
use CodeIgniter\HTTP\ResponseInterface;
use Telegram\Bot\Api;

class LandingPageController extends BaseController
{
    public function index()
    {
        $data['file_template'] = (new TemplateDokumen())->findAll();
        return view('landing_page', $data);
    }

    public function infoBotTelegram()
    {
        $getFirstBotFromDB = (new BotTelegram())->first();
        if (!$getFirstBotFromDB) {
            return response()->setJSON([
                'message' => 'Bot Telegram not found'
            ], ResponseInterface::HTTP_NOT_FOUND);
        }

        $telegram = new Api($getFirstBotFromDB['token']);

        // Get me
        $me = $telegram->getMe();

        return response()->setJSON($me);
    }
}
