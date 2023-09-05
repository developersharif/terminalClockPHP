<?php
function os_platform($callback,$os="WIN"){
    if (strtoupper(substr(PHP_OS, 0, 3)) === $os) {
        $callback();
    }
}
function get_terminal_width() {
    if(strtoupper(substr(PHP_OS, 0, 3)) === "WIN"){
        $output = shell_exec('mode con');
        if (preg_match('/Columns:\s+(\d+)/', $output, $matches)) {
            return (int)$matches[1];
        }
    }elseif(strtoupper(substr(PHP_OS, 0, 3)) === "LIN"){
        return exec('tput cols');
    }
}
function console_style($text,$color=null,$bg=null,$fontSize=55){

    os_platform(function() use ($text,$color,$bg,$fontSize){
        
        $fontSizeCode = "\e[{$fontSize}m";

// Get the terminal width
$terminalWidth = get_terminal_width();

// Calculate the padding on each side to center the text
$padding = str_repeat(' ', floor(($terminalWidth - strlen($text)) / 2));

$formattedText = "\e[1m" . $fontSizeCode . $padding . $text . $padding . "\e[0m";

echo $color.$formattedText.$bg."\n";
    sleep(1);
    echo chr(27).chr(91).'H'.chr(27).chr(91).'J';
    },"WIN");
    os_platform(function() use ($text,$color,$bg,$fontSize) {
        
            // Linux or other Unix-like system
    $fontSizeCode = "\e[{$fontSize}m";

// Get the terminal width
$terminalWidth = get_terminal_width();

// Calculate the padding on each side to center the text
$padding = str_repeat(' ', floor(($terminalWidth - strlen($text)) / 2));

$formattedText = "\e[1m" . $fontSizeCode . $padding . $text . $padding . "\e[0m";

echo $color.$formattedText.$bg."\n";
sleep(1);
system("clear");

    },"LIN");

}

do{
$text = date("d-M-Y h:i:s a");
console_style($text,"\e[38;5;231m","\e[48;5;196m",500);
}while(true);


