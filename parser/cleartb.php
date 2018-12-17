<style>
 body{
	top: calc(50% - 200/2);
	left: calc(50% - 300/2);
    overflow: auto; /* Добавляем полосы прокрутки */
    padding-left: 15px; /* Отступ от текста слева */
    background: url(01.jpg) repeat-y #fc0;
    -moz-background-size: 100%; /* Firefox 3.6+ */
    -webkit-background-size: 100%; /* Safari 3.1+ и Chrome 4.0+ */
    -o-background-size: 100%; /* Opera 9.6+ */
    background-size: 100%; /* Современные браузеры */
	color: #fff; /* Цвет текста */
}	#weightfrm{
margin-top:20px;
}
  </style>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
$link = mysqli_connect('localhost', 'id3913902_root', 'admin', 'id3913902_foxtrot');
$sql="TRUNCATE TABLE `items`";
$result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));}
if (!empty($result)) {
  echo"<p><b>Таблицю очищено</b></p>";
} else {  
 echo"<p><b>Неможливо очистити таблицю</b></p>";
}?>