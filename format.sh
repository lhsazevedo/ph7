#!/bin/bash

# clang-format -i src/*.c lib/*.c include/*.h
uncrustify -c .uncrustify.cfg --no-backup lib/*.c include/*.h src/*.c
