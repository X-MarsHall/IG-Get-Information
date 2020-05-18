<?php



echo "
   ____         __                         
  /  _/__  ___ / /____ ____ ________ ___ _    Author : MarsHall
 _/ // _ \(_-</ __/ _ `/ _ `/ __/ _ `/  ' \   Team   : Xai Syndicate
/___/_//_/___/\__/\_,_/\_, /_/  \_,_/_/_/_/
                      /___/                
";
echo "Username : ";
$u = trim(fgets(STDIN));

function http_request($url){
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; Android 5.0.2; Redmi Note 3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.96 Mobile Safari/537.36');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $output = curl_exec($ch); 
    curl_close($ch);      
    return $output;
}
$ko = http_request("https://www.instagram.com/$u/?__a=1");
$ko = json_decode($ko, TRUE);


$user = $ko['graphql']['user']['username'];
$bio  = $ko['graphql']['user']['biography'];
$name = $ko['graphql']['user']['full_name'];
$peng = $ko['graphql']['user']['edge_followed_by']['count'];
$meng = $ko['graphql']['user']['edge_follow']['count'];
$foto = $ko['graphql']['user']['profile_pic_url_hd'];

echo "\nGet Information";
echo "\n___________________\n";
echo "Username     : $user\n";
echo "Nama lengkap : $name\n";
echo "Bio          : $bio\n";
echo "Foto profil  : $foto\n";
echo "Pengikut     : $peng\n";
echo "Mengikuti    : $meng\n";
echo "\r\nGet Media... \r\n";
sleep(1);
for ($i=0; $i <= 10; $i++) {
$medi = $ko['graphql']['user']['edge_owner_to_timeline_media']['edges'][$i]['node']['display_url'];
if ( $medi ){
    echo "Media ($i)   : $medi\n";
} else {
    echo "[×] Akun Privat \n";
    exit();
}

}




