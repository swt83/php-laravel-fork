<?php

namespace Travis;

class Fork {

    /**
     * Run the passed closure via command line.
     *
     * @param   function    $closure
     * @return  void
     */
    public static function run($closure)
    {
        // prep
        $closure = new \Illuminate\Support\SerializableClosure($closure);

        // pack
        $serialized = base64_encode(serialize($closure));

        // environment
        $environment = \App::environment();

        // pass
        exec('php '.base_path().'/artisan fork '.$serialized.' --env='.$environment.' > /dev/null 2>&1 &');
    }

    /**
     * Run the passed closure synchronously for testing purposes.
     *
     * @param   function    $closure
     * @return  void
     */
    public static function test($closure)
    {
        // process
        $closure();
    }

    /**
     * Run the passed closure as received via command line.
     *
     * @param   function    $closure
     * @return  void
     */
    public static function pickup($closure)
    {
        // unpack
        $unserialized = unserialize(base64_decode($closure));

        // process
        $unserialized();
    }

}