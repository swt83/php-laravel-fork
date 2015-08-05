<?php

namespace Travis;

use SuperClosure\Serializer;

class Fork {

    /**
     * Run the passed closure via command line.
     *
     * @param   function    $closure
     * @return  void
     */
    public static function run($closure)
    {
        // serializer
        $serializer = new Serializer();

        // serialize
        $serialized = $serializer->serialize($closure);

        // pack
        $packed = base64_encode(serialize($serialized));

        // environment
        $environment = \App::environment();

        // command
        $command = 'php '.base_path().'/artisan fork '.$packed.' --env='.$environment.' > /dev/null 2>&1 &';

        // execute
        exec($command);
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
        // serializer
        $serializer = new Serializer();

        // unpack
        $unpacked = unserialize(base64_decode($closure));

        // unserialize
        $unserialized = $serializer->unserialize($unpacked);

        // process
        $unserialized();
    }

}
