<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

  <title>最强三小只的打卡</title>
 </head>

 <body> 
<h1>最强三小只的Summer打卡计划</h1>

 <?php
 $con=mysql_connect("localhost","dakasys","4PEF724hAyR36iDC"); 
    mysql_query("set names 'utf8'");

    
    
    mysql_select_db("dakasys",$con);  
    date_default_timezone_set('US/Eastern'); // 设定时区
    $subdate=date("Y-m-d");
    echo "<h1><i class='bi bi-calendar-date'></i> 今天是（加拿大时间）:".date("Y-m-d")."</h1>";   


    $result_task=mysql_query("select * from tasks where subdate ='{$subdate}'"); 
     while ($row=mysql_fetch_array($result_task)) {  
        $task=$row["task"];
    }  
 ?>

 <h1><i class="bi bi-speedometer2"></i>今天的任务是：</h1>
 <script>
    function getContent(){
        document.getElementById("my-textarea").value = document.getElementById("my-content").innerHTML;
    }
</script>


<div id="my-content" contenteditable="true"><?php echo $task; ?></div>

<form action="changetask.php" method="post" onsubmit="return getContent()">
    <textarea id="my-textarea" name="task" style="display:none"></textarea>
    <input type="submit" value="更新任务" />
</form>



 <div class="alert alert-success" role="alert">

 <h1><i class="bi bi-calendar-check"></i> 打卡上传区</h1>
  <form action="uploader.php" method="post" enctype="multipart/form-data">
   上传打卡截图:<input type="file" name="img"/>
   <br><br>
   <select name="person">
   <option value ="">---请选择你的名字---</option>
  <option value ="leo">Leo</option>
  <option value ="cathy">Cathy</option>
  <option value="jonathan">Jonathan</option>
</select>

<input name="picname" type="text" placeholder="输入打卡的项目">

   <input type="submit" value="提交打卡"/>
  </form>

</div>
 <h2><i class="bi bi-check2-circle"></i>来看看大家的打卡进度</h2>

 <div class="alert alert-primary" role="alert">

<?php
     $result=mysql_query("select * from picinfo where subdate ='{$subdate}' and person = 'leo'"); 
    $counter_leo=0;
     while ($row=mysql_fetch_array($result)) {  
        $address=$row["address"];
        $picname=$row["picname"];
        $addtime=$row["addtime"];
        $person = $row["person"];
        echo "<i class='bi bi-bullseye'></i>$picname $person 于 $addtime 打卡<img width='5%' src='$address'></img><br>";
        $counter_leo ++;
    }  
echo "<h1>里哦今天的打卡".$counter_leo."/5</h1>";
    if($counter_leo >=5)
    {
        echo "今天的打卡完成啦！";
    }

?>

</div>

 <div class="alert alert-danger" role="alert">

<?php
     $result=mysql_query("select * from picinfo where subdate ='{$subdate}' and person = 'cathy'"); 
    $counter_cathy=0;
     while ($row=mysql_fetch_array($result)) {  
        $address=$row["address"];
        $picname=$row["picname"];
        $addtime=$row["addtime"];
        $person = $row["person"];
        echo "<i class='bi bi-bullseye'></i>$picname $person 于 $addtime 打卡<img width='5%' src='$address'></img><br>";
        $counter_cathy ++;
    }  
echo "<h1>卡西今天的打卡".$counter_cathy."/5</h1>";
    if($counter_cathy >=5)
    {
        echo "今天的打卡完成啦！";
    }

?>

</div>
<div class="alert alert-warning" role="alert">
<?php
     $result=mysql_query("select * from picinfo where subdate ='{$subdate}' and person = 'jonathan'"); 
    $counter_jonathan=0;
     while ($row=mysql_fetch_array($result)) {  
        $address=$row["address"];
        $picname=$row["picname"];
        $addtime=$row["addtime"];
        $person = $row["person"];
        echo "<i class='bi bi-bullseye'></i>$picname $person 于 $addtime 打卡<img width='5%' src='$address'></img><br>";
        $counter_jonathan ++;
    }  
echo "<h1>乔尼今天的打卡".$counter_jonathan."/5</h1>";
    if($counter_jonathan >=5)
    {
        echo "今天的打卡完成啦！";
    }

?>
</div>
 

 </body>
</html>
