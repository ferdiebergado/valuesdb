<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class RegionsDivisionsTableSeeder extends CsvSeeder
{

    public function __construct()
    {
        $this->table = 'regions_divisions';
        $this->filename = base_path() . '/database/seeds/csv/regions-divisions-values.csv';
        // $this->insert_chunk_size = 100;
        // $this->should_trim = true;
    }

    public function run()
    {
        // Recommended when importing larger CSVs
        DB::disableQueryLog();

        // Uncomment the below to wipe the table clean before populating
        DB::table($this->table)->truncate();

        parent::run();
    }
}
