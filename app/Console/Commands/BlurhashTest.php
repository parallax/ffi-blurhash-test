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
        $blurhash = FFI::load(resource_path('ffi/blurhash/encode.h'));

        $imagePath = resource_path('img/pic1.png');
        $image = imagecreatefrompng($imagePath);
        [$imageWidth, $imageHeight] = getimagesize($imagePath);

        $imageData = [];
        for ($y = 0; $y < $imageHeight; $y++) {
            for ($x = 0; $x < $imageWidth; $x++) {
                $colour = imagecolorat($image, $x, $y);
                ['red' => $red, 'green' => $green, 'blue' => $blue] = imagecolorsforindex($image, $colour);
                $imageData[] = $red;
                $imageData[] = $green;
                $imageData[] = $blue;
            }
        }

        $imageDataSize = count($imageData);
        $cData = FFI::new("uint8_t[{$imageDataSize}]");
        FFI::memcpy($cData, pack('C*', ...$imageData), $imageDataSize);

        $res = $blurhash->blurHashForPixels(
            4,
            3,
            $imageWidth,
            $imageHeight,
            $cData,
            3 * $imageWidth,
        );

        $this->info('Blurhash:');
        $this->line($res);

        return 0;
    }
}
