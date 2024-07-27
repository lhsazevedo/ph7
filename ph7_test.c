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