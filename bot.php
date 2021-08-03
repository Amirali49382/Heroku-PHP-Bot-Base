<?php
/*
نویسنده
@Mr_mordad
@Mrmeltu
-------------
اوپن شده در ملتوتیم و ایس سورس
@meltutm
@icesource
--------------------------
کص ننت بدون منبع اصکی بری حتی شما دوست عزیز
---------------------------------------
*/
ob_start();
set_time_limit(0);
error_reporting(0);
ob_implicit_flush(1);
$telegram_ip_ranges = [
['lower' => '149.154.160.0', 'upper' => '149.154.175.255'], // literally 149.154.160.0/20
['lower' => '91.108.4.0',    'upper' => '91.108.7.255'],    // literally 91.108.4.0/22
];

$ip_dec = (float) sprintf("%u", ip2long($_SERVER['REMOTE_ADDR']));
$ok=false;

foreach ($telegram_ip_ranges as $telegram_ip_range) if (!$ok) {
    // Make sure the IP is valid.
    $lower_dec = (float) sprintf("%u", ip2long($telegram_ip_range['lower']));
    $upper_dec = (float) sprintf("%u", ip2long($telegram_ip_range['upper']));
    if ($ip_dec >= $lower_dec and $ip_dec <= $upper_dec) $ok=true;
}
if (!$ok) die("404
@MR_Mordad
");

$API_KEY = '1738472642:AAECiTgtt1QfKtI40j46p3aHJCDScb2Tk2M'; //توکن ربات//
$channel = "@selfsazpro"; //ایدی کانال با @//
$admin = '201327491'; //ایدی عددی مدیر//
$idbot = "HelperrRobot"; //username Robot
$sup = "MrMeltu";//username Admin RoBot


include('jdf.php');
//-------------------------------------------//
define('API_KEY', $API_KEY);
$GetINFObot = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getMe"));
$Botid = $GetINFObot->result->username;
function bot($method, $datas = [])
{
    $url = "https://api.telegram.org/bot" . API_KEY . "/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    if (curl_error($ch)) {
        var_dump(curl_error($ch));
    } else {
        return json_decode($res);
    }
}

//-------------------------------------------//

function SendDocument($chatid,$document,$caption = null){
	bot('SendDocument',[
	'chat_id'=>$chatid,
	'document'=>$document,
	'caption'=>$caption
	]);
}
function CreateZip($files = array(),$destination) {
    if(file_exists($destination)){
		return false;
	}
    $valid_files = array();
    if(is_array($files)){
        foreach($files as $file){
            if(file_exists($file)){
                $valid_files[] = $file;
            }
        }
    }
    if(count($valid_files)){
        $zip = new ZipArchive();
        if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true){
            return false;
        }
        foreach($valid_files as $file){
            $zip->addFile($file,$file);
        }
        $zip->close();
        return file_exists($destination);
    }else{
        return false;
    }
}
function ForwardMessage($chatid,$from_chat,$message_id){
	bot('ForwardMessage',[
	'chat_id'=>$chatid,
	'from_chat_id'=>$from_chat,
	'message_id'=>$message_id
	]);
	}
function sendAction($chat_id, $action){
    bot('sendChataction',[
        'chat_id'=>$chat_id,
        'action'=>$action
    ]);
}
function sendphoto($ChatId, $photo_id,$caption){
    bot('sendphoto',[
        'chat_id'=>$ChatId,
        'photo'=>$photo_id,
        'caption'=>$caption
    ]);
}
function sendvideo($chat_id,$video_id,$caption){
    bot('sendvideo',[
        'chat_id'=>$chat_id,
        'video'=>$video_id,
        'caption'=>$caption
    ]);
}
function EditMessageText($chat_id, $message_id, $text, $parse_mode, $disable_web_page_preview, $keyboard){
bot('editMessagetext', [
'chat_id' => $chat_id,
'message_id' => $message_id,
'text' => $text,
'parse_mode' => $parse_mode,
'disable_web_page_preview' => $disable_web_page_preview,
'reply_markup' => $keyboard
]);
}
function SendMessage($chatid, $text, $parsmde, $disable_web_page_preview, $keyboard){
bot('sendMessage', [
'chat_id' => $chatid,
'text' => $text,
'parse_mode' => $parsmde,
'disable_web_page_preview' => $disable_web_page_preview,
'reply_markup' => $keyboard
]);
}
//-------------------------------------------//
$update = json_decode(file_get_contents('php://input'));
var_dump($update);
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$chatid = $update->callback_query->message->chat->id;
$text = $message->text;
$textmassage = $message->text;
mkdir("data/$chat_id");
$text1 = $message->text;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$username = $message->from->username;
$message_id = $update->message->message_id;
$messageid = $update->callback_query->message->message_id;
$reply = $update->message->reply_to_message;
$re_id = $update->message->reply_to_message->forward_from->id;
$photo = $update->message->photo;
$data = $update->callback_query->data;
$inline_query = $update->inline_query;
$query_id = $inline_query->id;
$forward_from = $update->message->forward_from;
$forward_from_id = $forward_from->id;
$forward_from_username = $forward_from->username;
$fromm_id = $update->inline_query->from->id;
$fatime = jdate('H:i:s');
$fadate = jdate("Y/F/d");
$ftime = jdate("H:i:s");
$fdate = jdate("Y/F/d");
@$reza = file_get_contents("data/$chat_id/reza.txt");
//-------------------------------------------//
$left = json_decode(file_get_contents("https://api.telegram.org/bot" . API_KEY . "/getChatMember?chat_id=$channel&user_id=$from_id"))->result->status;
//-------------------------------------------//
$mtnechlsh = file_get_contents("data/mtnechlsh.txt");
$asmibrnde = file_get_contents("data/asmibrnde.txt");
//-------------------------------------------//
$command = file_get_contents("data/$from_id/command.txt");
$ubuy = file_get_contents("data/$chat_id/ubuy.txt");
$coin = file_get_contents("data/$chat_id/coin.txt");
$ref = file_get_contents("data/$chat_id/ref.txt");
$AllBuyT = file_get_contents("data/$chat_id/masrafi.txt");
$hazineh = file_get_contents("data/$chat_id/masrafi.txt");
//-------------------------------------------//
$members = file_get_contents("data/members.txt");
$memlist = explode("\n", $members);
$banlist = file_get_contents("data/banlist.txt");
$blist = explode("\n", $banlist);
//-------------------------------------------//
if ($coin < 0) {
    file_put_contents("data/$chat_id/coin.txt", "0");
}
//-------------------------------------------//

if ($left == "left") {
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "
▫️برای فعال شدن ربات باید در کانال زیر عضو شوید 👇

🔹 $channel 

🔹 $channel

⚠️ درصورت عضو نشدن ربات فعال نمی شود ...
✅ پس از عضویت در کانال دستور /start را دوباره تکرار کنید ..
",
        'parse_mode' => 'HTML',
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => "🔻ورود به کانال🔻", 'url' => "http://telegram.me/" . str_replace("@", '', $channel)]]]])
    ]);
} else {

    if (strpos($text, '/start') !== false or $text == "↪️ بازگشت") {

        if (!in_array($chat_id, $memlist)) {
            if (!file_exists("data")) {
                mkdir("data");
            }
            mkdir("data/$from_id");
            $members .= $chat_id . "\n";
            file_put_contents("data/members.txt", "$members");
            file_put_contents("data/$chat_id/zaman.txt", $fdate);
            file_put_contents("data/$chat_id/saat.txt", $ftime);
            file_put_contents("data/$chat_id/coin.txt", "0");
            file_put_contents("data/$chat_id/ubuy.txt", "0");
            file_put_contents("data/$chat_id/ref.txt", "0");
            file_put_contents("data/$chat_id/masrafi.txt", "0");

            $id = str_replace("/start ", "", $text);
            if ($id != "" && $text != "/start" && $id != $from_id) {
                SendMessage($id, "️", "HTML");
                file_put_contents("data/$from_id/refe.txt", "$id");
                $refs = file_get_contents("data/$id/ref.txt");
                $refs = $refs + 1;
                file_put_contents("data/$id/ref.txt", "$refs");
                $ske = file_get_contents("data/$id/coin.txt");
                $seke = $ske + 50;
                file_put_contents("data/$id/coin.txt", "$seke");
                
            }
        }

        file_put_contents("data/$chat_id/command.txt", "none");

        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "
✅ خوش آمدید به ربات افزایش ممبر واقعی کانال و گروه(مای‌ممبر)

✅ انجام سفارشات زیر ۲۰ دقیقه

☎️ شماره تماس ثابت :

05136052471

05136093970

📱 شماره تماس همراه :

09923140672

🌐 آدرس سایت : 

Mymember.website

✅ آدرس سایت شرکت :

Yaraplus.agency

👨‍✈️ مدیریت ربات :

@yaraplus2

coded by @MR_Mordad And @MrMeltu
",
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode([
                'keyboard' => [
                    [['text' => "🤴محصولات اینستاگرام🤴"], ['text' => "🎯محصولات تلگرام🔰"]],
                    [['text' => "😍 دریافت پورسانت"]], 
                    [['text' => "📨 ارتباط با ما"]], 


                ],
                'resize_keyboard' => true,
            ])
        ]);
    }
    //-------------------------------------------//
elseif ($text == '😍 دریافت پورسانت') {
bot('sendMessage', [
'chat_id' => $chat_id,
'text' => "
لینک اختصاصی خود را برای دوستانتان ارسال کنید.هر دوستتان که با کلیک بر روی لینک شما سفارش خود را ثبت کند، ۲ درصد از مبلغ هر سفارش او به موجودی شما افزوده می شود.
",
            'parse_mode'=>"HTML",
 'disable_web_page_preview'=>true,
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅⛓ لینک اختصاصی من",'callback_data'=>"Zir"]],
[['text'=>"➕ تعداد دعوت شده ها",'callback_data'=>"Inv"],['text'=>"🔍 تعداد خرید ها",'callback_data'=>"Sh"]],
[['text'=>"💰 موجودی حساب ",'callback_data'=>"Mo"]],
]
])
]);
}
elseif($data == "Mo" ) {
    bot('answercallbackquery', [
'callback_query_id' => $update->callback_query->id,
'text' => "
💰موجودی حساب شما: $coin تومان
",
'show_alert' => true
]);
}

elseif($data == "Inv" ) {
    bot('answercallbackquery', [
'callback_query_id' => $update->callback_query->id,
'text' => "
🌸تعداد افراد دعوت شده شما:  $ref
",
'show_alert' => true
]);
}

elseif($data == "Zir" ) {
    bot('sendphoto',[
    'chat_id' => $chatid,
    'photo'=>"http://s14.picofile.com/file/8409100576/mem.jpg",
    'caption'=>"🔸ربات افزایش واقعی ممبر تلگرام و فالوور اینستاگرام(مای‌ممبر)

🔹 انجام سفارشات زیر ۲۰ دقیقه

🔹 پرمخاطب ترین ربات تبلیغات در شبکه‌های اجتماعی

کلیک کنید 👇
   
https://t.me/$idbot?start=$chatid
    ",
'parse_mode'=>'html',

    ]);
        bot('sendMessage', [
            'chat_id' => $chatid,
            'text' => "
👆 این پیام را برای دوستان خود ارسال کنید👆
",
        ]);
    } 
    
elseif($data == "Sh" ) {
    bot('answercallbackquery', [
'callback_query_id' => $update->callback_query->id,
'text' => "
📝تعداد خرید افرادی که با لینک شما عضو ربات شدن: $hazineh تومان
",
'show_alert' => true
]);
}
//-------------------------------------------//
elseif ($text == '🤴محصولات اینستاگرام🤴') {
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "
✅ «لیست 🤴محصولات اینستاگرام🤴»

🔹جهت مشاهده توضیحات بر روی نام محصول کلیک کنید.👇",
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode([
                'keyboard' => [
                    [['text' => "✅ فالوور فیک (جبران ریزش)"], ['text' => "♦️ فالوور واقعی پاپ اپ تضمینی"]],
                    [['text' => "🌟 فالوور واقعی پاپ آپ ارسالی"]],
                    [['text' => "↪️ بازگشت"]],

                ],
                'resize_keyboard' => true,
            ])
        ]);
    } 
  
 //-------------------------------------------//
    elseif ($text == '✅ فالوور فیک (جبران ریزش)') {

        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "
       🎯 ✅ فالوور فیک (جبران ریزش)

🔺 لیست قیمت ها
                        
🔹 از 1  کا  تا بی نهایت  فالور
💲 قیمت برای کاربر: 35,000 تومان

➖➖➖➖➖➖➖➖➖

🔺🛒 جهت خرید گزینه های زیر را ارسال کنید👇👇
",
            'parse_mode'=>"HTML",
 'disable_web_page_preview'=>true,
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
	[['text'=>"🎯 سفارش 1 کا فالور",'url'=>"https://t.me/$sup"]],

	[['text'=>"🎯 سفارش 2 کا فالور",'url'=>"https://t.me/$sup"]],

	[['text'=>"🎯 سفارش 3 کا فالور",'url'=>"https://t.me/$sup"]],

	[['text'=>"🎯 سفارش 4 کا فالور",'url'=>"https://t.me/$sup"]],

	[['text'=>"🎯 سفارش 5کا فالور",'url'=>"https://t.me/$sup"]],
		[['text'=>"🎯 سفارش تعداد بالا",'url'=>"https://t.me/$sup"]],

    ]
    ])
  ]);
}
//-------------------------------------------//
  elseif ($text == '♦️ فالوور واقعی پاپ اپ تضمینی') {

 bot('sendAudio',[
	'chat_id'=>$chat_id,
	'audio'=>"https://t.me/noooowjjjqjq/36",
	'caption'=>"🔉 توضیحات صوتی ( ♦️ فالوور واقعی پاپ اپ تضمینی )",

	]);
    		
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "🎯 ♦️ فالوور واقعی پاپ اپ تضمینی

🔺 لیست قیمت ها
                        
🔹 از 1  کا  تا بی نهایت  فالور
💲 قیمت برای کاربر: 370,000 تومان

➖➖➖➖➖➖➖➖➖

🔺🛒 جهت خرید گزینه های زیر را ارسال کنید👇👇",
            'parse_mode'=>"HTML",
 'disable_web_page_preview'=>true,
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
	[['text'=>"🎯 سفارش 1 کا فالور",'url'=>"https://t.me/$sup"]],

	[['text'=>"🎯 سفارش 2 کا فالور",'url'=>"https://t.me/$sup"]],

	[['text'=>"🎯 سفارش 3 کا فالور",'url'=>"https://t.me/$sup"]],

	[['text'=>"🎯 سفارش 4 کا فالور",'url'=>"https://t.me/$sup"]],

	[['text'=>"🎯 سفارش 5کا فالور",'url'=>"https://t.me/$sup"]],
	[['text'=>"🎯 سفارش تعداد بالا",'url'=>"https://t.me/$sup"]],

    ]
    ])
  ]);
}
//-------------------------------------------//
  elseif ($text == '🌟 فالوور واقعی پاپ آپ ارسالی') {

 bot('sendAudio',[
	'chat_id'=>$chat_id,
	'audio'=>"https://t.me/noooowjjjqjq/37",
	'caption'=>"🔉 توضیحات صوتی ( 🌟 فالوور واقعی پاپ آپ ارسالی )",
	]);
    		
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' =>"🎯 🌟 فالوور واقعی پاپ آپ ارسالی

🔺 لیست قیمت ها
                        
🔹 1 دفعه ارسال ( امکان جذب زیر 1 کا و یا بیش از 1 کا )
💲 قیمت برای کاربر: 300,000 تومان

➖➖➖➖➖➖➖➖➖

🔺🛒 جهت خرید گزینه های زیر را ارسال کنید👇👇",
            'parse_mode'=>"HTML",
 'disable_web_page_preview'=>true,
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
	[['text'=>"🎯 سفارش 1 کا فالور",'url'=>"https://t.me/$sup"]],

	[['text'=>"🎯 سفارش 2 کا فالور",'url'=>"https://t.me/$sup"]],

	[['text'=>"🎯 سفارش 3 کا فالور",'url'=>"https://t.me/$sup"]],

	[['text'=>"🎯 سفارش 4 کا فالور",'url'=>"https://t.me/$sup"]],

	[['text'=>"🎯 سفارش 5کا فالور",'url'=>"https://t.me/$sup"]],
	[['text'=>"🎯 سفارش تعداد بالا",'url'=>"https://t.me/$sup"]],

    ]
    ])
  ]);
}

//-------------------------------------------//
elseif ($text == '💥ممبر واقعی پاپ آپ (کیفیت متوسط)') {
bot('sendAudio',[
'chat_id'=>$chat_id,
'audio'=>"https://t.me/efwuhiefu/2",
'caption'=>"
🔉 توضیحات صوتی ( 💥ممبر واقعی پاپ آپ (کیفیت متوسط) )
",
]);
bot('sendMessage', [
'chat_id' => $chat_id,
'text' => "
🎯 💥ممبر واقعی پاپ آپ (کیفیت متوسط)

🔺 لیست قیمت ها
                        
🔹 از 1  کا  تا بی نهایت  ممبر
💲 قیمت برای کاربر: 78,000 تومان

➖➖➖➖➖➖➖➖➖

🔺🛒 جهت خرید گزینه های زیر را ارسال کنید👇👇
",
'parse_mode'=>"HTML",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"👤سفارش 1 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 2 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 3 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 4 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 5 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش تعداد بالا",'url'=>"https://t.me/$sup"]],
]])
]);
}
//-------------------------------------------//
elseif ($text == '🎯ممبر واقعی اد اجباری') {
bot('sendAudio',[
'chat_id'=>$chat_id,
'audio'=>"https://t.me/efwuhiefu/3",
'caption'=>"
🔉 توضیحات صوتی ( 🎯ممبر واقعی اد اجباری )
",
]);
bot('sendMessage', [
'chat_id' => $chat_id,
'text' => "
🎯 🎯ممبر واقعی اد اجباری

🔺 لیست قیمت ها
                        
🔹 از 1  کا  تا بی نهایت  ممبر
💲 قیمت برای کاربر: 11,000 تومان

➖➖➖➖➖➖➖➖➖

🔺🛒 جهت خرید گزینه های زیر را ارسال کنید👇👇
",
'parse_mode'=>"HTML",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"👤سفارش 1 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 2 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 3 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 4 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 5 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش تعداد بالا",'url'=>"https://t.me/$sup"]],
]])
]);
}
//-------------------------------------------//
elseif ($text == '🔆 ممبر واقعی پاپ آپ (کیفیت عالی)') {
bot('sendAudio',[
'chat_id'=>$chat_id,
'audio'=>"https://t.me/efwuhiefu/4",
'caption'=>"
🔉 توضیحات صوتی ( 🔆 ممبر واقعی پاپ آپ (کیفیت عالی) )
",
]);
bot('sendMessage', [
'chat_id' => $chat_id,
'text' => "
🎯 🔆 ممبر واقعی پاپ آپ (کیفیت عالی)

🔺 لیست قیمت ها
                        
🔹 از 1  کا  تا بی نهایت  ممبر
💲 قیمت برای کاربر: 90,000 تومان

➖➖➖➖➖➖➖➖➖

🔺🛒 جهت خرید گزینه های زیر را ارسال کنید👇👇
",
'parse_mode'=>"HTML",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"👤سفارش 1 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 2 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 3 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 4 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 5 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش تعداد بالا",'url'=>"https://t.me/$sup"]],
]])
]);
}
//-------------------------------------------//
elseif ($text == '🥇 ممبر واقعی پروکسی تضمینی') {
bot('sendAudio',[
'chat_id'=>$chat_id,
'audio'=>"https://t.me/efwuhiefu/5",
'caption'=>"
🔉 توضیحات صوتی ( 🥇 ممبر واقعی پروکسی تضمینی )
",
]);
bot('sendMessage', [
'chat_id' => $chat_id,
'text' => "
🎯 🥇 ممبر واقعی پروکسی تضمینی

🔺 لیست قیمت ها
                        
🔹 از 1  کا  تا بی نهایت  ممبر
💲 قیمت برای کاربر: 400,000 تومان

➖➖➖➖➖➖➖➖➖

🔺🛒 جهت خرید گزینه های زیر را ارسال کنید👇👇
",
'parse_mode'=>"HTML",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"👤سفارش 1 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 2 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 3 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 4 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 5 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش تعداد بالا",'url'=>"https://t.me/$sup"]],
]])
]);
}
//-------------------------------------------//
elseif ($text == '⏱ممبر واقعی پروکسی ساعتی') {
bot('sendAudio',[
'chat_id'=>$chat_id,
'audio'=>"https://t.me/efwuhiefu/6",
'caption'=>"
🔉 توضیحات صوتی (  ⏱ممبر واقعی پروکسی ساعتی )
",
]);
bot('sendMessage', [
'chat_id' => $chat_id,
'text' => "
⏱ممبر واقعی پروکسی ساعتی

🔺 لیست قیمت ها
                        
🔹 از 1  کا  تا بی نهایت  ممبر
💲 قیمت برای کاربر: 120,000 تومان

➖➖➖➖➖➖➖➖➖

🔺🛒 جهت خرید گزینه های زیر را ارسال کنید👇👇
",
'parse_mode'=>"HTML",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"👤سفارش 1 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 2 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 3 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 4 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 5 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش تعداد بالا",'url'=>"https://t.me/$sup"]],
]])
]);
}
/*
نویسنده
@Mr_mordad
@Mrmeltu
-------------
اوپن شده در ملتوتیم و ایس سورس
@meltutm
@icesource
--------------------------
کص ننت بدون منبع اصکی بری حتی شما دوست عزیز
---------------------------------------
*/
//-------------------------------------------//
elseif ($text == '⚡️ممبر فیک کانال ریزش کم') {
bot('sendAudio',[
'chat_id'=>$chat_id,
'audio'=>"https://t.me/efwuhiefu/7",
'caption'=>"
🔉 توضیحات صوتی ( ⚡️ممبر فیک کانال ریزش کم )
",
]);
bot('sendMessage', [
'chat_id' => $chat_id,
'text' => "
🎯 ⚡️ممبر فیک کانال ریزش کم

🔺 لیست قیمت ها
                        
🔹 از 1  کا  تا بی نهایت  ممبر
💲 قیمت برای کاربر: 14,000 تومان

➖➖➖➖➖➖➖➖➖

🔺🛒 جهت خرید گزینه های زیر را ارسال کنید👇👇
",
'parse_mode'=>"HTML",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"👤سفارش 1 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 2 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 3 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 4 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 5 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش تعداد بالا",'url'=>"https://t.me/$sup"]],
]])
]);
}
//-------------------------------------------//
elseif ($text == '🎲ممبر فیک کانال بدون ریزش') {
bot('sendAudio',[
'chat_id'=>$chat_id,
'audio'=>"https://t.me/efwuhiefu/8",
'caption'=>"
🔉 توضیحات صوتی ( 🎲ممبر فیک کانال بدون ریزش )
",
]);
bot('sendMessage', [
'chat_id' => $chat_id,
'text' => "
🎯 ⚡️ممبر فیک کانال ریزش کم

🔺 لیست قیمت ها
                        
🔹 از 1  کا  تا بی نهایت  ممبر
💲 قیمت برای کاربر: 14,000 تومان

➖➖➖➖➖➖➖➖➖

🔺🛒 جهت خرید گزینه های زیر را ارسال کنید👇👇
",
'parse_mode'=>"HTML",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"👤سفارش 1 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 2 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 3 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 4 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 5 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش تعداد بالا",'url'=>"https://t.me/$sup"]],
]])
]);
}
//-------------------------------------------//
elseif ($text == '🔻ممبر فیک گروه') {
bot('sendAudio',[
'chat_id'=>$chat_id,
'audio'=>"https://t.me/efwuhiefu/9",
'caption'=>"
🔉 توضیحات صوتی ( 🔻ممبر فیک گروه )
",
]);
bot('sendMessage', [
'chat_id' => $chat_id,
'text' => "
🎯 🔻ممبر فیک گروه

🔺 لیست قیمت ها
                        
🔹 از 1  کا  تا بی نهایت  ممبر
💲 قیمت برای کاربر: 13,000 تومان

➖➖➖➖➖➖➖➖➖

🔺🛒 جهت خرید گزینه های زیر را ارسال کنید👇👇
",
'parse_mode'=>"HTML",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"👤سفارش 1 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 2 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 3 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 4 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 5 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش تعداد بالا",'url'=>"https://t.me/$sup"]],
]])
]);
}
//-------------------------------------------//
elseif ($text == '👁‍🗨 بازدید فیک پست') {
bot('sendAudio',[
'chat_id'=>$chat_id,
'audio'=>"https://t.me/efwuhiefu/10",
'caption'=>"
🔉 توضیحات صوتی ( 👁‍🗨 بازدید فیک پست )
",
]);
bot('sendMessage', [
'chat_id' => $chat_id,
'text' => "
🎯 🔻ممبر فیک گروه

🔺 لیست قیمت ها
                        
🔹 از 1  کا  تا بی نهایت  سین
💲 قیمت برای کاربر: 8,000 تومان

➖➖➖➖➖➖➖➖➖

🔺🛒 جهت خرید گزینه های زیر را ارسال کنید👇👇
",
'parse_mode'=>"HTML",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"👁‍🗨سفارش 1 کا سین",'url'=>"https://t.me/$sup"]],
[['text'=>"👁‍🗨سفارش 2 کا سین",'url'=>"https://t.me/$sup"]],
[['text'=>"👁‍🗨سفارش 3 کا سین",'url'=>"https://t.me/$sup"]],
[['text'=>"👁‍🗨سفارش 4 کا سین",'url'=>"https://t.me/$sup"]],
[['text'=>"👁‍🗨سفارش 5 کا سین",'url'=>"https://t.me/$sup"]],
[['text'=>"👁‍🗨سفارش تعداد بالا",'url'=>"https://t.me/$sup"]],
]])
]);
}
//-------------------------------------------//
elseif ($text == '🌟ممبر واقعی گروه') {
bot('sendAudio',[
'chat_id'=>$chat_id,
'audio'=>"https://t.me/efwuhiefu/11",
'caption'=>"
🔉 توضیحات صوتی ( 🌟ممبر واقعی گروه )
",
]);
bot('sendMessage', [
'chat_id' => $chat_id,
'text' => "
🎯 🌟ممبر واقعی گروه

🔺 لیست قیمت ها
                        
🔹 از 1  کا  تا بی نهایت  ممبر
💲 قیمت برای کاربر: 15,000 تومان

➖➖➖➖➖➖➖➖➖

🔺🛒 جهت خرید گزینه های زیر را ارسال کنید👇👇
",
'parse_mode'=>"HTML",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"👤سفارش 1 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 2 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 3 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 4 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش 5 کا ممبر",'url'=>"https://t.me/$sup"]],
[['text'=>"👤سفارش تعداد بالا",'url'=>"https://t.me/$sup"]],
]])
]);
}
//-------------------------------------------//

  elseif ($text == '📨 ارتباط با ما') {

        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "
جهت ارتباط با پشتیبانی از دکمه زیر استفاده کنید👇
",
            'parse_mode'=>"HTML",
 'disable_web_page_preview'=>true,
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
	[['text'=>"👔ورود به پشتیبانی👔",'url'=>"https://t.me/$sup"]],
]
    ])
  ]);
}
//-------------------------------------------//
 elseif ($text == '🎯محصولات تلگرام🔰') {
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "✅ «لیست  🎯محصولات تلگرام🔰»

🔹جهت مشاهده توضیحات بر روی نام محصول کلیک کنید.👇",
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode([
                'keyboard' => [
                    [['text' => "💥ممبر واقعی پاپ آپ (کیفیت متوسط)"], ['text' => "🎯ممبر واقعی اد اجباری"]],
                    [['text' => "🔆 ممبر واقعی پاپ آپ (کیفیت عالی)"], ['text' => "🥇 ممبر واقعی پروکسی تضمینی"]],
                    [['text' => "⏱ممبر واقعی پروکسی ساعتی"], ['text' => "⚡️ممبر فیک کانال ریزش کم"]],
                    [['text' => "🎲ممبر فیک کانال بدون ریزش"], ['text' => "🔻ممبر فیک گروه"]],
                    [['text' => "👁‍🗨 بازدید فیک پست"], ['text' => "🌟ممبر واقعی گروه"]],
                    [['text' => "↪️ بازگشت"]],

                ],
                'resize_keyboard' => true,
            ])
        ]);
    } 
//-------------------------------------------//
if ($text == '/panel' and $chat_id == $admin) {
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "
🔻به پنل مدیریت خوش آمدید
",
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode([
                'keyboard' => [
                    [['text' => "🗂 پشتیبان گیری"],['text' => "✅آمار ربات"]],

                    [['text' => "↪️ بازگشت"]],
                ],
                'resize_keyboard' => true,
            ])
        ]);
    }
	//////////////////////////////
	if ($text == '✅آمار ربات' and $chat_id == $admin) {
         $memCOUNT = count(scandir("data")) - 3; // تعداد ممبر ها
            $banCOUNT = count(explode("\n",$banlist));
            bot('sendMessage', [
                'chat_id' => $chat_id,
                'text' => "users count : $memCOUNT \nban count : $banCOUNT",
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode([
                'keyboard' => [                    
                    [['text' => "↪️ بازگشت"]],
                ],
                'resize_keyboard' => true,
            ])
        ]);
    }
	
    //-------------------------------------------//
    if ($text == '🔙 بازگشت به مدیریت' and $chat_id == $admin) {
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "
🔻به پنل مدیریت دوباره خوش آمدید ..
",
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode([
                'keyboard' => [
                    [['text' => "🗂 پشتیبان گیری"]],
                    
                    [['text' => "↪️ بازگشت"]],
                ],
                'resize_keyboard' => true,
            ])
        ]);
    }
    //-------------------------------------------//
    if ($text == '🗂 پشتیبان گیری' and $chat_id == $admin) {
    		var_dump(bot('sendMessage',[
        	'chat_id'=>$update->message->chat->id,
        	'text'=>"🗂 به قسمت بکاپ گیری خوش آمدید ..",
        'reply_to_message_id'=>$message_id,
        'disable_web_page_preview'=>true,
		'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                   [['text'=>"🗳 بکاپ از کاربران"]],
                   [['text'=>"🔙 بازگشت به مدیریت"]]
            	],
            	'resize_keyboard'=>true
       		])
    		]));
    		
	}
     if ($text == '🗳 بکاپ از کاربران' and $chat_id == $admin) {
    SendMessage($chat_id,"■ نسخه پشتیبان درحال آماده سازی است.\n■ منتظر بمانید ...", 'MarkDown', $message_id);
copy('data/members.txt','members.txt');
 $file_to_zip = array('members.txt');
 $create = CreateZip($file_to_zip, "backup.zip");
 $zipfile = new CURLFile("backup.zip");
 SendDocument($chat_id, $zipfile, "This Backup Of user\n📅 تاریخ: $fadate\n⏰ ساعت: $fatime");
 unlink('members.txt');
 unlink('backup.zip');
 unlink('updates.txt');
}
if (file_exists("error_log")) unlink("error_log");
}
/*
نویسنده
@Mr_mordad
@Mrmeltu
-------------
اوپن شده در ملتوتیم و ایس سورس
@meltutm
@icesource
--------------------------
کص ننت بدون منبع اصکی بری حتی شما دوست عزیز
---------------------------------------
*/

?>
