// TODO find a way to define this relative to the location of this file
#define FFI_LIB "./resources/ffi/blurhash/encode.o"

#ifndef __BLURHASH_ENCODE_H__
#define __BLURHASH_ENCODE_H__

#include <stdint.h>
#include <stdlib.h>

const char *blurHashForPixels(int xComponents, int yComponents, int width, int height, uint8_t *rgb, size_t bytesPerRow);

#endif
