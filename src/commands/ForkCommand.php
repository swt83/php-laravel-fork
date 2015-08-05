<?php

namespace Travis\Fork\Commands;

use Illuminate\Console\Command;

class ForkCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'fork {closure}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fork a process using serialized functions.';

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
     * @return void
     */
    public function handle()
    {
        // capture
        $closure = $this->argument('closure');

        // run
        \Travis\Fork::pickup($closure);
    }

}
