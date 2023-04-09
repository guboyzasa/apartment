<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\StoreClear;
use Carbon\Carbon;
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
    protected $description = 'Command Update Active Material Mount 4 at 23:59';

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
        $now = Carbon::now();
        $start = Carbon::createFromTime(22, 0);
        $end = Carbon::createFromTime(23, 0);

        if ($now->between($start, $end)) {

        DB::beginTransaction();
        $isActive = StoreClear::where('is_active', 1)->update(['is_active' => 0]);
        DB::commit();
        
        }
        return Command::SUCCESS;
    }
}
