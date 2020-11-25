<?php
// sorry pakai xampp php 7 harusnya 5 jadi yang di line 6 gak bisa

//	public static function random(int $panjang) : string {}
function random( $panjang)  {
    $karakter = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    $string = '';
    for($i = 0; $i < $panjang; $i++){
            $pos = rand(0,strlen($karakter)-1);
            $string .= $karakter{$pos};
	}

    return $string;
}

    function generateApiKey(){
        return md5(uniqid(rand(), true));
    }

    function genHash($username, $password){
        $arUsername = unpack('C*', $username);
        $arPassword = unpack('C*', $password);

        //		var_dump($arPassword);
        //echo "<br>";

        $lenUsername = count($arUsername);
        $lenPassword = count($arPassword);

        $results = "";

        if ($lenUsername>=$lenPassword) {
            $usernameLongger = true;
            $loopCount = $lenUsername ;
        }else {
            $usernameLongger = false;
            $loopCount = $lenPassword;
        }

        for($idx=0; $idx<$loopCount; $idx++){
            if ($usernameLongger){
                $b1 = $arUsername[$idx+1];
                $b2 = $arPassword[($idx % $lenPassword)+1];
            } else {
                $b1 = $arUsername[($idx % $lenUsername)+1];
                $b2 = $arPassword[$idx+1];
            }
            $result = $b1 ^ $b2;
            //echo $idx . "->>" . $b1 . "^" . $b2 . " = " . $result ."<br>";
            $results .=  chr($result);
        }

        $base64 = base64_encode(hash('sha256', $results, true));

        return $base64;
    }




