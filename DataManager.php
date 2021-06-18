<?php
class DataManager
{
    private $file_name = 'data.json';
    private $table = ['table' => [], 'count' => 0];
    private $count = 0;

    public function __construct() {
        if (file_exists($this->file_name)) {
            $content = file_get_contents($this->file_name);
            $data = json_decode($content, true);
            if (is_array($data)) {
                $this->table = $data['table'];
                $this->count = $data['count'];
            }
        }
    }

    public function &getTable() {
        return $this->table;
    }

    public function getAmount() {
        return $this->count;
    }

    /**
     * Adds new entry to data.json storage
     * 
     * @param integer $rid
     * @param integer $value
     */
    public function addEntry($rid, $entry) {
        foreach ($entry as $key => $value) {
            if (array_key_exists($rid, $this->table) && array_key_exists($key, $this->table[$rid])) {
                return;
            }

            $this->table[$rid][$key] = $value;
            $data = json_encode(
                [
                    "table" => $this->table,
                    "count" => ++$this->count
                ]
            , JSON_PRETTY_PRINT);
            file_put_contents($this->file_name, $data);
        }
    }

    public function reset() {
        file_put_contents('data.json', '{"table": [], "count": 0}');
        $this->table = ['table' => [], 'count' => 0];
        $this->count = 0;
    }

}