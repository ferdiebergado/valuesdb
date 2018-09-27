<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class DivisionsTableSeeder extends CsvSeeder
{

    public function __construct()
    {
        $this->table = 'divisions';
        $this->filename = base_path() . '/database/seeds/csv/divisions-values.csv';
    }

    public function run()
    {
        // Recommended when importing larger CSVs
        DB::disableQueryLog();

        // Uncomment the below to wipe the table clean before populating
        // DB::table($this->table)->truncate();

        parent::run();
    }
}
