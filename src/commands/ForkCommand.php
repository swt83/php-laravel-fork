<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ForkCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'fork';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run a process in the background.';

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
    public function fire()
    {
        // capture
        $closure = $this->argument('closure');

        // run
        Travis\Fork::pickup($closure);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('closure', InputArgument::REQUIRED, 'The code to be run in background.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array();
    }

}