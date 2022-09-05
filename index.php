<?php
$bot_token = '5792512364:AAEVSBwEn6u_U03xmQLrYpDlMuMbOdp00HA';
$url = 'https://api.telegram.org/bot' . $bot_token;
$r = file_get_contents('php://input');
$r = json_decode($r, true);
file_put_contents('message.txt', print_r($r, true), FILE_APPEND | LOCK_EX);
//send_message($r['message']['chat']['id'], 'fsdfsfd');
//$text = $r['message']['chat']['text'];
$chat_id = $r['message']['chat']['id'];
if(isset($r['message']['entities'][0]['type'])){
    if($r['message']['entities'][0]['type'] = 'bot_command'){
        if($r['message']['text'] == '/start'){
            $forcereply = json_encode(['force_reply'=>True]);
            send_message($chat_id, 'Введите <b><i>свой</i></b> иин', $forcereply);
        }elseif($r['message']['text'] == '/photo'){
            send_photo($chat_id);
        }elseif($r['message']['text'] == '/document'){
            send_document($chat_id);
        };
    }
    //send_message($chat_id, 'gigig');
};

if(isset($r['message']['chat']['text'])){
    $text = $r['message']['chat']['text'];
}


//send_buttons($chat_id);


if(isset($r['callback_query'])){
    send_message($chat_id, 'query');
};

if(isset($r['message']['reply_to_message'])){
    $reply = $r['message']['reply_to_message'];
    if($reply['username'] = 'business_irtis_test_bot'){
        if($reply['text'] = 'Введите свой иин'){
            $iin = $r['message']['text'];
            send_message($chat_id, check_iin($iin));
        }
    }
}



function send_message($chat_id, $text, $reply_markup=''){
    global $url;
    $ch = curl_init();
    $ch_post = [
        CURLOPT_URL => $url . '/sendMessage',
        CURLOPT_POST => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_POSTFIELDS => [
            'chat_id' => $chat_id,
            'parse_mode' => 'HTML',
            'text' => $text,
            'reply_markup' => $reply_markup,
        ]
    ];

    curl_setopt_array($ch, $ch_post);
    curl_exec($ch);
};

function send_buttons($chat_id){
    global $url;
    $buttonData = array();
    $buttonData = [
        'keyboard' =>[
        [
            ['text'=>'tefffdsfsd', 'callback_data'=>'www']
        ],
        [
            ['text'=>'tefffdsfsd', 'callback_data'=>'www']
        ]
        ]
    ];



    $ch = curl_init();
    $ch_post = [
        CURLOPT_URL => $url . '/sendMessage',
        CURLOPT_POST => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_POSTFIELDS => [
            'chat_id' => $chat_id,
            'parse_mode' => 'HTML',
            'text' => 'dsada',
            'reply_markup' => json_encode($buttonData),
        ]
    ];

    curl_setopt_array($ch, $ch_post);
    curl_exec($ch);
    
};

function send_photo($chat_id){
    global $url;
    $photo = new CURLFile(realpath("team3.png"));



    $ch = curl_init();
    $ch_post = [
        CURLOPT_URL => $url . '/sendPhoto',
        CURLOPT_POST => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_POSTFIELDS => [
            'chat_id' => $chat_id,
            'parse_mode' => 'HTML',
            'text' => 'dsada',
            'photo' => $photo,
            'reply_markup' => '',
        ]
    ];

    curl_setopt_array($ch, $ch_post);
    curl_exec($ch);
    
};


function send_document($chat_id){
    global $url;
    $document = new CURLFile(realpath("team3.png"));



    $ch = curl_init();
    $ch_post = [
        CURLOPT_URL => $url . '/sendDocument',
        CURLOPT_POST => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_POSTFIELDS => [
            'chat_id' => $chat_id,
            'parse_mode' => 'HTML',
            'text' => 'dsada',
            'document' => $document,
            'reply_markup' => '',
        ]
    ];

    curl_setopt_array($ch, $ch_post);
    curl_exec($ch);
    
};

function check_iin($iin){
    $iin_split = str_split($iin);
    if(count($iin_split) == 12){
        if(ctype_digit($iin)){
            return 'true';
        }else{
            return 'fasle';
        }
    }else{
        return 'false';
    }
}


?>