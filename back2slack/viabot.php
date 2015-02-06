<?php
// viabot.php
// BacklogプロジェクトのGit更新をWebhookを使ってSlackに投稿するスクリプトです。
// Backlogから送信されるjsonファイルをSlackbotで受け取り、指定チャンネルに
// postします。
//
// Settings
// Slackbot用のtokenと投稿先チャンネルを設定します。

$stoken = 'xxxxxxxxxxxxxxxxxxxxxx' ;
$schannel = 'yyyyyyyyyyy';

// Posting

$boturl = 'https://officeto.slack.com/services/hooks/slackbot?token='.$stoken.'&channel=%23'.$schannel;
$post_json = $_POST['payload'];
//$post_json = file_get_contents('backlogjson.txt');
$content = json_decode($post_json);
//var_dump($content);

$message = $content->{'revisions'}[0]->{'author'}->{'name'}.'さんがリポジトリ'.$content->{'repository'}->{'name'} . 'を更新しました！ '.$content->{'repository'}->{'url'}.' メッセ
ージ：'.$content->{'revisions'}[0]->{'message'} ;
//echo $message;

$result = slackpostviabot($boturl,$message);
var_dump($result);

function slackpostviabot($url,$message)
{
    $headers = array();
    $result = postRequest($url, $message, $headers);
    return $result;
}
function postRequest($url, $params, $headers = array())
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    $result = curl_exec($ch);
    $error = curl_error($ch);

    curl_close($ch);

    if ($error) {
        throw new \Exception($error);
    }

    return $result;
}
?>
