<?php
/*
  File Name : sstr.php
  Function  : 获取包含中午的字符串的真实长度
  Last Edit : Jun 12,2018T01:21
  Programmer: MeetinaXD.
*/
function sstrlen($str,$charset) {
    $n = 0; $p = 0; $c = '';
    $len = strlen($str);
    if($charset == 'utf-8') {
      for($i = 0; $i < $len; $i++) {
        $c = ord($str{$i});
        if($c > 252) {
          $p = 5;
        } elseif($c > 248) {
          $p = 4;
        } elseif($c > 240) {
          $p = 3;
        } elseif($c > 224) {
          $p = 2;
        } elseif($c > 192) {
          $p = 1;
        } else {
          $p = 0;
        }
        $i+=$p;$n++;
      }
    } else {
      for($i = 0; $i < $len; $i++) {
        $c = ord($str{$i});
        if($c > 127) {
          $p = 1;
        } else {
          $p = 0;
      }
        $i+=$p;$n++;
      }
    }
    return $n;
}
function CreateRandomStr($length=32){
  $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!#^&*()_+-=`~{}[]:;<>,./?';
  $str ="";
  for ($i = 0;$i < $length;$i++){
    $str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);
  }
  return $str;
}
?>