<?php

/*
 * Complete the 'activityNotifications' function below.
 *
 * The function is expected to return an INTEGER.
 * The function accepts following parameters:
 *  1. INTEGER_ARRAY expenditure
 *  2. INTEGER d
 */
 
function getMedian($d, $array)
{
    $order = 0;
    $first = 0;
    $second = 0;
    $total = 0;
    
    if($d%2 == 0){
        $order = [$d/2, $d/2+1];
    }else{
        $order = (int)($d/2+0.5);
    }

    foreach ($array as $key => $value) {
        if($value != 0){
            $total = $total+$value;
            if(is_array($order)){
                if($first == 0 && $total>=$order[0]){
                    $first = $key;
                }
                if($first != 0 && $second == 0 && $total>=$order[1]){
                    $second = $key;
                }
                if($first != 0 && $second != 0){
                    return ($first+$second)/2;
                }
            }else{
                if($total >= $order){
                    return $key;
                }
            }
        }
    }
}
// Complete the activityNotifications function below.
function activityNotifications($expenditure, $d)
{
    $count = count($expenditure);
    $result = 0;
    $array = [];
    for ($i=0; $i <= 200; $i++) { 
        $array[$i] = 0;
    }
    for ($i=0; $i < $d; $i++) {
        $array[$expenditure[$i]]++;
    }
    for ($i=$d; $i < $count; $i++) { 
        $median = getMedian($d, $array);
        if($expenditure[$i] >= $median*2){
            $result++;
        }
        $array[$expenditure[$i-$d]]--;
        $array[$expenditure[$i]]++;
    }
    return $result;
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$first_multiple_input = explode(' ', rtrim(fgets(STDIN)));

$n = intval($first_multiple_input[0]);

$d = intval($first_multiple_input[1]);

$expenditure_temp = rtrim(fgets(STDIN));

$expenditure = array_map('intval', preg_split('/ /', $expenditure_temp, -1, PREG_SPLIT_NO_EMPTY));

$result = activityNotifications($expenditure, $d);

fwrite($fptr, $result . "\n");

fclose($fptr);

