<?php

namespace App\Console\Commands;

use FFI;
use Illuminate\Console\Command;

class BlurhashTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blurhash:test';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $blurhash = FFI::load(__DIR__ . '/../../../resources/ffi/blurhash/encode.h');
        // TODO break target image down so blurhash can handle it
        // $blurhash->blurHashForPixels();

        return 0;
    }
}
