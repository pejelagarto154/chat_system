<?php
include('../config.php');
session_start();
switch( $_REQUEST['action']){
    case "sendMessage":
        $query=$db->prepare("INSERT INTO messages set user=?, message=?");
        $run=$query->execute([$_SESSION['username'],$_REQUEST['message']]);

        if($run){
            echo 1;
            exit;
        }
    break;

    case "getMessage":
        $query=$db->prepare("SELECT * FROM messages");
        $run=$query->execute();

        $rs=$query->fetchAll(PDO::FETCH_OBJ);
        $chat='';
        foreach ( $rs as $message ) {
            $chat.='<div class="single-message '.(($_SESSION['username']==$message->user)?'right':'left').'">
                        <strong>'.$message->user.': </strong><br/><p>'.$message->message.'</p><br/>
                        <span>'.date('h:i a',strtotime($message->date)).'</span>
                    </div>
                    <div class="clear"></div>';
        }
        echo $chat;
    break;
}

?>