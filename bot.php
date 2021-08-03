<?php
$ttti = time();
error_reporting(0);
define('API_KEY','1738472642:AAECiTgtt1QfKtI40j46p3aHJCDScb2Tk2M');
include("jdf.php");
$token = API_KEY;
//-----------------------------------------------------------------------------------------
$telegram_ip_ranges = [
['lower' => '149.154.160.0', 'upper' => '149.154.175.255'], // literally 149.154.160.0/20
['lower' => '91.108.4.0',    'upper' => '91.108.7.255'],    // literally 91.108.4.0/22
];

$ip_dec = (float) sprintf("%u", ip2long($_SERVER['REMOTE_ADDR']));
$ok=false;
foreach ($telegram_ip_ranges as $telegram_ip_range) if (!$ok) {
    if(!$ok)
	{
		$lower_dec = (float) sprintf("%u", ip2long($telegram_ip_range['lower']));
		$upper_dec = (float) sprintf("%u", ip2long($telegram_ip_range['upper']));
		if($ip_dec >= $lower_dec and $ip_dec <= $upper_dec)
		{
			$ok=true;
			}
		}
	}
if(!$ok)
{
	exit(header("location: https://snowypage.xyz"));
	}
//-----------------------------------------------------------------------------------------------
//functions
function bot($method,$datas=[]){
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));
}else{
return json_decode($res);
}
}
function SM($chatID)
{
	$tab = json_decode(file_get_contents("../../lib/Jsons/tab.json"),true);
	if($tab['type'] == 'photo')
	{
		bot('sendphoto',['chat_id'=>$chatID,'photo'=>$tab["msgid"],'caption'=>$tab["text"],'reply_markup'=>$tab['reply_markup']]);
	}
	else if($tab['type'] == 'file')
	{
		bot('sendDocument',['chat_id'=>$chatID,'document'=>$tab["msgid"],'caption'=>$tab["text"],'reply_markup'=>$tab['reply_markup']]);
	}
	else if($tab['type'] == 'video')
	{
		bot('SendVideo',['chat_id'=>$chatID,'video'=>$tab["msgid"],'caption'=>$tab["text"],'reply_markup'=>$tab['reply_markup']]);
	}
	else if($tab['type'] == 'music')
	{
		bot('SendAudio',['chat_id'=>$chatID,'audio'=>$tab["msgid"],'caption'=>$tab["text"],'reply_markup'=>$tab['reply_markup']]);
	}
	else if($tab['type'] == 'sticker')
	{
		bot('SendSticker',['chat_id'=>$chatID,'sticker'=>$tab["msgid"],'caption'=>$tab["text"],'reply_markup'=>$tab['reply_markup']]);
	}
	else if($tab['type'] == 'voice')
	{
		bot('SendVoice',['chat_id'=>$chatID,'voice'=>$tab["msgid"],'caption'=>$tab["text"],'reply_markup'=>$tab['reply_markup']]);
	}
	else
	{
		if($tab['reply_markup'] != null)
		{
			bot('SendMessage',['chat_id'=>$chatID,'text'=>$tab['text'],'reply_markup'=>$tab['reply_markup']]);
		}
		else
		{
			bot('SendMessage',['chat_id'=>$chatID,'text'=>$tab['text']]);
		}
	}
}
function SendPhoto($chat_id,$link,$text) {
bot('SendPhoto',['chat_id' => $chat_id, 'photo' => $link, 'caption' => $text]);
}
function sendmessage($chat_id,$text){
bot('sendMessage',['chat_id'=>$chat_id,'text'=>$text,'parse_mode'=>"html"]);
}
function save($filename, $data)
{
$file = fopen($filename, 'w');
fwrite($file, $data);
fclose($file);
}
function getChatstats($chat_id,$aboltok) {
  $url = 'https://api.telegram.org/bot'.$aboltok.'/getChatAdministrators?chat_id=@'.$chat_id;
  $result = file_get_contents($url);
  $result = json_decode ($result);
  $result = $result->ok;
  return $result;
}
function getRanks($file){
   $users = scandir('Sourrce_kade/');
   $users = array_diff($users,[".",".."]);
   $coins =[];
   foreach($users as $user){
    $coin = json_decode(file_get_contents('Sourrce_kade/'.$user.'/'.$user.'.json'),true)["$file"];
    $coins[$user] = $coin;
}
   arsort($coins);
   foreach($coins as $key => $user){
   $list[] = array('user'=>$key,'coins'=>$coins[$key]);
   } 
   return $list;
}
function deletemessage($chat_id,$message_id){
bot('deletemessage', ['chat_id' => $chat_id,'message_id' => $message_id,]);
}
function gcmc($chat_id,$aboltok) {
  $url = 'https://api.telegram.org/bot'.$aboltok.'/getChatMembersCount?chat_id='.$chat_id;
  $result = file_get_contents($url);
  $result = json_decode ($result);
  $result = $result->result;
  return $result;
}
function EditMessageText($chat_id,$meesage_id,$text,$reply_markup){
bot('EditMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>$text,
'reply_markup'=>$reply_markup
]);
}
//Variables
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$text = $message->text;
$data = $update->callback_query->data;
$tc = $message->chat->type;
$message_id = $message->message_id;
$first_name = $message->from->first_name;
$from_id = $message->from->id;
$first = $message->from->first_name;
$last = $message->from->last_name;
$username = $message->from->username;
$first2 = $update->callback_query->message->chat->first_name;
$last2 = $update->callback_query->message->chat->last_name;
$chatid = $update->callback_query->message->chat->id;
$data = $update->callback_query->data;
$message_id2 = $update->callback_query->message->message_id;
$photo = $message->photo;
$admin = "201327491";
$channel = file_get_contents("channel.txt");
$timech = "60";
mkdir("Sourrce_kade");
mkdir("Sourrce_kade/$from_id");
$Shdks = file_get_contents("Sourrce_kade/$from_id/Shdks.txt");
if (!file_exists("Sourrce_kade/$from_id/$from_id.json")){mkdir("Sourrce_kade/$from_id");}
$Sourrce_kade = json_decode(file_get_contents("Sourrce_kade/$from_id/$from_id.json"),true);
$Sourrce_kade1 = json_decode(file_get_contents("Sourrce_kade/$chatid/$chatid.json"),true);
$step = $Sourrce_kade["step"];
$coin = $Sourrce_kade["coin"];
$phone = $Sourrce_kade["phone"];
$inv = $Sourrce_kade["inv"];
$warn = $Sourrce_kade["warn"];
$timeee = $ttti - 60;
if(is_file("time") or file_get_contents("time") <= $timeee){
	file_put_contents("time",$ttti);
}
if($warn >= 3){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📍 شما سه اخطار دریافت کردید و از ربات مسدود شدید",
]); 
exit();
}
$time = jdate('H:i:s');
$date = jdate("Y/m/d");
/////////////------//////////
$chads = file_get_contents("cht.txt");
$chor = file_get_contents("Sourrce_kade/ch.txt");
$channels = json_decode(file_get_contents("https://api.telegram.org/bot$aboltok/getChatMember?chat_id=@$chor&user_id=".$from_id or $chatid));
$to = $channels->result->status;
$reply = $update->message->reply_to_message->forward_from->id;
//============================================================================//
if(strpos($text == "/start") !== false  and $text !=="/start" and $tc == 'private'){
$id=str_replace("/start ","",$text);
$amar=file_get_contents("Sourrce_kade/abolfazli.txt");
$exp=explode("\n",$amar);
if(!in_array($from_id,$exp) and $from_id != $id){
if(!is_file("VIP")){
	SM($chat_id);
}
$myfile2 = fopen("Sourrce_kade/abolfazli.txt", "a") or die("Unable to open file!");
$Sourrce_kade = json_decode(file_get_contents("Sourrce_kade/$from_id/$from_id.json"),true);
fwrite($myfile2, "$from_id\n");
fclose($myfile2);
$Sourrce_kade["step"] = "free";
$Sourrce_kade["coin"] = "0";
$Sourrce_kade["inv"] = "0";
$Sourrce_kade["warn"] = "0";
$Sourrce_kade["phone"] = "No";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
$Sourrce_kade12 = json_decode(file_get_contents("Sourrce_kade/$id/$id.json"),true);
$invite1 = $Sourrce_kade12["inv"];
settype($invite1,"integer");
$newinvite = $invite1 + 1;
$Sourrce_kade12["inv"] = $newinvite;
$outjson = json_encode($Sourrce_kade12,true);
file_put_contents("Sourrce_kade/$from_id/Shdks.txt",$id);
file_put_contents("Sourrce_kade/$id/$id.json",$outjson);
$Sourrce_kade1234 = json_decode(file_get_contents("Sourrce_kade/$id/$id.json"),true);
$invite122 = $Sourrce_kade1234["coin"];
settype($invite122,"integer");
$newinvite664 = $invite122 + 1;
$Sourrce_kade1234["coin"] = $newinvite664;
$outjson = json_encode($Sourrce_kade1234,true);
file_put_contents("Sourrce_kade/$id/$id.json",$outjson);
if($phone == No){
$Sourrce_kade["step"] = "wqkxoTyq";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
لطفا شماره همراه خود را با استفاده از دکمه 🔒 تایید و ارسال شماره ارسال نمایید.

📌 برای جلوگیری از سواستفاده برخی افراد نیاز است شماره خود را ارسال و تایید نمایید. شماره همراه شما در جایی استفاده نخواهد شد و اینکار تنها برای احراز هویت شماست.",
'reply_markup' => json_encode([ 
'resize_keyboard'=>true, 
'keyboard' => [ 
[['text'=>"🔒 تایید و ارسال شماره",'request_contact'=>true]] 
], 
]) 
]); 
}else{
$Sourrce_kade["step"] = "none";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅سلام $first به بانک نیتروسین خوش امدید!
برای ادامه کار یک بخش را انتخاب کنید:
$date $time",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>'• دریافت نیتروسین •'],['text'=>'• دریافت هارپ سین •']],
[['text'=>''],['text'=>'🔐حساب کاربری']],
[['text'=>"💰تعرفه"],['text'=>"♻️ آپدیت ربات"],['text'=>"📜 پیگیری سفارش"]],
[['text'=>'➕ افزایش موجودی'],['text'=>'💸 انتقال سکه']],
[['text'=>"⚖ قوانین"],['text'=>"📞 پشتیبانی"],['text'=>"📚 راهنما"]],
],
"resize_keyboard"=>true,
])
]); 
}}}
if (!file_exists("Sourrce_kade/$from_id/$from_id.json")) {
$myfile2 = fopen("Sourrce_kade/abolfazli.txt", "a") or die("Unable to open file!");
fwrite($myfile2, "$from_id\n");
fclose($myfile2);
$Sourrce_kade["step"] = "free";
$Sourrce_kade["coin"] = "0";
$Sourrce_kade["inv"] = "0";
$Sourrce_kade["warn"] = "0";
$Sourrce_kade["phone"] = "No";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
}
if($text == "/start" and $tc == 'private'){
if($phone == No){
$Sourrce_kade["step"] = "wqkxoTyq";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
لطفا شماره همراه خود را با استفاده از دکمه 🔒 تایید و ارسال شماره ارسال نمایید.

📌 برای جلوگیری از سواستفاده برخی افراد نیاز است شماره خود را ارسال و تایید نمایید. شماره همراه شما در جایی استفاده نخواهد شد و اینکار تنها برای احراز هویت شماست.",
'reply_markup' => json_encode([ 
'resize_keyboard'=>true, 
'keyboard' => [ 
[['text'=>"🔒 تایید و ارسال شماره",'request_contact'=>true]] 
], 
]) 
]); 
}else{
$Sourrce_kade["step"] = "none";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅سلام $first به بانک نیتروسین خوش امدید!
برای ادامه کار یک بخش را انتخاب کنید:
$date $time",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>'• دریافت نیتروسین •'],['text'=>'• دریافت هارپ سین •']],
[['text'=>''],['text'=>'🔐حساب کاربری']],
[['text'=>"💰تعرفه"],['text'=>"♻️ آپدیت ربات"],['text'=>"📜 پیگیری سفارش"]],
[['text'=>'➕ افزایش موجودی'],['text'=>'💸 انتقال سکه']],
[['text'=>"⚖ قوانین"],['text'=>"📞 پشتیبانی"],['text'=>"📚 راهنما"]],
],
"resize_keyboard"=>true,
])
]); 
}}
elseif($step == "wqkxoTyq" and isset($message->contact)){
  if($update->message->contact->user_id == $from_id){
$phone =$message->contact->phone_number;
if(strpos($phone,'98') === 0 || strpos($phone,'+98') === 0){
$phone = '0'.strrev(substr(strrev($phone),0,10));
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"✅ | با تشکر از همکاری شما !
 
 📞 | شماره ثبت شده شما : $phone
 
 👈 | جهت ادامه روی /start بزنید.",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>'• دریافت نیتروسین •'],['text'=>'• دریافت هارپ سین •']],
[['text'=>''],['text'=>'🔐حساب کاربری']],
[['text'=>"💰تعرفه"],['text'=>"♻️ آپدیت ربات"],['text'=>"📜 پیگیری سفارش"]],
[['text'=>'➕ افزایش موجودی'],['text'=>'💸 انتقال سکه']],
[['text'=>"⚖ قوانین"],['text'=>"📞 پشتیبانی"],['text'=>"📚 راهنما"]],
],
"resize_keyboard"=>true,
])
]);
$Sourrce_kade["phone"] = "$phone";
$Sourrce_kade["step"] = "free";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"
شماره جدید ثبت شد

شماره : $phone
ایدی عددی فرد : $from_id
یوزرنیم فرد : @$username
",
]);
}else{
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"❌ | این ربات در حال حاضر برای منطقه یا کشور شما فعال نمی‌باشد",
'reply_markup'=>$home
]);
}
}else{
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا شماره همراه خود را با استفاده از دکمه 🔒 تایید و ارسال شماره ارسال نمایید.

📌 برای جلوگیری از سواستفاده برخی افراد نیاز است شماره خود را ارسال و تایید نمایید. شماره همراه شما در جایی استفاده نخواهد شد و اینکار تنها برای احراز هویت شماست.",
'reply_markup' => json_encode([
'resize_keyboard'=>true,
'keyboard' => [
[['text'=>"🔒 تایید و ارسال شماره",'request_contact'=>true]]
],
])
]);
}
}
if($phone == No){
$Sourrce_kade["step"] = "wqkxoTyq";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
لطفا شماره همراه خود را با استفاده از دکمه 🔒 تایید و ارسال شماره ارسال نمایید.

📌 برای جلوگیری از سواستفاده برخی افراد نیاز است شماره خود را ارسال و تایید نمایید. شماره همراه شما در جایی استفاده نخواهد شد و اینکار تنها برای احراز هویت شماست.",
'reply_markup' => json_encode([ 
'resize_keyboard'=>true, 
'keyboard' => [ 
[['text'=>"🔒 تایید و ارسال شماره",'request_contact'=>true]] 
], 
]) 
]);
exit();
}
if($text == "🔙 | بازگشت" and $tc == 'private'){
$Sourrce_kade["step"] = "free";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👈 به منو برگشتید",
'parse_mode'=>"HTML",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>'• دریافت نیتروسین •'],['text'=>'• دریافت هارپ سین •']],
[['text'=>''],['text'=>'🔐حساب کاربری']],
[['text'=>"💰تعرفه"],['text'=>"♻️ آپدیت ربات"],['text'=>"📜 پیگیری سفارش"]],
[['text'=>'➕ افزایش موجودی'],['text'=>'💸 انتقال سکه']],
[['text'=>"⚖ قوانین"],['text'=>"📞 پشتیبانی"],['text'=>"📚 راهنما"]],
],
"resize_keyboard"=>true,
])
]); 
}
if($text == "➕ افزایش موجودی" and $tc == 'private'){
$Sourrce_kade["step"] = "free";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا دکمه مورد نظر را خود را  انتخاب کنید : 👇🏻",
'parse_mode'=>"HTML",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🗣 دعوت دیگران"],['text'=>"🎁 کد هدیه"]],
[['text'=>""],['text'=>"🔖 سکه روزانه"]],
[['text'=>"🔙 | بازگشت"]],
],
"resize_keyboard"=>true,
])
]); 
}
elseif($text == "🎁 کد هدیه" and $tc == 'private'){
mkdir("Sourrce_kade/codes");	
$Sourrce_kade["step"] = "smxlslcnq";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"💠 | کد هدیه را ارسال کنید

❗️| در صورت فعال بودن کد و اولین بار استفاده سکه هدیه دریافت میکنید",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🔙 | بازگشت"]],
],
"resize_keyboard"=>true,
])
]); 
}
if($step == "smxlslcnq" and $text != "🔙 | بازگشت" and $tc == 'private'){ 
      if(file_exists("Sourrce_kade/codes/$text.txt")){
        $codefree = file_get_contents("Sourrce_kade/codes/$text.txt");
        $Sourrce_kade = json_decode(file_get_contents("Sourrce_kade/$chat_id/$chat_id.json"),true);
        $newin = $coin + $codefree;
        $Sourrce_kade["coin"] = "$newin";
        $Sourrce_kade["step"] = "free";
        $outjson = json_encode($Sourrce_kade,true);
        file_put_contents("Sourrce_kade/$chat_id/$chat_id.json",$outjson);
		SendMessage($chat_id,"تبریک | 🎉
کد شما صحیح بود و شما مقدار $codefree سکه هدیه دریافت کردید");
        unlink("Sourrce_kade/codes/$text.txt");
	}else{
		SendMessage($chat_id,"❌ | کد ارسالی نامعتبر و یا استفاده شده می باشد");
	}
}
if($text == "💸 انتقال سکه" and $tc == 'private'){
if($coin >= 100){
$Sourrce_kade["step"] = "sjsjajkska";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"آیدی عددی فرد را ارسال کنید!",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🔙 | بازگشت"]],
],
"resize_keyboard"=>true,
])
]);
}else{
$Sourrce_kade["step"] = "none";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"حداقل سکه جهت انتقال ۱۰۰ سکه میباشد",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🔙 | بازگشت"]],
],
"resize_keyboard"=>true,
])
]);
}}
elseif($step == "sjsjajkska" and $text != "🔙 | بازگشت" and $tc == 'private'){ 
if(file_exists("Sourrce_kade/$text/$text.json")){
$Sourrce_kade["step"] = "ososksks";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
file_put_contents("Sourrce_kade/$from_id/id.txt",$text);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"چند سکه میخواید به کاربر $text انتقال بدهید ؟",
]);
}else{
$Sourrce_kade["step"] = "none";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"ای دی عددی که ارسال کردید در ربات نمیباشد ",
]);
}}
elseif($step == "ososksks" and $text != "🔙 | بازگشت" and $tc == 'private' and is_numeric($text)){ 
if($text >= 100 and $text <= 10000 and $coin >= $text){
$Sourrce_kade["step"] = "free";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
$id = file_get_contents("Sourrce_kade/$from_id/id.txt");
$Sourrce_kade = json_decode(file_get_contents("Sourrce_kade/$id/$id.json"),true);
$coinsj = $Sourrce_kade["coin"];
$newin =  $coinsj + $text;
$Sourrce_kade["coin"] = "$newin";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$id/$id.json",$outjson);
$Sourrce_kade = json_decode(file_get_contents("Sourrce_kade/$from_id/$from_id.json"),true);
$coin = $Sourrce_kade["coin"];
$newinn =  $coin - $text;
$Sourrce_kade["coin"] = "$newinn";
$Sourrce_kade["step"] = "free";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$id,
'text'=>"تعداد $text سکه از کاربر $from_id به شما اضافه شد ",
'parse_mode'=>"MarkDown",
]); 
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"تعداد $text سکه به کاربر $id اضافه شد ",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>'• دریافت نیتروسین •'],['text'=>'• دریافت هارپ سین •']],
[['text'=>''],['text'=>'🔐حساب کاربری']],
[['text'=>"💰تعرفه"],['text'=>"♻️ آپدیت ربات"],['text'=>"📜 پیگیری سفارش"]],
[['text'=>'➕ افزایش موجودی'],['text'=>'💸 انتقال سکه']],
[['text'=>"⚖ قوانین"],['text'=>"📞 پشتیبانی"],['text'=>"📚 راهنما"]],
],
"resize_keyboard"=>true,
])
    ]);
}else{
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"حداقل سکه جهت انتقال ۱۰۰ سکه و حداکثر ۱۰,۰۰۰ سکه است تعداد سکه را با توجه به موجودی خود ارسال کنید",
'parse_mode'=>"MarkDown",
    ]);
}}
elseif($text == "• دریافت هارپ سین •" and $tc == 'private'){
if($coin >= 1000){
$Sourrce_kade["step"] = "bradsksksk";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅چه مقدار سکه میخواهید از حساب خود برداشت کنید و ارسال کنید .

💰 حداقل 1000 سکه",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🔙 | بازگشت"]],
],
"resize_keyboard"=>true,
])
]);
}else{
$Sourrce_kade["step"] = "none";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"جهت برداشت باید حداقل 1000 سکه داشته باشید",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🔙 | بازگشت"]],
],
"resize_keyboard"=>true,
])
]);
}}
elseif($step == "bradsksksk" and $text != "🔙 | بازگشت" and $tc == 'private'){ 
$Sourrce_kade["step"] = "free";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
if(is_numeric($text)){
         $Sourrce_kade = json_decode(file_get_contents("Sourrce_kade/$from_id/$from_id.json"),true);
        $inv = $Sourrce_kade["coin"];
    if ($inv >= $text) {
    if ($text >= 1000) {
        $Sourrce_kade = json_decode(file_get_contents("Sourrce_kade/$from_id/$from_id.json"),true);
        $inv = $Sourrce_kade["coin"];
        $newin = $inv - $text;
        $Sourrce_kade["coin"] = "$newin";
        $outjson = json_encode($Sourrce_kade,true);
        file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"✅برداشت شما با موفقیت انجام شد . 
⏱ طی 24 ساعت برداشت شما تکمیل میشود .",
    'parse_mode'=>"MarkDown",
            'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>'• دریافت نیتروسین •'],['text'=>'• دریافت هارپ سین •']],
[['text'=>''],['text'=>'🔐حساب کاربری']],
[['text'=>"💰تعرفه"],['text'=>"♻️ آپدیت ربات"],['text'=>"📜 پیگیری سفارش"]],
[['text'=>'➕ افزایش موجودی'],['text'=>'💸 انتقال سکه']],
[['text'=>"⚖ قوانین"],['text'=>"📞 پشتیبانی"],['text'=>"📚 راهنما"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
]),

]);
bot('sendMessage',[
    'chat_id'=>$admin,
    'text'=>"🖨درخواست برداشت موجودی کاربر 

⛱ ایدی عددی کاربر 
$chat_id 
❗️نوع پرداخت
( هارپ سین ) 

〽️ مقدار سکه درخواستی کاربر 
$text
    ",
    'parse_mode'=>"MarkDown",
            'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>'• دریافت نیتروسین •'],['text'=>'• دریافت هارپ سین •']],
[['text'=>''],['text'=>'🔐حساب کاربری']],
[['text'=>"💰تعرفه"],['text'=>"♻️ آپدیت ربات"],['text'=>"📜 پیگیری سفارش"]],
[['text'=>'➕ افزایش موجودی'],['text'=>'💸 انتقال سکه']],
[['text'=>"⚖ قوانین"],['text'=>"📞 پشتیبانی"],['text'=>"📚 راهنما"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
]),

]);
$Sourrce_kade["step"] = "none";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
 }else{
  SendMessage($chat_id,"حداقل برای برداشت 1000 سکه میباشد ❗️");
 }
 }else{
  SendMessage($chat_id,"❌سکه شما کافی نیست");
 }
    }else{
  SendMessage($chat_id," چی میگی عزیز متوجه نمیشوم😎");
 }
         
     }
elseif($text == "• دریافت نیتروسین •" and $tc == 'private'){
if($coin >= 1000){
$Sourrce_kade["step"] = "bradjskk";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅چه مقدار سکه میخواهید از حساب خود برداشت کنید و ارسال کنید .

💰 حداقل 1000 سکه",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🔙 | بازگشت"]],
],
"resize_keyboard"=>true,
])
]);
}else{
$Sourrce_kade["step"] = "none";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"جهت برداشت باید حداقل 1000 سکه داشته باشید",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🔙 | بازگشت"]],
],
"resize_keyboard"=>true,
])
]);
}}
elseif($step == "bradjskk" and $text != "🔙 | بازگشت" and $tc == 'private'){ 
$Sourrce_kade["step"] = "free";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
if(is_numeric($text)){
         $Sourrce_kade = json_decode(file_get_contents("Sourrce_kade/$from_id/$from_id.json"),true);
        $inv = $Sourrce_kade["coin"];
    if ($inv >= $text) {
    if ($text >= 1000) {
        $Sourrce_kade = json_decode(file_get_contents("Sourrce_kade/$from_id/$from_id.json"),true);
        $inv = $Sourrce_kade["coin"];
        $newin = $inv - $text;
        $Sourrce_kade["coin"] = "$newin";
        $outjson = json_encode($Sourrce_kade,true);
        file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"✅برداشت شما با موفقیت انجام شد . 
⏱ طی 24 ساعت برداشت شما تکمیل میشود .",
    'parse_mode'=>"MarkDown",
            'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>'• دریافت نیتروسین •'],['text'=>'• دریافت هارپ سین •']],
[['text'=>''],['text'=>'🔐حساب کاربری']],
[['text'=>"💰تعرفه"],['text'=>"♻️ آپدیت ربات"],['text'=>"📜 پیگیری سفارش"]],
[['text'=>'➕ افزایش موجودی'],['text'=>'💸 انتقال سکه']],
[['text'=>"⚖ قوانین"],['text'=>"📞 پشتیبانی"],['text'=>"📚 راهنما"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
]),

]);
bot('sendMessage',[
    'chat_id'=>$admin,
    'text'=>"🖨درخواست برداشت موجودی کاربر 

⛱ ایدی عددی کاربر 
$chat_id 
❗️نوع پرداخت
( نیترو سین ) 

〽️ مقدار سکه درخواستی کاربر 
$text
    ",
    'parse_mode'=>"MarkDown",
            'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>'• دریافت نیتروسین •'],['text'=>'• دریافت هارپ سین •']],
[['text'=>''],['text'=>'🔐حساب کاربری']],
[['text'=>"💰تعرفه"],['text'=>"♻️ آپدیت ربات"],['text'=>"📜 پیگیری سفارش"]],
[['text'=>'➕ افزایش موجودی'],['text'=>'💸 انتقال سکه']],
[['text'=>"⚖ قوانین"],['text'=>"📞 پشتیبانی"],['text'=>"📚 راهنما"]],
],
"resize_keyboard"=>true,'one_time_keyboard' => true,
]),

]);
$Sourrce_kade["step"] = "none";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
 }else{
  SendMessage($chat_id,"حداقل برای برداشت 1000 سکه میباشد ❗️");
 }
 }else{
  SendMessage($chat_id,"❌سکه شما کافی نیست");
 }
    }else{
  SendMessage($chat_id," چی میگی عزیز متوجه نمیشوم😎");
 }
         
     }
elseif($text == "🎁 | امتیاز روزانه" and $tc == 'private'){
$lasttime = file_get_contents("Sourrce_kade/$from_id/time.txt");
if($date == $lasttime){
$lasttime = file_get_contents("Sourrce_kade/$from_id/time.txt");
SendMessage($chat_id,"🌹 | شما قبلا امتیاز روزانه خود را دریافت کرده اید");
}else{
$Sourrce_kade["step"] = "free";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
$Sourrce_kade = json_decode(file_get_contents("Sourrce_kade/$from_id/$from_id.json"),true);
$mdaily = "2";
$inv = $Sourrce_kade["coin"];
$newin = $inv + $mdaily;
$Sourrce_kade["coin"] = "$newin";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
file_put_contents("Sourrce_kade/$from_id/time.txt",$date);
SendMessage($chat_id,"🤑 | تبریک شما $mdaily سکه هدیه روزانه دریافت کردید");
}}
if($text == "📚 راهنما" and $tc == 'private'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔹آموزشات بانک نیتروسین🔹
‌
زيرمجموعه گیری➕
‌
🆎 چطور زيرمجموعه جمع کنم؟

🆎 شما میتونید با دکمه ➕افزایش موجودی لینک زيرمجموعه گیری خود را بگیرید و به دوستان خود لینک زيرمجموعه گیری را ارسال و ، وقتی کسی با لینک زيرمجموعه گیری شما وارد ربات شد به شما یک زيرمجموعه میده.

دریافت نیتروسین 💵

🏧 چطور نیترو سین ، هارپ سین بگیرم؟

🏧 شما فقط در صورتی میتونید نیتروسین یا هارپ سین دریافت کنید که زيرمجموعه های شما فیک نباشد و تعداد سکه های شما جهت برداشت کافی باشد.

واریزات بانک نیتروسین🔹

✳️ چرا سفارش را ثبت کردم ولی بهم سفارشی که خواستم را هنوز نداده؟

✳️ در صورتی به شما نیترو سین ، هارپ سین ، داده میشود که شما ربات های نیترو سین و هارپ سین را استارت کرده باشید ، بخاطر حجم های زیاد دیر هدایا واریز میشود.",
]); 
}
if($text == "⚖ قوانین" and $tc == 'private'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
⚖کاربری گرامی، چنانچه شما از ربات بانک نیتروسین استفاده نمایید به منزله قبول قوانین زیر است ؛

👈هنگام سفارش از شماره کاربری خود اطمینان حاصل فرمایید 《 چون اگه اشتباهی وارد کنید به کسی دیگری واریز میشود 》 و بانک نیتروسین هیچ گونه قبالی در این مورد ندارد .
👈خرید و فروش موجودی ربات توسط کاربران ممنوعیتی ندارد اما ما هیچ گونه تعهدی در این رابطه نداریم
👈وقتی سکه دارید و می مخواهید ثبت سفارش کنید و تا اخرین مرحله میروید بعد سفارش خود را لغو می کنید سکه شما هدر میشود پس دقت فرمایید.
👈گرفتن‌ زیر مجموعه فیک ممنوع میباشد.
👈بعد سفارش اگه مشکلی در سفارش پیش آمد واریز نشد یا اگر ربات مشکلی داشت به قسمت پیگیری سفارش رفته و کد پیگیری را در آن قسمت وارد کنید.
👈در صورت استفاده نادرست از بخش های زیر مجموعه گیری و... حساب شخص مسدود خواهد شد.

📣 - @BANK1_NITROSEEN
🤖 - @BANK_2NITR0SEENBOT",
]); 
}
if($text == "🔐حساب کاربری" and $tc == 'private'){
$Sourrce_kade["step"] = "free";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🆔 | آیدی شما : $from_id 
💎 | یوزرنیم شما : @$username
💰 | سکه های شما : $coin
♻️ | زیرمجموعه های شما : $inv
❇️ | شماره تلفن شما : $phone

⏰ | $time - $date
",
]);
}
elseif($text == "♻️ آپدیت"){
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'message_id'=>$message_id + 1,
 'text'=>'درحال دریافت اطلاعات از سرور | 📁'
 ]);
sleep(3);
 bot('EditMessageText',[
 'chat_id'=>$chat_id,
 'message_id'=>$message_id + 1,
 'text'=>'استخراج اطلاعات دریافتی | ⚠️'
 ]);
sleep(0.1);
 bot('EditMessageText',[
 'chat_id'=>$chat_id,
 'message_id'=>$message_id + 1,
 'text'=>'▬▭▭▭▭▭▭▭ | 13%'
 ]);
 sleep(0.1);
 bot('EditMessageText',[
 'chat_id'=>$chat_id,
 'message_id'=>$message_id + 1,
 'text'=>'▬▬▭▭▭▭▭▭ | 26%'
 ]);
 sleep(0.1);
 bot('EditMessageText',[
 'chat_id'=>$chat_id,
 'message_id'=>$message_id + 1,
 'text'=>'▬▬▬▭▭▭▭▭ | 39%'
 ]);
 sleep(0.1);
 bot('EditMessageText',[
 'chat_id'=>$chat_id,
 'message_id'=>$message_id + 1,
 'text'=>'▬▬▬▬▭▭▭▭ | 42%'
 ]);
 sleep(0.1);
 bot('EditMessageText',[
 'chat_id'=>$chat_id,
 'message_id'=>$message_id + 1,
 'text'=>'▬▬▬▬▬▭▭▭ | 55%'
 ]);
 sleep(0.1);
 bot('EditMessageText',[
 'chat_id'=>$chat_id,
 'message_id'=>$message_id + 1,
 'text'=>'▬▬▬▬▬▬▭▭ | 68%'
 ]);
 sleep(0.1);
 bot('EditMessageText',[
 'chat_id'=>$chat_id,
 'message_id'=>$message_id + 1,
 'text'=>'▬▬▬▬▬▬▬▬ | 100%'
 ]);
 sleep(0.1);
 bot('EditMessageText',[
 'chat_id'=>$chat_id,
 'message_id'=>$message_id + 1,
 'text'=>'ربات با موفقیت بروزرسانی شد | ✅'
  ]);
}
if($text == "🗣 دعوت دیگران" and $tc == 'private'){
$Sourrce_kade["step"] = "free";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
$caption = "
👁‍🗨 رباتی برای افزایش نیتروسین و هارپ سین 
❤️ با اوردن زیر مجموعه نیتروسین جمع کنید
📟 پرداخت نیتروسین در کمترین زمان ممکن
👥 زیرمجموعه گیری کنید نیتروسین و هارپ سین خود را افزایش دهید
🔐 معتبر و قابل اعتماد
📎https://t.me/none?start=$from_id

👆🏻 بنر بالا حاوی لینک دعوت شما به ربات است
 
🎁 با دعوت دوستان به ربات با لینک اختصاصی خود میتوانید به ازای هر نفر 1 امتیاز موجودی دریافت کنید
☑️ پس با زیرمجموعه گیری به راحتی میتوانید موجودی حساب خود را رایگان! افزایش دهید .

#نکته: حتما باید زیر مجموعه شما در کانال های جوین اجباری عضو شود تا امتیاز به شما تعلق بگیرد.
";
       bot('sendphoto',[
 'chat_id'=>$chat_id,
'photo'=>'https://t.me/slokings/7865',
 'caption'=>$caption
 ]);
}
elseif($text == "📞 پشتیبانی" and $tc == 'private'){	
$Sourrce_kade["step"] = "Qkslcls";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"🆘 مشکل ، انتقاد ، پیشنهاد خود را ارسال کنید",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🔙 | بازگشت"]],
],
"resize_keyboard"=>true,
])
]);
}
if($step == "Qkslcls" && $text != "🔙 | بازگشت"){ 
$Sourrce_kade["step"] = "none";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('ForwardMessage',[
'chat_id'=>$admin,
'from_chat_id'=>$chat_id,
'message_id'=>$message_id
]); 
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"یک پیام از سوی کاربر
ایدی عددی فرد : `$chat_id`

جهت پاسخ به کاربر دستور ( /javab ) را ارسال کنید",
'parse_mode'=>"Markdown",
]);
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"پیام شما دریافت شد و بعد از پیگیری تیم پشتیبانی نتیجه از همین طریق به شما اعلام میگردد✅",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>'• دریافت نیتروسین •'],['text'=>'• دریافت هارپ سین •']],
[['text'=>''],['text'=>'🔐حساب کاربری']],
[['text'=>"💰تعرفه"],['text'=>"♻️ آپدیت ربات"],['text'=>"📜 پیگیری سفارش"]],
[['text'=>'➕ افزایش موجودی'],['text'=>'💸 انتقال سکه']],
[['text'=>"⚖ قوانین"],['text'=>"📞 پشتیبانی"],['text'=>"📚 راهنما"]],
],
"resize_keyboard"=>true,
])
]);
}
if($text == "سلام" and $tc == 'private'){
bot('sendMessage',[
'chat_id' =>$from_id,
'text'=>"
✅
",
'parse_mode'=>'MarkDown',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"𝑛𝑜𝑛𝑒",'callback_data'=>'grup']],
  ]])
]);
}
elseif($data == "grup"){
    bot('answerCallbackQuery',[
		'callback_query_id'=>$update->callback_query->id,
		'text'=>"لطفاً از بخش فروشگاه و یا زیرمجموعه گیری موجودی خود را افزایش دهید✅️",
		'show_alert'=>true
			]);
}
if($text == "〽️ | گفتگو" and $tc == 'private'){
$Sourrce_kade["step"] = "free";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📩 جهت ورود گروه گفتگو رباتساز کیا لطفا به چند نکته توجه کنید :

1️⃣⁩ - در گروه ارسال فیلم یا عکس یا استیکر و گیف مجاز نیست.

⁦2️⃣⁩ - در گروه ارسال کلمات رکیک مجاز نیست و درصورت مشاهده فرد در کمترین زمان از ربات و گروه مسدود میشود.

⁦3️⃣⁩ - اسپم در گپ و خراب کردن نظم چت موجب بلاکی شما در ربات و گروه میباشد.

⁦👇🏻⁩ درصورت قبول قوانین بر روی 📩 ورود به گروه گفتگو کلیک کنید و سپس بر روی پیوستن یا Join کلیک کنید.⁦
",
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text' => "📩 ورود به گروه گفتگو", 'url' => "https://Telegram.me/Kia_Make_Gp"]],
              ]
        ])
]); 
}
//====[ADMIN]====//
elseif($text == "امار کاربران" and $tc == 'private'){
if ($chat_id == $admin) {
$alluser = file_get_contents("Sourrce_kade/abolfazli.txt");
$alaki = explode("\n",$alluser);
$allusers = count($alaki) - 2;
$memm = bot('getChatMembersCount',['chat_id'=>'@'.Sourrce_kade])->result;
$apisite = json_decode(file_get_contents("https://user.panelbaz.ir/api/v1?key=NhZ5lFY5g16NpPkQOwUO3qD2N0Xpr71N&action=balance"), true);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
📈 وضعیت ربات به شرح زیر میباشد :
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
[['text'=>"$allusers",'callback_data'=>'join'],['text'=>'آمار ربات 📊','callback_data'=>'join']],
[['text'=>"$memm",'callback_data'=>'join'],['text'=>'آمار کانال 📉','callback_data'=>'join']],
]
])
]);
}
}
elseif($text == "ساخت کد هدیه" and $tc == 'private'){	
if ($chat_id == $admin) {
$Sourrce_kade["step"] = "getid2gg";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"کد هدیه جدید را ارسال نمایید",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"/admin"]],
],
"resize_keyboard"=>true,
])
]); 
}}
elseif($step == "getid2gg" and $text != "/admin" and $tc == 'private'){ 
if ($chat_id == $admin) {
$Sourrce_kade["step"] = "sendcoin2gg";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
file_put_contents("newgiftm.txt",$text);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"این کد شامل چند سکه باشد؟",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"/admin"]],
],
"resize_keyboard"=>true,
])
]); 
}}
elseif($step == "sendcoin2gg" and $text != "/admin" and $tc == 'private'){ 
if ($chat_id == $admin) {
if(is_numeric($text)){
$Sourrce_kade["step"] = "free";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
$newgiftm = file_get_contents("newgiftm.txt");
file_put_contents("Sourrce_kade/codes/$newgiftm.txt",$text);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"کد *$newgiftm* به ارزش *$text* سکه با موفقیت ساخته شد",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"امار کاربران"]],
[['text'=>"پیام همگانی"],['text'=>"فور همگانی"]],
[['text'=>"امتیاز دادن"]],
[['text'=>"ان بلاک کردن"],['text'=>"بلاک کردن"]],
[['text'=>"/start"],['text'=>"ساخت کد هدیه"]],
],
"resize_keyboard"=>true,
])
]); 
}else{
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا عدد ارسال کنید!",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"/admin"]],
],
"resize_keyboard"=>true,
])
]); 
}}}
if($text == "/admin" and $tc == 'private'){
$Sourrce_kade["step"] = "free";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👈🏻⁩ به منوی مديريت خوش امدید
",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"امار کاربران"]],
[['text'=>"پیام همگانی"],['text'=>"فور همگانی"]],
[['text'=>"امتیاز دادن"]],
[['text'=>"ان بلاک کردن"],['text'=>"بلاک کردن"]],
[['text'=>"/start"],['text'=>"ساخت کد هدیه"]],
],
"resize_keyboard"=>true,
])
]); 
}
elseif($text == "امتیاز دادن" and $tc == 'private'){	
if ($chat_id == $admin) {
$Sourrce_kade["step"] = "dnclepsnc";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"آیدی عددی فرد را ارسال کنید!",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"/admin"]],
],
"resize_keyboard"=>true,
])
    ]);
}}
elseif($step == "dnclepsnc" and $text != "/admin" and $tc == 'private'){ 
if ($chat_id == $admin) {
$Sourrce_kade["step"] = "xkdkxld";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
file_put_contents("Sourrce_kade/id.txt",$text);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"چند سکه به کاربر بدم؟!",
    ]);
}}
elseif($step == "xkdkxld" and $text != "/admin" and $tc == 'private'){ 
if ($chat_id == $admin) {
if(is_numeric($text)){
$Sourrce_kade["step"] = "free";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
$id = file_get_contents("Sourrce_kade/id.txt");
$Sourrce_kade = json_decode(file_get_contents("Sourrce_kade/$id/$id.json"),true);
$coinsj = $Sourrce_kade["coin"];
$newin =  $coinsj + $text;
$Sourrce_kade["coin"] = "$newin";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$id/$id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$id,
'text'=>"از طرف مدیریت از شما *$text* سکه اضافه گردید!",
'parse_mode'=>"MarkDown",
]); 
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"*$text* سکه از *$id* اضافه گردید",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"امار کاربران"]],
[['text'=>"پیام همگانی"],['text'=>"فور همگانی"]],
[['text'=>"امتیاز دادن"]],
[['text'=>"ان بلاک کردن"],['text'=>"بلاک کردن"]],
[['text'=>"/start"],['text'=>"ساخت کد هدیه"]],
],
"resize_keyboard"=>true,
])
    ]);
}else{
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا عدد ارسال کنید!",
'parse_mode'=>"MarkDown",
    ]);
}}}
elseif($text == "بلاک کردن" and $tc == 'private'){	
if ($chat_id == $admin) {
$Sourrce_kade["step"] = "dndodockd";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"آیدی عددی فرد را ارسال کنید!",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"/admin"]],
],
"resize_keyboard"=>true,
])
    ]);
}}
elseif($step == "dndodockd" and $text != "/admin" and $tc == 'private'){ 
if ($chat_id == $admin) {
if(is_numeric($text)){
$Sourrce_kade["step"] = "free";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
$id = file_get_contents("Sourrce_kade/id.txt");
$Sourrce_kade = json_decode(file_get_contents("Sourrce_kade/$id/$id.json"),true);
$Sourrce_kade["warn"] = "4";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$id/$id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"مسدود شد",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"امار کاربران"]],
[['text'=>"پیام همگانی"],['text'=>"فور همگانی"]],
[['text'=>"امتیاز دادن"]],
[['text'=>"ان بلاک کردن"],['text'=>"بلاک کردن"]],
[['text'=>"/start"],['text'=>"ساخت کد هدیه"]],
],
"resize_keyboard"=>true,
])
    ]);
}else{
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا عدد ارسال کنید!",
'parse_mode'=>"MarkDown",
    ]);
}}}
elseif($text == "ان بلاک کردن" and $tc == 'private'){	
if ($chat_id == $admin) {
$Sourrce_kade["step"] = "dndjdoekcmsm";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"آیدی عددی فرد را ارسال کنید!",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"/admin"]],
],
"resize_keyboard"=>true,
])
    ]);
}}
elseif($step == "dndjdoekcmsm" and $text != "/admin" and $tc == 'private'){ 
if ($chat_id == $admin) {
if(is_numeric($text)){
$Sourrce_kade["step"] = "free";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
$id = file_get_contents("Sourrce_kade/id.txt");
$Sourrce_kade = json_decode(file_get_contents("Sourrce_kade/$id/$id.json"),true);
$Sourrce_kade["warn"] = "0";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$id/$id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"رفع مسدود شد",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"امار کاربران"]],
[['text'=>"پیام همگانی"],['text'=>"فور همگانی"]],
[['text'=>"امتیاز دادن"]],
[['text'=>"ان بلاک کردن"],['text'=>"بلاک کردن"]],
[['text'=>"/start"],['text'=>"ساخت کد هدیه"]],
],
"resize_keyboard"=>true,
])
    ]);
}else{
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا عدد ارسال کنید!",
'parse_mode'=>"MarkDown",
    ]);
}}}
elseif($text == "پیام همگانی" and $tc == 'private'){	
if ($chat_id == $admin) {
$Sourrce_kade["step"] = "snxpwkxpwb";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"پیام خود رو بفرست",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"/admin"]],
],
"resize_keyboard"=>true,
])
    ]);
}}
elseif($step == "snxpwkxpwb" and $text != "/admin" and $tc == 'private'){ 
if ($chat_id == $admin) {
$Sourrce_kade["step"] = "free";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
$all_member = fopen( "Sourrce_kade/abolfazli.txt", 'r');
while( !feof( $all_member)) {
$user = fgets( $all_member);
bot('sendMessage',[
'chat_id'=>$user,
'text'=>$text,
'parse_mode'=>"MarkDown",
]);
}
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"پیام به همه ارسال شد",
'parse_mode'=>"MarkDown",
    ]);
}}
elseif($text == "فور همگانی" and $tc == 'private'){
if ($chat_id == $admin) {
$Sourrce_kade["step"] = "smdpwms";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"پیام خودت رو فور بده اینجا",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"/admin"]],
],
"resize_keyboard"=>true,
])
    ]);
}}
elseif($text != "/admin" and $step == "smdpwms" and $tc == 'private'){
if ($chat_id == $admin) {
$Sourrce_kade["step"] = "free";
$outjson = json_encode($Sourrce_kade,true);
file_put_contents("Sourrce_kade/$from_id/$from_id.json",$outjson);
$all_member = fopen( "Sourrce_kade/abolfazli.txt", 'r');
while( !feof( $all_member)) {
$user = fgets( $all_member);
bot('ForwardMessage',[
'chat_id'=>$user,
'from_chat_id'=>$chat_id,
'message_id'=>$message_id
]);
}    
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"فروارد همگانی به همه اعضای ربات فروارد شد",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$message_id,
    ]);
}}
if(file_exists(error_log))
	unlink(error_log);
?>
