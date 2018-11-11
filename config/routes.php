<?php
return array(
    //auth
    /*[
        'middleware' => 'auth1',
        'routes' => ['middleware2'=>'success/good']
    ],*/
    //post
    'test/bot' => 'test/bot',
    'change/answer' => 'change/answer/',
    'teach/take_answer' => 'change/take_answer/',
    'delete/del_id' => 'delete/delete_answer_id/',
    'add/answer' => 'change/add_answer/',
    //url
    'teach' => 'teach/teach_bot', //отвечаем на вопросы франчей
    'test' => 'home/test/', //имитация бота
    'redact' => 'home/index/', //редактировать вопросы
    //'' => 'teach/question', //задать вопрос
    /*[
        'middleware' => 'auth',
        'routes' => ['middleware1'=>'success/good']
    ],*/
    'image'=>'default/image',

    'admin/open/([0-9]+)'=>'admin/open/$1',
    'admin'=>'admin/index',
    //'uploads/([a-z]+)'=>'default/image_show/$1',
    ''=>'default/index/',
);