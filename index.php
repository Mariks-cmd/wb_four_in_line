<!doctype html>
<link rel="stylesheet" href="style.css">
<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include 'DataManager.php';
    $data_manager = new DataManager();

    if (array_key_exists('rid', $_GET) && array_key_exists('cid', $_GET)) {
        $table = &$data_manager->getTable();
        $r = $_GET['rid'];
        $c = $_GET['cid'];
        if ($r == 10 || @$table[$r+1][$c] != '') {
            $amount = $data_manager->getAmount();
            $symbol = ($amount % 2 == 0) ? 'x' : 'o';
            $data_manager->addEntry($r, [$c => $symbol]);

            include 'Referee.php';
            (new Referee($table))->hasWinner($r, $c)->message();
        }
    }
    elseif (array_key_exists('action', $_GET) && $_GET['action'] == 'reset') {
        $data_manager->reset();
    }

?>
<div id="app">
    <div class="container">
        <?php
        for ($rid = 1; $rid <= 10; $rid++) {
            for ($cid = 1; $cid <= 10; $cid++) {
                echo "<a href='?rid=$rid&cid=$cid'>" . @$table[$rid][$cid] . "</a>";
            }
        }
        ?>
    </div>

    <a href="?action=reset" class="btn">Reset</a>
</div>