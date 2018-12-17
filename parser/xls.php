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
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    
require_once 'lib/PHPExcel/Classes/PHPExcel.php';
$link = mysqli_connect('localhost', 'id3913902_root', 'admin', 'id3913902_foxtrot');
$query1 = mysqli_query($link, "SELECT * FROM `items`");
$myrow = mysqli_fetch_array($query1);
 
  $phpexcel = new PHPExcel(); 
  $page = $phpexcel->setActiveSheetIndex(0); 
  $page->setCellValue("A1", "id_item"); 
  $page->setCellValue("B1", "category");
  $page->setCellValue("C1", "brend");
  $page->setCellValue("D1", "kod");   
  $page->setCellValue("E1", "name"); 
  $page->setCellValue("F1", "reviews");   
 
$s = 3;
while($row=mysqli_fetch_array($query1))
{ 

  $page->setCellValue("A$s", $row['id_item']); 
  $page->setCellValue("B$s", $row['category']);
  $page->setCellValue("C$s", $row['brend']);
  $page->setCellValue("D$s", $row['kod']);   
  $page->setCellValue("E$s", $row['name']); 
  $page->setCellValue("F$s", $row['reviews']);   
 $s++; 

} 
  //$page->setTitle("foxtrot"); 
  //$objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
   
//$objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
echo"hello"; 
$objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
  /* Записываем в файл */
  $objWriter->save('php://output');

}



?>