<?php
function console_style($text,$color=null,$bg=null,$fontSize=55){
    $fontSizeCode = "\e[{$fontSize}m";

    // Get the terminal width
    $terminalWidth = exec('tput cols');

    // Calculate the padding on each side to center the text
    $padding = str_repeat(' ', floor(($terminalWidth - strlen($text)) / 2));

    $formattedText = "\e[1m" . $fontSizeCode . $padding . $text . $padding . "\e[0m";

 echo $color.$formattedText.$bg."\n";

}


do{
$text = date("d-M-Y h:i:s a");
console_style($text,"\e[38;5;231m","\e[48;5;196m",500);
sleep(1);
system("clear");
}while(true);


