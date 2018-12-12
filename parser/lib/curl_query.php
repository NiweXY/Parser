<?
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
	

?>