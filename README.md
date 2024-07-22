# PH7, Un-amalgamated

Fork of [PH7](https://github.com/symisc/PH7), split into separate files for easier study and modification.

## About

PH7 is a fast, embeddable PHP engine written in C, supporting PHP 5.3 features and extensive built-in functionality.

## Features

- **Embeddable**: Integrate PHP into C/C++ applications.
- **PHP 5.3 Support**: Includes modern PHP constructs and syntax.
- **Thread-Safe**: ANSI C compliant, suitable for various platforms.
- **Rich Functionality**: Over 470 built-in functions.

For more details, visit the original [PH7 repository](https://github.com/symisc/PH7).

## Quick Start

Example usage:

```c
// ph7_test.c

#include <stdio.h>
#include "ph7.h"

#define PHP_PROG "<?php echo 'Hello World'; ?>"

static int output_consumer(const void *output, unsigned int len, void *data) {
    printf("%.*s", len, (const char *)output);
    return PH7_OK;
}

int main(void) {
    ph7 *engine;
    ph7_vm *vm;

    ph7_init(&engine);

    ph7_compile_v2(engine, PHP_PROG, -1, &vm, 0);

    ph7_vm_config(vm, PH7_VM_CONFIG_OUTPUT, output_consumer, 0);
    ph7_vm_exec(vm, 0);

    ph7_vm_release(vm);
    ph7_release(engine);
    return 0;
}
```

Compile with:
```sh
make
gcc -o ph7_test ph7_test.c -Lbuild -lph7
```

And run:
```sh
./ph7_test
# Hello World
```

See the `examples` directory for more usage examples.

## Contributing
Fork, improve, and submit pull requests. Contributions are welcome!

