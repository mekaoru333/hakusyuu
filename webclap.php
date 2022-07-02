<?php
/*=1.[ 設定 ]
==============================================================*/
  $to           = "*****@*****.***"; //メール送信先アドレス
  $from         = "*****@*****.***"; // メール送信元アドレス
  $fromname     = "ウェブ拍手"; //メール送信元の名前
  $subject      = "拍手がありました"; // メールの件名
  $thanks       = "thanks.php"; // サンクスページ
  $charset      = "UTF-8";  // 文字コード
/*=設定ここまで===============================================*/

/*=2.[ プログラム処理 ]
==============================================================*/
//formデータを収集
foreach ($_POST as $key => $value) {
  $contents .= "$key:\n$value\n\n";
}
$contents .= "--------------------------------------------------------\n";
  
// 送信者のアクセス元情報
$referer = getenv("HTTP_REFERER");
$contents.=<<<EOM
リファラ：$referer
EOM;

//おまじない
$main = htmlspecialchars($contents);

//送信処理
if($_POST["impression"] != ""){
  mb_language("Ja");
  mb_internal_encoding($charset);
  $mailfrom = "From:" .mb_encode_mimeheader($fromname) ."<$from>";
  mb_send_mail($to,$subject,$main,$mailfrom);

  header("Location: $Thanks");
  }
  else{
  echo "error!!";
}
?>