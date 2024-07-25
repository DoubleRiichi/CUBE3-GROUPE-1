<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class RunHuggingFaceApi extends Command
{
    protected $signature = 'huggingface:run';
    protected $description = 'Run Hugging Face API script';

    public function handle()
    {
        // Remplacez par le chemin absolu correct de votre script Python
        $scriptPath = base_path('python_scripts/huggingface_api.py');

        $process = new Process(['python', $scriptPath]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $this->info($process->getOutput());
    }
}
