<?php
function create_table($conn, $table_name){
  $flag = "NO";
  $sql = "show tables from ansisung";
  $result = mysqli_query($conn,$sql) or die('Error: ' . mysqli_error($conn));
  while ($row = mysqli_fetch_row($result)) {
    if($row[0]==="$table_name"){
      $flag="OK";
      break;
    }
  }
  if($flag=="NO"){
    switch($table_name){
      case 'memo' :
      $sql = "CREATE TABLE `memo`(
        `num` int(11) NOT NULL AUTO_INCREMENT,
        `id` char(15) NOT NULL,
        `name` char(10) NOT NULL,
        `nick` char(10) NOT NULL,
        `content` text NOT NULL,
        `regist_day` char(20) DEFAULT NULL,
        PRIMARY KEY (`num`)
      )ENGINE=InnoDB DEFAULT CHARSET=utf8;";
      break;
      case 'memo_ripple' :
        $sql = "CREATE TABLE `memo_ripple`(
          `num` int(11) NOT NULL AUTO_INCREMENT,
          `parent` int(11) NOT NULL,
          `id` char(15) NOT NULL,
          `name` char(10) NOT NULL,
          `nick` char(10) NOT NULL,
          `content` text NOT NULL,
          `regist_day` char(20) DEFAULT NULL,
          PRIMARY KEY (`num`)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;";
      break;
      case 'member' :
        $sql = "CREATE TABLE `member`(
          `id` char(15) NOT NULL,
          `pass` char(15) NOT NULL,
          `name` char(10) NOT NULL,
          `nick` char(10) NOT NULL,
          `hp` char(20) NOT NULL,
          `email` varchar(80) DEFAULT NULL,
          `regist_day` char(20) DEFAULT NULL,
          `level` int(11) DEFAULT NULL,
          PRIMARY KEY (`id`)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;";
      break;
      case 'greet_board':
        $sql = "CREATE TABLE `greet_board`(
          `num` int(11) NOT NULL AUTO_INCREMENT,
          `id` char(15) NOT NULL,
          `subject` char(100) NOT NULL,
          `content` text NOT NULL,
          `regist_day` char(20) DEFAULT NULL,
          `hit` int(11) DEFAULT NULL,
          `is_html` char(1) DEFAULT NULL,
          PRIMARY KEY (`num`)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;";
      break;
      case 'concert_board':
        $sql = "CREATE TABLE `concert_board`(
          `num` int(11) NOT NULL AUTO_INCREMENT,
          `id` char(15) NOT NULL,
          `name` char(10) NOT NULL,
          `nick` char(10) NOT NULL,
          `subject` char(100) NOT NULL,
          `content` text NOT NULL,
          `regist_day` char(20) DEFAULT NULL,
          `hit` int(11) DEFAULT NULL,
          `is_html` char(1) DEFAULT NULL,
          `file_name_0` char(40) DEFAULT NULL,
          `file_copied_0` char(40) DEFAULT NULL,
          PRIMARY KEY (`num`)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;";
      break;
      case 'download_board':
        $sql = "CREATE TABLE `download_board`(
          `num` int(11) NOT NULL AUTO_INCREMENT,
          `id` char(15) NOT NULL,
          `name` char(10) NOT NULL,
          `nick` char(10) NOT NULL,
          `subject` char(100) NOT NULL,
          `content` text NOT NULL,
          `regist_day` char(20) DEFAULT NULL,
          `hit` int(11) DEFAULT NULL,
          `file_name_0` char(40) DEFAULT NULL,
          `file_copied_0` char(40) DEFAULT NULL,
          `file_type_0` char(40) DEFAULT NULL,
          PRIMARY KEY (`num`)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;";
      break;
      case 'free_board':
        $sql = "CREATE TABLE `free_board`(
          `num` int(11) NOT NULL AUTO_INCREMENT,
          `id` char(15) NOT NULL,
          `name` char(10) NOT NULL,
          `nick` char(10) NOT NULL,
          `subject` char(100) NOT NULL,
          `content` text NOT NULL,
          `regist_day` char(20) DEFAULT NULL,
          `hit` int(11) DEFAULT NULL,
          `is_html` char(1) DEFAULT NULL,
          `file_name_0` char(40) DEFAULT NULL,
          `file_copied_0` char(40) DEFAULT NULL,
          `file_type_0` char(40) DEFAULT NULL,
          PRIMARY KEY (`num`)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;";
      break;
      case 'free_ripple' :
        $sql = "CREATE TABLE `free_ripple`(
          `num` int(11) NOT NULL AUTO_INCREMENT,
          `parent` int(11) NOT NULL,
          `id` char(15) NOT NULL,
          `name` char(10) NOT NULL,
          `nick` char(10) NOT NULL,
          `content` text NOT NULL,
          `regist_day` char(20) DEFAULT NULL,
          PRIMARY KEY (`num`)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;";
      break;
      case 'qna':
      $sql = "CREATE TABLE `qna` (
        `num` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `group_num` int(11) unsigned NOT NULL,
        `depth` int(11) unsigned NOT NULL,
        `ord` int(11) unsigned NOT NULL,
        `id` char(15) NOT NULL,
        `name` char(10) NOT NULL,
        `nick` char(10) NOT NULL,
        `subject` char(100) NOT NULL,
        `content` text NOT NULL,
        `regist_day` char(20) DEFAULT NULL,
        `hit` TINYINT unsigned DEFAULT 0,
        `is_html` char(1) DEFAULT NULL,
        PRIMARY KEY (`num`)
      )CHARSET=utf8;";
      break;
      case 'survey':
      $sql = "CREATE TABLE `survey` (
        `ans1` int(11) unsigned default 0,
        `ans2` int(11) unsigned default 0,
        `ans3` int(11) unsigned default 0,
        `ans4` int(11) unsigned default 0
      )CHARSET=utf8;";
      $sql_insert="INSERT INTO `survey` (`ans1`, `ans2`, `ans3`, `ans4`) VALUES (0,0,0,0);";
      break;
      default:
      echo '<script >alert("해당 테이블명이 없습니다.");</script>';
      break;
    }//end of switch
    if(mysqli_query($conn,$sql)){
        echo '<script >
          alert("member 테이블 생성되었습니다.");
        </script>';
    }else{
      echo "실패원인".mysqli_query($conn);
    }
    if(!empty($sql_insert)){
      if(mysqli_query($conn,$sql_insert)){
        echo '<script >
          alert("초기값 설정 완료");
        </script>';
      }else{
        echo "실패원인".mysqli_query($conn);
      }
    }
  }//end of flag
}//end of function

?>
