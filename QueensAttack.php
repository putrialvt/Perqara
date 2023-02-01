<?php

/*
 * Complete the 'queensAttack' function below.
 *
 * The function is expected to return an INTEGER.
 * The function accepts following parameters:
 *  1. INTEGER n
 *  2. INTEGER k
 *  3. INTEGER r_q
 *  4. INTEGER c_q
 *  5. 2D_INTEGER_ARRAY obstacles
 */

function queensAttack($boardSize, $k, $queenx, $queeny, $obstacles) {

        $top = $queeny - 1;
        $left= $queenx - 1;
        $right = $boardSize - $queenx;
        $bottom = $boardSize - $queeny;

        $topLeft = min([$top, $left]);
        $topRight = min([$top, $right]);
        $bottomRight = min([$bottom, $right]);   
        $bottomLeft = min([$bottom, $left]);
        $answer = 0;

        foreach($obstacles as $obstacle){
            $obstaclex= $obstacle[0];
            $obstacley= $obstacle[1];    
            
            if($obstaclex == $queenx && $obstacley < $queeny) {
                $top = min([$top, ($queeny - $obstacley - 1)]);
            }

            if($obstacley == $queeny && $obstaclex > $queenx) {
                $right = min([$right, ($obstaclex - $queenx - 1)]);
            }

            if($obstaclex == $queenx && $obstacley > $queeny) {
                $bottom = min([$bottom, ($obstacley - $queeny - 1)]);
            }

            if($obstacley == $queeny && $obstaclex < $queenx) {
                $left = min([$left, ($queenx - $obstaclex - 1)]);
            }

            if($obstaclex < $queenx && $obstacley < $queeny && $queenx-$obstaclex == $queeny-$obstacley) {
                $topLeft= min([$topLeft, ($queenx - $obstaclex - 1)]);
            }

            if($obstaclex > $queenx && $queeny > $obstacley && abs($queenx-$obstaclex) == abs($queeny - $obstacley)) {
                $topRight = min([$topRight, ($obstaclex - $queenx - 1)]);
            }

            if ($obstaclex > $queenx && $queeny < $obstacley && $obstaclex-$queenx==$obstacley - $queeny) {
                $bottomRight = min([$bottomRight, ($obstaclex - $queenx - 1)]);
            }

            if($queenx > $obstaclex && $queeny < $obstacley && $queenx - $obstaclex == $obstacley - $queeny) {
                $bottomLeft = min([$bottomLeft, ($queenx - $obstaclex - 1)]);
            }
        }
        
        $answer = $top + $bottom + $left + $right + $topLeft + $topRight + $bottomLeft + $bottomRight;
        return $answer; 
    }

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$first_multiple_input = explode(' ', rtrim(fgets(STDIN)));

$n = intval($first_multiple_input[0]);

$k = intval($first_multiple_input[1]);

$second_multiple_input = explode(' ', rtrim(fgets(STDIN)));

$r_q = intval($second_multiple_input[0]);

$c_q = intval($second_multiple_input[1]);

$obstacles = array();

for ($i = 0; $i < $k; $i++) {
    $obstacles_temp = rtrim(fgets(STDIN));

    $obstacles[] = array_map('intval', preg_split('/ /', $obstacles_temp, -1, PREG_SPLIT_NO_EMPTY));
}

$result = queensAttack($n, $k, $r_q, $c_q, $obstacles);

fwrite($fptr, $result . "\n");

fclose($fptr);

