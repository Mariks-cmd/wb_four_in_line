<?php
class Referee {
    private $table = [];
    private $count = 0;

    public function __construct($table) {
        $this->table = $table;
    }

    private function check($rid, $cid, $y_diff, $x_diff) {
        $table = $this->table;
        $symbol = $table[$rid][$cid];

        $x_change = $x_diff;
        $y_change = $y_diff;
        for ($i = 1; $i <= 3; $i++) {
            if (@$table[$rid + $y_change][$cid + $x_change] == $symbol) {
                $this->count++;
                if ($this->count >= 3) {
                    return true;
                }
            }
            else {
                return false;
            }

            $x_change += $x_diff;
            $y_change += $y_diff;
        }
    }

    public function hasWinner(int $r, int $c) {
        $diffs = [
            [[0,1], [0,-1]],
            [[1,0]],
            [[1,1],[-1,-1]],
            [[-1,1],[1,-1]]
        ];
        foreach ($diffs as $line) {
            foreach ($line as $check) {
                if ($this->check($r, $c, $check[0], $check[1])) {
                    echo $this->table[$r][$c] . " won the game!";
                    return $this;
                }
            }
            $this->count = 0;
        }

        return $this;
    }

    public function message() {
        echo PHP_EOL . "Message is called!";
        return $this;
    }


}