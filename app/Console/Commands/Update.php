<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\StoreClear;
use Illuminate\Support\Facades\DB;

class Update extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command Update Active Material Mount 5 at 00:02';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle()
    {
        DB::beginTransaction();

        $isActive = StoreClear::where('is_active', 1)->update(['is_active' => 0]);
        
        DB::commit();

        return Command::SUCCESS;
    }
}
