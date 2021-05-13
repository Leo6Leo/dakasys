<?php
// 接收文件
header("Content-type:text/html;charset=utf-8");
//var_dump($_FILES); // 区别于$_POST、$_GET
date_default_timezone_set('US/Eastern'); // 设定时区
//print_r($_FILES);
$file = $_FILES["img"];
$person = $_POST["person"];
$picname = $_POST["picname"];
$subdate = date('Y-m-d');


$con=mysql_connect("localhost","dakasys","4PEF724hAyR36iDC");  
mysql_query("set names 'utf8'");

mysql_select_db("dakasys",$con);  
 
$addtime = date('Y-m-d H:i:s');


if (!$con) {  
    die('数据库连接失败'.$mysql_error());  
}  
// 先判断有没有错
if ($file["error"] == 0) {
 // 成功 
 // 判断传输的文件是否是图片，类型是否合适
 // 获取传输的文件类型
 $typeArr = explode("/", $file["type"]);
 if($typeArr[0]== "image"){
  // 如果是图片类型
  $imgType = array("png","jpg","jpeg");
  if(in_array($typeArr[1], $imgType)){ // 图片格式是数组中的一个
   // 类型检查无误，保存到文件夹内
   // 给图片定一个新名字 (使用时间戳，防止重复)
   $imgname = "file/".time().".".$typeArr[1];
   // 将上传的文件写入到文件夹中
   // 参数1: 图片在服务器缓存的地址
   // 参数2: 图片的目的地址（最终保存的位置）
   // 最终会有一个布尔返回值
   $bol = move_uploaded_file($file["tmp_name"], $imgname);
   if($bol){
    mysql_query("insert into picinfo (picname,address,subdate,addtime,person) values('{$picname}','{$imgname}','{$subdate}','{$addtime}','{$person}')") or die("后台记录存入失败".mysql_error()) ;  

    echo "上传成功！返回刷新页面查看更新吧";
    ?>
    <a href="index.php">返回上一级</a>
    <?php
   } else {
    echo "上传失败！";
   };
  };
 } else {
  // 不是图片类型
  echo "没有图片，再检查一下吧！";
 };
} else {
 // 失败
 echo "失败";
};
?>
