<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\ScoresheetImport;
use App\Imports\StudentsImport;

class ImportExcel extends Command
{
    protected $signature = 'import:excel';

    protected $description = 'Laravel Excel importer';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->output->title('Starting import');
        (new StudentsImport)->withOutput($this->output)->import('users.xlsx');
        $this->output->success('Import successful');
    }
}
