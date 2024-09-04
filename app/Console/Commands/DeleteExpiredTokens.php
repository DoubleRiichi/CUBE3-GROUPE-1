<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteExpiredTokens extends Command
{
    protected $signature = 'tokens:delete-expired';
    protected $description = 'Delete expired tokens';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::table('personal_access_tokens')
            ->where('expires_at', '<', now())
            ->delete();
        $this->info('Expired tokens deleted successfully');
    }
}
