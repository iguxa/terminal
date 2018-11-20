<?php
/**
 * Created by PhpStorm.
 * User: iguxa
 * Date: 20.11.18
 * Time: 16:08
 */

namespace Controllers;


use App\{Controller,Confing};
use TelegramBot\Api\Client;

class TelegramController extends Controller
{
    protected $telegram_params;
    protected $bot;
    public function __construct($layoutFile = null)
    {
        $this->telegram_params = Confing::getConfig('telegram_params');
        $this->bot = new Client($this->telegram_params['token']);
        $this->SetWebhook();
        parent::__construct($layoutFile);
    }

    public function RunTelegram()
    {
        //$bot = $this->bot;
        //$bot->command('help', function ($message) use ($bot) {
        //    $answer = "<b>Праивла использования:</b>\r\n
        //        Просто напишите название страны,напрмер : <b>Непал</b>\r\n
        //        ";
        //    $bot->sendMessage($message->getChat()->getId(), $answer);
        //});
        //$bot->run();
        echo 'ok';
    }
    protected function SetWebhook()
    {
        if(!file_exists("registered.trigger")){
            /**
             * файл registered.trigger будет создаваться после регистрации бота.
             * если этого файла нет значит бот не зарегистрирован
             */
            // URl текущей страницы
            $page_url = "https://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
            $result = $this->bot->setWebhook($page_url);
            if($result){
                file_put_contents("registered.trigger",time()); // создаем файл дабы прекратить повторные регистрации
            } else die("ошибка регистрации");
        }
    }
}