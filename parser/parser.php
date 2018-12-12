<?
include_once('lib/SQL.php');
include_once('lib/curl_query.php');
include_once('lib/simple_html_dom.php');
ini_set('allow_url_fopen','1');
ini_set("max_execution_time", 10); 
$sql = SQL::Instance();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
$url = $_POST['url'];

$html = curl_load($url);
$dom = str_get_html($html);

	if($url=='https://www.foxtrot.com.ua'){//parsing categories
		$courses = $dom->find('.link-text');
			foreach($courses as $course){
				//echo $course->plaintext .'<br>';	
			}
	}	
$pages = $_POST['pages'];//pages data
$newpages = str_replace("-", ",", $pages);//change foa arr
$pages_arr = explode(",", $newpages);//create arr
$minmax= (range(min($pages_arr),max($pages_arr)));//craete new arr(min,max)
	for($i=0;$i<max($minmax);){
		$sourse= curl_load($url."?page=".$minmax[$i]);//new links for pages pars
		
		//pars name of product
		 preg_match_all("'<p class=\"info\">(.*?)</p>'si", $sourse, $match );
			foreach($match[1] as $val)
				{
					//echo $val."<br>";
				}
		//pars	for reviews		
		preg_match_all("'<span class=\"review-number\">(.*?)</span>'si", $sourse, $mas );
			foreach($mas[1] as $vall)
				{
					//echo $vall."<br>";
				}
		//вот тут у мене не виходить вказати шлях до цього коду
		//pars for  price
		/*<div class="price">
                <div class="price__not-relevant">
                    <span class="numb">14299</span><span class="currency">грн</span>
                </div>

                <div class="price__relevant">
                    <span class="numb">13299</span><span class="currency">грн</span>
                </div>
            </div>
			*/
		preg_match_all("'<span class=\"numb\">(.*?)</span>'si", $sourse, $mass );
			foreach($mass[1] as $value)
				{
					echo $value."<br>";
				}
		break;
	$i++;			
	}
	
}	
?>