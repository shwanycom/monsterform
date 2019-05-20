<?php
function create_table($conn, $table_name){
  $flag = "NO";
  $sql = "show tables from monsterform_db";
  $result = mysqli_query($conn,$sql) or die('Error: ' . mysqli_error($conn));
  while ($row = mysqli_fetch_row($result)) {
    if($row[0]==="$table_name"){
      $flag="OK";
      break;
    }
  }
  if($flag=="NO"){
    switch($table_name){
      case 'member' :
      $sql = "CREATE TABLE `member` (
              `no` int(11) NOT NULL AUTO_INCREMENT,
              `email` varchar(100) NOT NULL,
              `username` varchar(100) NOT NULL,
              `password` varchar(100) DEFAULT NULL,
              `point_mon` int(11) NOT NULL DEFAULT '0',
              `partner` varchar(100) NOT NULL DEFAULT 'n',
              `location` varchar(100) DEFAULT NULL,
              `profession` varchar(100) DEFAULT NULL,
              `use_mf` varchar(100) DEFAULT NULL,
              PRIMARY KEY (`no`),
              UNIQUE KEY `email_UNIQUE` (`email`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
      break;
      case 'cart' :
        $sql = "CREATE TABLE `cart` (
                `no` int(11) NOT NULL,
                `num` int(11) NOT NULL,
                `product_num` int(11) NOT NULL,
                `price` int(11) NOT NULL,
                `cart_img_name` varchar(100) NOT NULL,
                `checked` varchar(100) NOT NULL DEFAULT 'n',
                PRIMARY KEY (`num`)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
      break;
      case 'collections' :
        $sql = "CREATE TABLE `collections` (
                `no` int(11) NOT NULL,
                `folder_name` varchar(100) NOT NULL DEFAULT '...',
                `product_num` int(11) NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
      break;
      case 'discussion':
        $sql = "CREATE TABLE `discussion` (
                `no` int(11) NOT NULL,
                `num` int(11) NOT NULL AUTO_INCREMENT,
                `username` varchar(100) NOT NULL,
                `email` varchar(100) NOT NULL,
                `topic` varchar(100) NOT NULL,
                `subject` varchar(100) NOT NULL,
                `content` varchar(100) NOT NULL,
                `regist_day` date NOT NULL,
                PRIMARY KEY (`num`)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
      break;
      case 'discussion_ripple':
        $sql = "CREATE TABLE `discussion_ripple` (
                `num` int(11) NOT NULL AUTO_INCREMENT,
                `parent` int(11) NOT NULL,
                `username` varchar(100) NOT NULL,
                `email` varchar(100) NOT NULL,
                `content` varchar(100) NOT NULL,
                `regist_day` date NOT NULL,
                PRIMARY KEY (`num`)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
      break;
      case 'follow':
        $sql = "CREATE TABLE `follow` (
                `following` int(11) NOT NULL,
                `follower` int(11) NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
      break;
      case 'likes':
        $sql = "CREATE TABLE `likes` (
                `no` int(11) NOT NULL,
                `product_num` int(11) NOT NULL,
                `regist_day` date NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
      break;
      case 'products' :
        $sql = "CREATE TABLE `products` (
                `no` int(11) NOT NULL,
                `num` int(11) NOT NULL AUTO_INCREMENT,
                `product_num` int(11) NOT NULL,
                `username` varchar(100) NOT NULL,
                `email` varchar(100) NOT NULL,
                `subject` varchar(100) NOT NULL,
                `content` text NOT NULL,
                `regist_day` date NOT NULL,
                `price` int(11) NOT NULL,
                `handpicked` varchar(100) NOT NULL DEFAULT 'n',
                `freegoods` varchar(100) NOT NULL DEFAULT 'n',
                `hit` int(11) NOT NULL DEFAULT '0',
                `sell_count` int(11) NOT NULL DEFAULT '0',
                `big_data` varchar(100) NOT NULL,
                `small_data` varchar(100) NOT NULL,
                `hash_tag` varchar(100) NOT NULL,
                `img_file_name1` varchar(100) NOT NULL,
                `img_file_name2` varchar(100) NOT NULL,
                `img_file_name3` varchar(100) NOT NULL,
                `img_file_name4` varchar(100) NOT NULL,
                `img_file_copied1` varchar(100) NOT NULL,
                `img_file_copied2` varchar(100) NOT NULL,
                `img_file_copied3` varchar(100) NOT NULL,
                `img_file_copied4` varchar(100) NOT NULL,
                `zip_file_name` varchar(100) NOT NULL,
                `zip_file_copied` varchar(100) NOT NULL,
                `zip_file_type` varchar(100) NOT NULL,
                PRIMARY KEY (`num`)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
      break;
      case 'report':
      $sql = "CREATE TABLE `report` (
                `product_num` int(11) NOT NULL,
                `price` int(11) NOT NULL,
                `regist_day` date NOT NULL,
                `no` int(11) NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
      break;
      case 'sales':
      $sql = "CREATE TABLE `sales` (
                `won` int(11) NOT NULL,
                `bonus_won` int(11) NOT NULL DEFAULT '0',
                `point_mon` int(11) NOT NULL,
                `no` int(11) NOT NULL,
                `regist_day` date NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
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
