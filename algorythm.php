<?php

//generateTicketRow();


if($argv[1] === 'game'){

    startGame();
}

function startGame(){
    $excluded = [];
    $stage = 0;

    do{
        $winning_number = generateCell(1, 99, $excluded);
        if($winning_number === 1) echo ('23132131231');
        array_push( $excluded,$winning_number);
        $stage++;
    }while($stage <= 90);

    //TODO: first 5 elements of winner??

    $all_numbers = range(1,99);

    foreach ($excluded as $exclude_value){
        unset($all_numbers[$exclude_value]);
    }

    print_r($all_numbers);exit;

}

function generateCell($min, $max, $excluded = false){

    do{
        $n = mt_rand($min,$max);

    } while(in_array($n, $excluded));

    return $n;
}

function generateTicketRow()
{
    $excluded_numbers = [];

    $rowNumber = 1;

    $ticket = [];

    while ($rowNumber <= 6){

        $i=1;
        $min = 1;
        $max = 9;
        do{
            $ticketRow[$i] = generateCell($min, $max, $excluded_numbers);
            $i++;
            $min = $max+1;
            $max +=10 ;

        }while($i<10);


        $excluded_cell = [];
        $unset_array = [];


        for ($i = 0; $i <= 3; $i++) {
            do{

                $unset_cell = generateCell(1, 9, $excluded_cell);

            }while(in_array($unset_cell, $excluded_cell));

                $unset_array[] = $unset_cell;
                $excluded_cell[] = $unset_cell;
        }

        foreach ($unset_array as $unset_item) {
//            unset($ticketRow[$unset_item]);
            $ticketRow[$unset_item] = '0';
        }

        $excluded_numbers = array_merge(array_values($ticketRow), $excluded_numbers);

        echo '--------------------------------------------'. PHP_EOL;
        if(in_array($rowNumber, ['4', '1'])){
            echo '============================================='. PHP_EOL;
        }
        echo $ticketRow[1] . '  |' . $ticketRow[2] . '  |'. $ticketRow[3] . '  |'. $ticketRow[4] . '  |'. $ticketRow[5] . '  |'
            . $ticketRow[6] . '  |'. $ticketRow[7] . '  |' . $ticketRow[8] . '  |'. $ticketRow[9] . '  |' . PHP_EOL;

        $ticket[$rowNumber] = $ticketRow;


        $rowNumber++;

    }

}





