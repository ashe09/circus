<?php
function h($var) {
  if(is_array($var)){
    return array_map('h', $var);
  }else{
    return htmlspecialchars($var, ENT_QUOTES, 'UTF-8');
  }
}

function checkInput($var){
  if(is_array($var)){
    return array_map('checkInput', $var);
  }else{
    if(preg_match('/\0/', $var)){  
      die('不正な入力です。');
    }
    if(!mb_check_encoding($var, 'UTF-8')){ 
      die('不正な入力です。');
    }
    if(preg_match('/\A[\r\n\t[:^cntrl:]]*\z/u', $var) === 0){  
      die('不正な入力です。制御文字は使用できません。');
    }
    return $var;
  }
}