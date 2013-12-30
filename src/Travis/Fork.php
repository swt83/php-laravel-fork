<?php

namespace Travis;

use \Illuminate\Support\SerializableClosure;

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
        $closure = new SerializableClosure($closure);

        // pack
        $serialized = base64_encode(serialize($closure));

        // pass
        exec('php '.base_path().'/artisan fork '.$serialized.' > /dev/null 2>&1 &');
    }

    /**
     * Run the passed closure via command line, but synchronously for testing purposes.
     *
     * @param   function    $closure
     * @return  void
     */
    public static function test($closure)
    {
        // prep
        $closure = new SerializableClosure($closure);

        // pack
        $serialized = base64_encode(serialize($closure));

        // pass
        passthru('php '.base_path().'/artisan fork '.$serialized);
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