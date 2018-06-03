<?php
ob_start();
define('token','[*[*TOKEN*]*]');
function Naweed($method,$datas=[]){
    $url = "https://api.telegram.org/bot".token."/".$method;
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
$json = file_get_contents('php://input');
$telegram = urldecode ($json);
$results = json_decode($telegram);

include_once('jdf.php');
date_default_timezone_set("Asia/Tehran");


$update_id = $results->update_id;
$username = $results->message->from->username;
$from_id = $results->message->from->id;
$chat_id = $results->message->chat->id;
$is_bot = $results->message->from->is_bot;
$message_id = $results->message->message_id;
$textmessage = $results->message->text;
$admin = '[*[*ADMIN*]*]';
$chat_type = $results->message->chat->type;
$admin2 = array (000000,[*[*ADMIN*]*],88800000,0000000,00000000);

$channel_user = 'testnbr';
$forward_from_message_id = $results->message->forward_from_message_id;
$data = $results->callback_query->data;
$channel_post = $results->channel_post;
$ch_txt = $results->channel_post->text;


$ch_msg_id = $results->channel_post->message_id;
$first_name = $results->message->from->first_name;
$last_name = $results->message->from->last_name;
$from_id2 = $results->callback_query->from->id;
$chat_id2 = $results->callback_query->message->chat->id;
$message_id2 = $results->callback_query->message->message_id;
$username2 = $results->callback_query->from->username;
$callback_query_id = $results->callback_query->id;

$from_reply_id = $results->message->reply_to_message->from->id;
$from_reply_firstname = $results->message->reply_to_message->from->first_name;
$from_reply_lastname = $results->message->reply_to_message->from->last_name;


$sticker = $results->message->sticker;
$sticker_id = $results->message->sticker->file_id;

$photo = $results->message->photo;
$phone_number = $results->message->contact->phone_number;
$audio = $results->message->audio;
$document = $results->message->document;
$video = $results->message->video;
$voice = $results->message->voice;
$video_note = $results->message->video_note;
$location = $results->message->location;
$gif_id = $results->message->document->file_id;

$caption = $results->message->caption;

$forward_from_id = $results->message->forward_from->id;
$first_name_fwd = $results->message->forward_from->first_name;
$last_name_fwd = $results->message->forward_from->last_name;
$from_chat_id = $results->message->forward_from_chat->id;
$is_bot_fwd = $results->message->forward_from->is_bot;
$chat_type_fwd = $results->message->forward_from_chat->type;
$fwd_date = $results->message->forward_date;

$is_bot_add = $results->message->new_chat_participant->is_bot;
$user_id_add = $results->message->new_chat_participant->id;
// inline,,,,,,,,,,,,,,,,,,,,,,,,,,,,,
$inline_query_id = $results->inline_query->id;
$query = $results->inline_query->query;
$query_from_id = $results->inline_query->from->id;




function SendMessage($chat_id,$text){
Naweed('sendMessage',[
'chat_id'=>$chat_id,
'text'=>$text,
'parse_mode'=>'MarkDown']);
}


function sendAction($chat_id, $action){
Naweed('sendChataction',[
'chat_id'=>$chat_id,
'action'=>$action]);
};

function sendPhoto ($chat_id,$photo){
	Naweed('sendPhoto',[
	'chat_id'=>$chat_id,
	'photo'=>$photo,
	'caption'=>"hi"]);
}



function forwardMessage ($chat_id,$from_chat_id,$message_id){
	Naweed('forwardMessage',[
'chat_id'=>$chat_id,
'from_chat_id'=>$from_chat_id,
'message_id'=>$message_id]);
}

function setChatTitle ($title){
	Naweed('setChatTitle',[
'chat_id'=>'',
'title'=>$title]);
}



function save($filename,$TXTdata){
	$myfile = fopen($filename, "w") or die("Unable to open file!");
	fwrite($myfile, "$TXTdata");
	fclose($myfile);
	}



function getUserProfilePhotos ($user_id,$offset) {
	$url = 'https://api.telegram.org/bot'.token.'/getUserProfilePhotos?user_id='.$user_id.'&offset='.$offset.'&limit=5';
	$update = file_get_contents($url);
	return $update;

	

}	

function getUserProfilePhotos2 ($user_id) {
	$url = 'https://api.telegram.org/bot'.token.'/getUserProfilePhotos?user_id='.$user_id;
	$update = file_get_contents($url);
	return $update;
}

function download_file_toserver ($fileurl,$name) {
	file_put_contents($name, fopen($fileurl, 'r'));
}	



function getfile ($file_id) {
	$url = 'https://api.telegram.org/bot'.token.'/getFile?file_id='.$file_id;
	$updates = file_get_contents($url);
	$update = urldecode ($updates);
	$update = json_decode ($update);
	$result = $update->result;
	$filepath = $result->file_path;
	return $filepath;
}

function Delfile ($fName){
	$filehh = fopen($fName, "w")or die("Unable to open file!");
	fclose ($filehh);
	unlink ($fName);
}



function deletefolder($path) { 
     if ($handle=opendir($path)) { 
       while (false!==($file=readdir($handle))) { 
         if ($file<>"." AND $file<>"..") { 
           if (is_file($path.'/'.$file))  { 
             @unlink($path.'/'.$file); 
             } 
           if (is_dir($path.'/'.$file)) { 
             deletefolder($path.'/'.$file); 
             @rmdir($path.'/'.$file); 
            } 
          } 
        } 
      } 
 }
 

function kickChatMember ($chat_id,$user_id){
Naweed ('kickChatMember',[
'chat_id'=>$chat_id,
'user_id'=>$user_id
]);
}

function deleteMessage ($chat_id,$message_id){
Naweed ('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id
]);
}

function unbanChatMember ($chat_id,$user_id){
Naweed ('unbanChatMember',[
'chat_id'=>$chat_id,
'user_id'=>$user_id
]);
}

function pinChatMessage ($chat_id,$message_id){
Naweed ('pinChatMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id
]);
}
function unpinChatMessage ($chat_id){
Naweed ('unbanChatMember',[
'chat_id'=>$chat_id
]);
}
function getChatAdministrators ($chat_id){
Naweed ('getChatAdministrators',[
'chat_id'=>$chat_id
]);
}
$command = file_get_contents ('command.txt');
$time = file_get_contents ('time.txt');
$channelid = file_get_contents('channelid.txt');





if ($textmessage == '/start' or $textmessage == 'برگشت به منو اصلی'){
	if (in_array($from_id,$admin2)){
	file_put_contents('command.txt',"none");
	sendAction($chat_id,'typing');
	Naweed('sendMessage',[
		'chat_id'=>$from_id,
		'text'=>'به پنل مدیریت خوش آمدید',
		'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
	[['text'=>'تنظیم فاصله زمانی ارسال🕒'],['text'=>'تنظیم متن بنر ها📝']],
		[['text'=>'پیام همگانی 🔉'],['text'=>'فوروارد همگانی 🔉'],['text'=>'تنظیم چنل فوروارد']],
		[['text'=>'راهنما📖'],['text'=>'آمار ربات 📊']]
		]
		])
		]);
}
}
if ($textmessage == 'تنظیم فاصله زمانی ارسال🕒' and in_array($from_id,$admin2)){
	file_put_contents ('command.txt','settime');
	sendAction ($from_id,'typing');
	Naweed('sendMessage',[
		'chat_id'=>$from_id,
		'text'=>'فاصله را بر حسب دقیقه به عدد به انگلیسی وارد کنید.',
		'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'برگشت به منو اصلی']],
		]
		])
		]);
}elseif ($textmessage == 'پیام همگانی 🔉' and in_array($from_id,$admin2)){
	file_put_contents ('command.txt','pmall');
	sendAction ($from_id,'typing');
	sendMessage ($from_id,'پیام مورد نظررا بفرستید.');
}elseif ($textmessage == 'فوروارد همگانی 🔉' and in_array($from_id,$admin2)){
	file_put_contents ('command.txt','s2a');
	sendAction ($from_id,'typing');
	sendMessage ($from_id,'پیام مورد نظر را فوروارد کنید.');
}elseif ($textmessage == 'تنظیم متن بنر ها📝' and in_array($from_id,$admin2)){
	sendAction ($from_id,'typing');
	Naweed('sendMessage',[
		'chat_id'=>$from_id,
		'text'=>"شماره بنر را برای تنظیم انتخاب کنید.",
		'reply_markup'=>json_encode([
		'inline_keyboard'=>[
		[['text'=>'1','callback_data'=>'1'],['text'=>'2','callback_data'=>'2'],['text'=>'3','callback_data'=>'3']],
		[['text'=>'4','callback_data'=>'4'],['text'=>'5','callback_data'=>'5'],['text'=>'6','callback_data'=>'6']],
		[['text'=>'7','callback_data'=>'7'],['text'=>'8','callback_data'=>'8'],['text'=>'9','callback_data'=>'9']],
		[['text'=>'10','callback_data'=>'10'],['text'=>'برگشت','callback_data'=>'back']]
		]
		])
		]);
}elseif ($textmessage == 'تنظیم چنل فوروارد' and in_array($from_id,$admin2)){
	file_put_contents ('command.txt','setchannelid');
	sendAction ($from_id,'typing');
 Naweed ('sendMessage',[
	'chat_id'=>$from_id,
	'text'=>'ایدی عددی چنل خود برای فوروارد را بفرستید
می توانید ایدی را از ربات @ChannelIdBot به دست آورید',
	'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'برگشت به منو اصلی']],
		]
		])
		]);
}elseif ($textmessage == 'راهنما📖' and in_array($from_id,$admin2)){
	sendAction ($from_id,'typing');
 Naweed ('sendMessage',[
	'chat_id'=>$from_id,
	'text'=>'با سلام
5 بنر اول فوروارد می شوند و
5 بنر دوم تنها ارسال می شوند.🙂
حتما ربات باید ادمین چنل فوروارد باشد.',
	'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'برگشت به منو اصلی']],
		]
		])
		]);
}
if ($command == 'settime' and in_array($from_id,$admin2) and $textmessage != 'برگشت به منو اصلی'){
  file_put_contents('time.txt',$textmessage);
  file_put_contents('command.txt',"none");
  sendAction ($from_id,'typing');
  Naweed ('sendMessage',[
	'chat_id'=>$from_id,
	'text'=>"فاصله ی زمانی روی $textmessage دقیقه تنظیم شد.",
	'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'برگشت به منو اصلی']],
		]
		])
		]);
}elseif ($command == 'setchannelid' and in_array($from_id,$admin2)){
  file_put_contents('channelid.txt',$textmessage);
  file_put_contents('command.txt',"none");
  sendAction ($from_id,'typing');
  Naweed ('sendMessage',[
	'chat_id'=>$from_id,
	'text'=>"ایدی کانال فوروارد ثبت شد",
	'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'برگشت به منو اصلی']],
		]
		])
		]);
}

if ($data == 'back'){
	Naweed('sendMessage',[
		'chat_id'=>$from_id2,
		'text'=>'به پنل مدیریت خوش آمدید',
		'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'تنظیم فاصله زمانی ارسال🕒'],['text'=>'تنظیم متن بنر ها📝']],
		[['text'=>'پیام همگانی 🔉'],['text'=>'فوروارد همگانی 🔉'],['text'=>'تنظیم چنل فوروارد']],
		[['text'=>'راهنما📖'],['text'=>'آمار ربات 📊']]
		]
		])
		]);
}


if ($data == '1' and in_array($from_id2,$admin2)){
	mkdir ('banner');
	mkdir ('banner/1');
	file_put_contents ('command.txt','b1');
	sendAction ($from_id2,'typing');
	  Naweed ('sendMessage',[
	'chat_id'=>$from_id2,
	'text'=>'بنر یک را فوروارد کنید',
	'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'برگشت به منو اصلی']],
		]
		])
		]);
}elseif ($data == '2' and in_array($from_id2,$admin2)){
	mkdir ('banner');
	mkdir ('banner/2');
	file_put_contents ('command.txt','b2');
	sendAction ($from_id2,'typing');
	 Naweed ('sendMessage',[
	'chat_id'=>$from_id2,
	'text'=>'بنر دو را فوروارد کنید.',
	'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'برگشت به منو اصلی']],
		]
		])
		]);
}elseif ($data == '3' and in_array($from_id2,$admin2)){
	mkdir ('banner');
	mkdir ('banner/3');
	file_put_contents ('command.txt','b3');
	sendAction ($from_id2,'typing');
	Naweed ('sendMessage',[
	'chat_id'=>$from_id2,
	'text'=>'بنر سه را فوروارد کنید.',
	'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'برگشت به منو اصلی']],
		]
		])
		]);
}elseif ($data == '4' and in_array($from_id2,$admin2)){
	mkdir ('banner');
	mkdir ('banner/4');
	file_put_contents ('command.txt','b4');
	sendAction ($from_id2,'typing');
	Naweed ('sendMessage',[
	'chat_id'=>$from_id2,
	'text'=>'بنر چهار را فوروارد کنید.',
	'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'برگشت به منو اصلی']],
		]
		])
		]);
}elseif ($data == '5' and in_array($from_id2,$admin2)){
	mkdir ('banner');
	mkdir ('banner/5');
	file_put_contents ('command.txt','b5');
	sendAction ($from_id2,'typing');
	Naweed ('sendMessage',[
	'chat_id'=>$from_id2,
	'text'=>'بنر پنج را فوروارد کنید.',
	'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'برگشت به منو اصلی']],
		]
		])
		]);
}elseif ($data == '6' and in_array($from_id2,$admin2)){
	mkdir ('banner');
	mkdir ('banner/6');
	file_put_contents ('command.txt','b6');
	sendAction ($from_id2,'typing');
	Naweed ('sendMessage',[
	'chat_id'=>$from_id2,
	'text'=>'متن بنر شش را بفرستید',
	'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'برگشت به منو اصلی']],
		]
		])
		]);
}elseif ($data == '7' and in_array($from_id2,$admin2)){
	mkdir ('banner');
	mkdir ('banner/7');
	file_put_contents ('command.txt','b7');
	sendAction ($from_id2,'typing');
	Naweed ('sendMessage',[
	'chat_id'=>$from_id2,
	'text'=>'متن بنر هفت را بفرستید.',
	'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'برگشت به منو اصلی']],
		]
		])
		]);
}elseif ($data == '8' and in_array($from_id2,$admin2)){
	mkdir ('banner');
	mkdir ('banner/8');
	file_put_contents ('command.txt','b8');
	sendAction ($from_id2,'typing');
	Naweed ('sendMessage',[
	'chat_id'=>$from_id2,
	'text'=>'متن بنر هشت را بفرستید.',
	'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'برگشت به منو اصلی']],
		]
		])
		]);
}elseif ($data == '9' and in_array($from_id2,$admin2)){
	mkdir ('banner');
	mkdir ('banner/9');
	file_put_contents ('command.txt','b9');
	sendAction ($from_id2,'typing');
	Naweed ('sendMessage',[
	'chat_id'=>$from_id2,
	'text'=>'متن بنر نه را بفرستید.',
	'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'برگشت به منو اصلی']],
		]
		])
		]);
}elseif ($data == '10' and in_array($from_id2,$admin2)){
	mkdir ('banner');
	mkdir ('banner/10');
	file_put_contents ('command.txt','b10');
	sendAction ($from_id2,'typing');
	Naweed ('sendMessage',[
	'chat_id'=>$from_id2,
	'text'=>'متن بنر ده را بفرستید.',
	'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'برگشت به منو اصلی']],
		]
		])
		]);
}
if ($command == 'b1' and in_array($from_id,$admin2) and isset($fwd_date) and $textmessage != 'برگشت به منو اصلی'){
	$msgid = json_decode(file_get_contents('https://api.telegram.org/bot'.token.'/forwardMessage?&chat_id='.$channelid.'&from_chat_id='.$from_id.'&disable_notification=true&message_id='.$message_id));
	$msg_id = $msgid->result->message_id;
	 file_put_contents('command.txt',"none");
	file_put_contents ('banner/1/msgid.txt',$msg_id);
	 sendAction ($from_id,'typing');
	sendMessage ($from_id,'ثبت شد.');
}elseif ($command == 'b2' and in_array($from_id,$admin2) and isset($fwd_date) and $textmessage != 'برگشت به منو اصلی'){
	$msgid = json_decode(file_get_contents('https://api.telegram.org/bot'.token.'/forwardMessage?&chat_id='.$channelid.'&from_chat_id='.$from_id.'&disable_notification=true&message_id='.$message_id));
	$msg_id = $msgid->result->message_id;
	  file_put_contents('command.txt',"none");
	file_put_contents ('banner/2/msgid.txt',$msg_id);
	 sendAction ($from_id,'typing');
	sendMessage ($from_id,'ثبت شد.');
}elseif ($command == 'b3' and in_array($from_id,$admin2) and isset($fwd_date) and $textmessage != 'برگشت به منو اصلی'){
	$msgid = json_decode(file_get_contents('https://api.telegram.org/bot'.token.'/forwardMessage?&chat_id='.$channelid.'&from_chat_id='.$from_id.'&disable_notification=true&message_id='.$message_id));
	$msg_id = $msgid->result->message_id;
	  file_put_contents('command.txt',"none");
	file_put_contents ('banner/3/msgid.txt',$msg_id);
	 sendAction ($from_id,'typing');
	sendMessage ($from_id,'ثبت شد.');
}elseif ($command == 'b4' and in_array($from_id,$admin2) and isset($fwd_date) and $textmessage != 'برگشت به منو اصلی'){
	$msgid = json_decode(file_get_contents('https://api.telegram.org/bot'.token.'/forwardMessage?&chat_id='.$channelid.'&from_chat_id='.$from_id.'&disable_notification=true&message_id='.$message_id));
	$msg_id = $msgid->result->message_id;
	  file_put_contents('command.txt',"none");
	file_put_contents ('banner/4/msgid.txt',$msg_id);
	 sendAction ($from_id,'typing');
	sendMessage ($from_id,'ثبت شد.');
}elseif ($command == 'b5' and in_array($from_id,$admin2) and isset($fwd_date) and $textmessage != 'برگشت به منو اصلی'){
	$msgid = json_decode(file_get_contents('https://api.telegram.org/bot'.token.'/forwardMessage?&chat_id='.$channelid.'&from_chat_id='.$from_id.'&disable_notification=true&message_id='.$message_id));
	$msg_id = $msgid->result->message_id;
	file_put_contents('command.txt',"none");
	file_put_contents ('banner/5/msgid.txt',$msg_id);
	 sendAction ($from_id,'typing');
	sendMessage ($from_id,'ثبت شد.');
}elseif ($command == 'b6' and in_array($from_id,$admin2)){
	file_put_contents('command.txt',"none");
	file_put_contents ('banner/6/txt.txt',$textmessage);
	 sendAction ($from_id,'typing');
	sendMessage ($from_id,'ثبت شد.');
}elseif ($command == 'b7' and in_array($from_id,$admin2)){
	file_put_contents('command.txt',"none");
	file_put_contents ('banner/7/txt.txt',$textmessage);
	 sendAction ($from_id,'typing');
	sendMessage ($from_id,'ثبت شد.');
}elseif ($command == 'b8' and in_array($from_id,$admin2)){
	file_put_contents('command.txt',"none");
	file_put_contents ('banner/8/txt.txt',$textmessage);
	 sendAction ($from_id,'typing');
	sendMessage ($from_id,'ثبت شد.');
}elseif ($command == 'b9' and in_array($from_id,$admin2)){
	file_put_contents('command.txt',"none");
	file_put_contents ('banner/9/txt.txt',$textmessage);
	 sendAction ($from_id,'typing');
	sendMessage ($from_id,'ثبت شد.');
}elseif ($command == 'b10' and in_array($from_id,$admin2)){
	file_put_contents('command.txt',"none");
	file_put_contents ('banner/10/txt.txt',$textmessage);
	 sendAction ($from_id,'typing');
	sendMessage ($from_id,'ثبت شد.');
}
if ($chat_type == 'supergroup' or $chat_type == 'group'){
	mkdir ('data');
	mkdir ("data/$chat_id");
	file_put_contents ("data/$chat_id/id.txt",$chat_id);
}

if ($command == 'b1' and in_array($from_id,$admin2) and $textmessage != 'برگشت به منو اصلی'){
	if ($fwd_date == ''){
	sendAction ($from_id,'typing');
	 Naweed ('sendMessage',[
	'chat_id'=>$from_id,
	'text'=>"این پیام فوروارد نمی باشد. لطفا برای بنر های یک تا پنچ یک پیام فوروارد شده در نظر بگیرید.",
	'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'برگشت به منو اصلی']],
		]
		])
		]);
	}
}elseif ($command == 'b2' and in_array($from_id,$admin2) and $textmessage != 'برگشت به منو اصلی'){
	if ($fwd_date == ''){
	sendAction ($from_id,'typing');
	 Naweed ('sendMessage',[
	'chat_id'=>$from_id,
	'text'=>"این پیام فوروارد نمی باشد. لطفا برای بنر های یک تا پنچ یک پیام فوروارد شده در نظر بگیرید.",
	'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'برگشت به منو اصلی']],
		]
		])
		]);
	}
}elseif ($command == 'b3' and in_array($from_id,$admin2) and $textmessage != 'برگشت به منو اصلی'){
	if ($fwd_date == ''){
	sendAction ($from_id,'typing');
	 Naweed ('sendMessage',[
	'chat_id'=>$from_id,
	'text'=>"این پیام فوروارد نمی باشد. لطفا برای بنر های یک تا پنچ یک پیام فوروارد شده در نظر بگیرید.",
	'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'برگشت به منو اصلی']],
		]
		])
		]);
	}
}elseif ($command == 'b4' and in_array($from_id,$admin2) and $textmessage != 'برگشت به منو اصلی'){
	if ($fwd_date == ''){
	sendAction ($from_id,'typing');
	 Naweed ('sendMessage',[
	'chat_id'=>$from_id,
	'text'=>"این پیام فوروارد نمی باشد. لطفا برای بنر های یک تا پنچ یک پیام فوروارد شده در نظر بگیرید.",
	'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'برگشت به منو اصلی']],
		]
		])
		]);
	}
}elseif ($command == 'b5' and in_array($from_id,$admin2) and $textmessage != 'برگشت به منو اصلی'){
	if ($fwd_date == ''){
	sendAction ($from_id,'typing');
	 Naweed ('sendMessage',[
	'chat_id'=>$from_id,
	'text'=>"این پیام فوروارد نمی باشد. لطفا برای بنر های یک تا پنچ یک پیام فوروارد شده در نظر بگیرید.",
	'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'برگشت به منو اصلی']],
		]
		])
		]);
	}
}




elseif ($command == 's2a' and in_array($from_id,$admin2) and isset($fwd_date) and $textmessage != 'تنظیم فاصله زمانی ارسال🕒' and $textmessage != 'تنظیم متن بنر ها📝' and $textmessage != 'تنظیم چنل فوروارد' and $textmessage != 'فوروارد همگانی 🔉' and $textmessage != 'آمار ربات 📊' and $textmessage != 'راهنما📖' and $textmessage != 'برگشت به منو اصلی'){
  file_put_contents('command.txt',"none");
  file_put_contents ('ab.txt',$message_id);
  sendAction ($from_id,'typing');
  Naweed('sendMessage',[
	'chat_id'=>$from_id,
	'reply_to_message_id'=>$message_id,
	'text'=>'این پیام را به همه فوروارد کنم؟',
	'parse_mode'=>'MarkDown',
	'reply_markup'=>json_encode([
		'inline_keyboard'=>[
		[['text'=>'اره بفرست','callback_data'=>'are'],['text'=>'نه نفرست','callback_data'=>'na']]
		]
		])
	]);

}
$msg_ida = file_get_contents ('ab.txt');
$chat_ids = scandir('data');
if ($data == 'are'){
	foreach ($chat_ids as $chats){
	    forwardMessage ($chats,$from_id2,$msg_ida);	
}
sendAction($from_id2,'typing');
 Naweed ('sendMessage',[
	'chat_id'=>$from_id2,
	'text'=>"به همه فوروارد شد",
	'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'برگشت به منو اصلی']],
		]
		])
		]);
		Delfile ('ab.txt');
}elseif ($data == 'na'){
Delfile ('ab.txt');
sendAction($from_id2,'typing');
 Naweed ('sendMessage',[
	'chat_id'=>$from_id2,
	'text'=>"چیزی ارسال نشد.",
	'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'برگشت به منو اصلی']],
		]
		])
		]);
}




elseif ($command == 'pmall' and in_array($from_id,$admin2) and $textmessage != 'تنظیم فاصله زمانی ارسال🕒' and $textmessage != 'تنظیم متن بنر ها📝' and $textmessage != 'تنظیم چنل فوروارد' and $textmessage != 'فوروارد همگانی 🔉' and $textmessage != 'آمار ربات 📊' and $textmessage != 'راهنما📖' and $textmessage !='برگشت به منو اصلی'){
  file_put_contents('command.txt',"none");
  file_put_contents ('ab1.txt',$textmessage);
  sendAction ($from_id,'typing');
  Naweed('sendMessage',[
	'chat_id'=>$from_id,
	'reply_to_message_id'=>$message_id,
	'text'=>'این پیام را به همه ارسال کنم؟',
	'parse_mode'=>'MarkDown',
	'reply_markup'=>json_encode([
		'inline_keyboard'=>[
		[['text'=>'اره بفرست','callback_data'=>'are1'],['text'=>'نه نفرست','callback_data'=>'na1']]
		]
		])
	]);

}
$ttttttt = file_get_contents ('ab1.txt');
$chat_ids = scandir('data');
if ($data == 'are1'){
	foreach ($chat_ids as $chats){
	    sendMessage ($chats,$ttttttt);
}
sendAction($from_id2,'typing');
Naweed ('sendMessage',[
	'chat_id'=>$from_id2,
	'text'=>"به همه ارسال شد.",
	'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'برگشت به منو اصلی']],
		]
		])
		]);
		Delfile ('ab1.txt');
}elseif ($data == 'na1'){
Delfile ('ab1.txt');
sendAction($from_id2,'typing');
 Naweed ('sendMessage',[
	'chat_id'=>$from_id2,
	'text'=>"چیزی ارسال نشد.",
	'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'برگشت به منو اصلی']],
		]
		])
		]);
}



if ($textmessage == 'آمار ربات 📊' and in_array($from_id,$admin2)){
	$chat_ids = scandir('data');
	sendAction ($from_id,'typing');
	Naweed('sendMessage',[
		'chat_id'=>$from_id,
		'text'=>count($chat_ids)-2,
		'reply_markup'=>json_encode([
		'resize_keyboard'=>true,
		'one_time_keyboard'=>true,
		'keyboard'=>[
		[['text'=>'برگشت به منو اصلی']],
		]
		])
		]);
		}
	

$time2= file_get_contents ('time2.txt');
$time3= $time2 + 60;
$bagh = fmod(time(),$time*60);
if ($bagh == 1 and time() > $time3){
$sbaner = rand(1,10);
	if ($sbaner < 6 ){
			$msg_idd = file_get_contents ("banner/$sbaner/msgid.txt");
			$chat_ids = scandir('data');
			foreach ($chat_ids as $chats){
			forwardMessage ($chats,$channelid,$msg_idd);	
			}
			file_put_contents ('time2.txt',time());
	}else{
		$tttttt = file_get_contents ("banner/$sbaner/txt.txt");
		foreach ($chat_ids as $chats){
	    sendMessage ($chats,$tttttt);
		}
		file_put_contents ('time2.txt',time());
		
	}

}elseif ($bagh == 2 and time() > $time3){
$sbaner = rand(1,10);
	if ($sbaner < 6 ){
			$msg_idd = file_get_contents ("banner/$sbaner/msgid.txt");
			$chat_ids = scandir('data');
			foreach ($chat_ids as $chats){
			forwardMessage ($chats,$channelid,$msg_idd);	
			}
			file_put_contents ('time2.txt',time());
	}else{
		$tttttt = file_get_contents ("banner/$sbaner/txt.txt");
		foreach ($chat_ids as $chats){
	    sendMessage ($chats,$tttttt);
		}
		file_put_contents ('time2.txt',time());
	}

}elseif ($bagh == 3 and time() > $time3){
$sbaner = rand(1,10);
	if ($sbaner < 6 ){
			$msg_idd = file_get_contents ("banner/$sbaner/msgid.txt");
			$chat_ids = scandir('data');
			foreach ($chat_ids as $chats){
			forwardMessage ($chats,$channelid,$msg_idd);	
			}
			file_put_contents ('time2.txt',time());
	}else{
		$tttttt = file_get_contents ("banner/$sbaner/txt.txt");
		foreach ($chat_ids as $chats){
	    sendMessage ($chats,$tttttt);
		}
		file_put_contents ('time2.txt',time());
	}

}elseif ($bagh == 4 and time() > $time3){
$sbaner = rand(1,10);
	if ($sbaner < 6 ){
			$msg_idd = file_get_contents ("banner/$sbaner/msgid.txt");
			$chat_ids = scandir('data');
			foreach ($chat_ids as $chats){
			forwardMessage ($chats,$channelid,$msg_idd);	
			}
			file_put_contents ('time2.txt',time());
	}else{
		$tttttt = file_get_contents ("banner/$sbaner/txt.txt");
		foreach ($chat_ids as $chats){
	    sendMessage ($chats,$tttttt);
		}
		file_put_contents ('time2.txt',time());
	}

}elseif ($bagh == 5 and time() > $time3){
$sbaner = rand(1,10);
	if ($sbaner < 6 ){
			$msg_idd = file_get_contents ("banner/$sbaner/msgid.txt");
			$chat_ids = scandir('data');
			foreach ($chat_ids as $chats){
			forwardMessage ($chats,$channelid,$msg_idd);	
			}
			file_put_contents ('time2.txt',time());
	}else{
		$tttttt = file_get_contents ("banner/$sbaner/txt.txt");
		foreach ($chat_ids as $chats){
	    sendMessage ($chats,$tttttt);
		}
		file_put_contents ('time2.txt',time());
	}

}elseif ($bagh == 6 and time() > $time3){
$sbaner = rand(1,10);
	if ($sbaner < 6 ){
			$msg_idd = file_get_contents ("banner/$sbaner/msgid.txt");
			$chat_ids = scandir('data');
			foreach ($chat_ids as $chats){
			forwardMessage ($chats,$channelid,$msg_idd);	
			}
			file_put_contents ('time2.txt',time());
	}else{
		$tttttt = file_get_contents ("banner/$sbaner/txt.txt");
		foreach ($chat_ids as $chats){
	    sendMessage ($chats,$tttttt);
		}
		file_put_contents ('time2.txt',time());
	}

}elseif ($bagh == 7 and time() > $time3){
$sbaner = rand(1,10);
	if ($sbaner < 6 ){
			$msg_idd = file_get_contents ("banner/$sbaner/msgid.txt");
			$chat_ids = scandir('data');
			foreach ($chat_ids as $chats){
			forwardMessage ($chats,$channelid,$msg_idd);	
			}
			file_put_contents ('time2.txt',time());
	}else{
		$tttttt = file_get_contents ("banner/$sbaner/txt.txt");
		foreach ($chat_ids as $chats){
	    sendMessage ($chats,$tttttt);
		}
		file_put_contents ('time2.txt',time());
	}

}elseif ($bagh == 8 and time() > $time3){
$sbaner = rand(1,10);
	if ($sbaner < 6 ){
			$msg_idd = file_get_contents ("banner/$sbaner/msgid.txt");
			$chat_ids = scandir('data');
			foreach ($chat_ids as $chats){
			forwardMessage ($chats,$channelid,$msg_idd);	
			}
			file_put_contents ('time2.txt',time());
	}else{
		$tttttt = file_get_contents ("banner/$sbaner/txt.txt");
		foreach ($chat_ids as $chats){
	    sendMessage ($chats,$tttttt);
		}
		file_put_contents ('time2.txt',time());
	}

}

file_put_contents ('a.txt',$json);
Delfile (error_log);
?>