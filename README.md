# PH7, Un-amalgamated

Fork of [PH7](https://github.com/symisc/PH7), split into original source files for better readability and maintainability.

> [!NOTE]
> This project is for educational purposes and to provide an accessible version of the PH7 source code, and may not be suitable for production use.

## About

PH7 is a fast, embeddable PHP engine written in C, supporting PHP 5.3 features and extensive built-in functionality.

## Features

- **Embeddable**: Integrate PHP into C/C++ applications.
- **PHP 5.3 Support**: Includes modern PHP constructs and syntax.
- **Thread-Safe**: ANSI C compliant, suitable for various platforms.
- **Rich Functionality**: Over 470 built-in functions.

For more details, visit the original [PH7 repository](https://github.com/symisc/PH7).

## Quick Start

### Building the Executable

The provided Makefile builds the PH7 executable by default, including math functions.

To build the executable:

```sh
make
```

To build the executable without math functions:

```sh
make PH7_ENABLE_MATH_FUNC=0
```

### Running the Executable

After building, you can run the PH7 executable with any PHP script. Here is an example using a test script:

```sh
./build/ph7 script/hello_world.php
# Hello World from PH7
```

### PHP Test Scripts

The `script` directory contains over 70 PHP test scripts. You can run these scripts using the PH7 executable to see various features and functionality in action.

## Using the Library

If you need to integrate PH7 into your C/C++ applications, you can use the PH7 library.

### Building the Static Library

To build the PH7 static library:

```sh
make lib
```

The static library `libph7.a` will be created in the `build` directory.

### Example Usage

Here is an example of using the PH7 library in a C program:

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
gcc -o ph7_test ph7_test.c -Iinclude -Lbuild -lph7
```

And run:
```sh
./ph7_test
# Hello World
```

See the `examples` directory for more usage examples.

## Contributing
Fork, improve, and submit pull requests. Contributions are welcome!
