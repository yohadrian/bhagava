<?php
//created by bilie christiansen
//untuk memulai session
function sec_session_start(){
     global $settings;
    $session_name = 'bhagavagallery_session';
    $secure = false;
    
    $httponly = true;
    
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header('Location: ../error.php?err=Could not initiate a safe session ('.ini_set.')');
        exit();
    }
    
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams['lifetime'],
        $cookieParams['path'], 
        $cookieParams['domain'], 
        $secure,
        $httponly);
    
    session_name($session_name);
    session_start();
    session_regenerate_id(); 
}

//fungsi ini untuk menyimpan hasil login ke dalam session
function login($userid, $password, $mysqli){
     global $setting;
     global $logs;
     $uid = $userid;
     $sql = 'select id_user, id_groupuser, nama, username, password, salt, is_admin from m_user where username = ? and active = \'1\'';
     
     if($st = $mysqli->prepare($sql)){
          $st->bind_param('s', $uid);
          $st->execute();
          $st->store_result();
          
          $st->bind_result($id_user, $id_groupuser, $nama, $username, $dbpassword, $salt, $is_admin);
          $st->fetch();
          $password = hash('sha512', $password);
          
          if($st->num_rows == 1){
               if($dbpassword == $password){
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    $userid = preg_replace("/[^0-9]+/", "", $userid);
                    
                    //set session
                    $_SESSION['bhagavagallery_loginstring'] = hash('sha512',$password.$user_browser);
                    $_SESSION['bhagavagallery_userid'] = $id_user;
                    $_SESSION['bhagavagallery_username'] = $uid;
                    $_SESSION['bhagavagallery_id_groupuser'] = $id_groupuser;
                    $_SESSION['bhagavagallery_isadmin'] = $is_admin;
     
                    return true;
               } else {
                    return false;
               }
          } else {
               return false;
          }
          
     } else {
          return false;
     }
}

//fungsi ini untuk mengecek login apakah benar username and passwordnya.
function login_check($mysqli) {
     global $setting;
     global $log;
     
     if(isset($_SESSION['bhagavagallery_loginstring'], $_SESSION['bhagavagallery_userid'], $_SESSION['bhagavagallery_username'])){
          
          $user_id = $_SESSION['bhagavagallery_userid'];
          $username = $_SESSION['bhagavagallery_username'];
          $login_string = $_SESSION['bhagavagallery_loginstring'];
          $user_browser = $_SERVER['HTTP_USER_AGENT'];
          $sql = 'select password from m_user where id_user = ? limit 1';
          
          if($st= $mysqli->prepare($sql)) {
               $st->bind_param('s',$user_id);
               $st->execute();
               $st->store_result();
               
               $st->bind_result($password);
               $st->fetch();
              
               $login_check = hash('sha512', $password.$user_browser);
               if($login_check == $login_string){
                    return true;
               } else {
                    return false;
               }
          } else {
               return false;
          }
     }
    
}

?>