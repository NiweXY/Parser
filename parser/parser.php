

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
function curl_load($url,$referer='google.com.ua'){
    curl_setopt($ch=curl_init(), CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64;
		rv:38.0) Gecko/20100101 Firefox/38.0");
		curl_setopt($ch, CURLOPT_REFERER, $referer);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
		return $response;
	}
include_once('lib/curl_query.php');
include_once('lib/simple_html_dom.php');
ini_set('allow_url_fopen','1');
ini_set("max_execution_time", 20); 
require_once 'lib/PHPExcel/Classes/PHPExcel.php';
$link = mysqli_connect('localhost', 'id3913902_root', 'admin', 'id3913902_foxtrot') or die("Ошибка " . mysqli_error($link));
		
if($_SERVER['REQUEST_METHOD'] == 'POST') {
$url = $_POST['url'];


$html = curl_load($url);
$dom = str_get_html($html);

/*if($url=='https://www.foxtrot.com.ua'){//parsing categories
		$courses = $dom->find('.link-text');
			foreach($courses as $course){
				//echo $course->plaintext .'<br>';	
			}
	}*/
	
$pages = $_POST['pages'];//pages data

$newpages = str_replace("-", ",", $pages);//change foa arr
$pages_arr = explode(",", $newpages);//create arr
$minmax= (range(min($pages_arr),max($pages_arr)));//craete new arr(min,max)

for($i=0;$i<max($minmax);){
		$sourse= curl_load($url."?page=".$minmax[$i]);//new links for pages pars
		
		preg_match_all("'<span class=\"product-code__code\">(.*?)</span>'si", $sourse, $matk );
		foreach($matk[1] as $val){}unset($matk[1]);
		preg_match_all("'<span class=\"review-number\">(.*?)</span>'si", $sourse, $matr );
		foreach($matr[1] as $val){}unset($matr[1]);
		
		
		preg_match_all('~ data-category="\K[^"]+~', $sourse, $matc );
		preg_match_all('~ data-brand="\K[^"]+~', $sourse, $matb );
		preg_match_all('~ data-title="\K[^"]+~', $sourse, $matn );
		
	$arrc = call_user_func_array('array_merge', $matc);	
	$arrb = call_user_func_array('array_merge', $matb);
	$arrk = call_user_func_array('array_merge', $matk);
	$arrn = call_user_func_array('array_merge', $matn);
	$arrr = call_user_func_array('array_merge', $matr);
	
	$count = count($arrn);  
		for ($k=0; $k < $count; $k++) { 
		$arrk[$k] = preg_replace('~[^0-9]+~','',$arrk[$k]); 
		$arrr[$k] = preg_replace('~[^0-9]+~','',$arrr[$k]); 	
		$sql="INSERT INTO `items` (`id_item`,`category`,`brend`,`kod`,`name`,`reviews`)VALUES (NULL,'$arrc[$k]','$arrb[$k]','$arrk[$k]','$arrn[$k]','$arrr[$k]')";
		
		 $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
		}
	
	$i++;

}
if (!empty($result)) {

  echo"<p><b>Дані занесено успішно</b></p>";
} else {  

 echo"<p><b>Помилка</b></p>";


}
}


 


?>
