/*
 * Compile this file together with the ph7 engine source code to generate
 * the simple PH7 interpreter executable. For example: 
 *  gcc -W -Wall -O6 -D PH7_ENABLE_MATH_FUNC -o ph7 ph7_interp.c ph7.c
 */
/*
 * The PH7 interpreter is a simple stand-alone PHP interpreter that allows
 * the user to enter and execute PHP files against a PH7 engine. 
 * To start the ph7 program, just type "ph7" followed by the name of the PHP file
 * to compile and execute. That is, the first argument is to the interpreter, the rest
 * are scripts arguments, press "Enter" and the PHP code will be executed.
 * If something goes wrong while processing the PHP script due to a compile-time error
 * your error output (STDOUT) should display the compile-time error messages.
 *
 * Usage example of the ph7 interpreter:
 *   ph7 scripts/hello_world.php
 * Running the interpreter with script arguments
 *    ph7 scripts/mp3_tag.php /usr/local/path/to/my_mp3s
 *
 * The PH7 interpreter package includes more than 70 PHP scripts to test ranging from
 * simple hello world programs to XML processing, ZIP archive extracting, MP3 tag extracting, 
 * UUID generation, JSON encoding/decoding, INI processing, Base32 encoding/decoding and many
 * more. These scripts are available in the scripts directory from the zip archive.
 */
/* $SymiscID: ph7_interp.c v1.7.4 Win7 2012-10-06 03:22 stable <devel@symisc.net> $ */
/* Make sure you have the latest release of the PH7 engine
 * from:
 *  http://ph7.symisc.net/downloads.html
 */
#include <stdio.h>
#include <stdlib.h>
/* Make sure this header file is available.*/
#include "ph7.h"
/* 
 * Display an error message and exit.
 */
static void Fatal(const char *zMsg)
{
    puts(zMsg);
    /* Shutdown the library */
    ph7_lib_shutdown();
    /* Exit immediately */
    exit(0);
}
/*
 * Banner.
 */
static const char zBanner[] = {
    "============================================================\n"
    "Simple PH7 Interpreter                                      \n"
    "                                      http://ph7.symisc.net/\n"
    "============================================================\n"
};
/*
 * Display the banner,a help message and exit.
 */
static void Help(void)
{
    puts(zBanner);
    puts("ph7 [-h|-r|-d] path/to/php_file [script args]");
    puts("\t-d: Dump PH7 byte-code instructions");
    puts("\t-r: Report run-time errors");
    puts("\t-h: Display this message an exit");
    /* Exit immediately */
    exit(0);
}
#ifdef __WINNT__
#include <Windows.h>
#else
/* Assume UNIX */
#include <unistd.h>
#endif
/*
 * The following define is used by the UNIX built and have
 * no particular meaning on windows.
 */
#ifndef STDOUT_FILENO
#define STDOUT_FILENO	1
#endif
/*
 * VM output consumer callback.
 * Each time the virtual machine generates some outputs,the following
 * function gets called by the underlying virtual machine to consume
 * the generated output.
 * All this function does is redirecting the VM output to STDOUT.
 * This function is registered later via a call to ph7_vm_config()
 * with a configuration verb set to: PH7_VM_CONFIG_OUTPUT.
 */
static int Output_Consumer(const void *pOutput,unsigned int nOutputLen,void *pUserData /* Unused */)
{
#ifdef __WINNT__
    BOOL rc;
    rc = WriteFile(GetStdHandle(STD_OUTPUT_HANDLE),pOutput,(DWORD)nOutputLen,0,0);
    if( !rc ){
        /* Abort processing */
        return PH7_ABORT;
    }
#else
    ssize_t nWr;
    nWr = write(STDOUT_FILENO,pOutput,nOutputLen);
    if( nWr < 0 ){
        /* Abort processing */
        return PH7_ABORT;
    }
#endif /* __WINT__ */
    /* All done,VM output was redirected to STDOUT */
    return PH7_OK;
}
/*
 * Main program: Compile and execute the PHP file. 
 */
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "ph7.h"

static int output_consumer(const void *output, unsigned int len, void *data) {
    printf("%.*s\n", len, (const char *)output);
    return PH7_OK;
}

// BEGIN Stolen from PHP

typedef enum {
    body,
    sstring,
    dstring,
    sstring_esc,
    dstring_esc,
    comment_line,
    comment_block,
    heredoc_start,
    heredoc,
    outside,
} php_code_type;

// TODO
#define CG(x) 1

static int cli_is_valid_code(char *code, size_t len, char **prompt) /* {{{ */
{
    int valid_end = 1, last_valid_end;
    int brackets_count = 0;
    int brace_count = 0;
    size_t i;
    php_code_type code_type = body;
    char *heredoc_tag = NULL;
    size_t heredoc_len;

    for (i = 0; i < len; ++i) {
        switch(code_type) {
            default:
                switch(code[i]) {
                    case '{':
                        brackets_count++;
                        valid_end = 0;
                        break;
                    case '}':
                        if (brackets_count > 0) {
                            brackets_count--;
                        }
                        valid_end = brackets_count ? 0 : 1;
                        break;
                    case '(':
                        brace_count++;
                        valid_end = 0;
                        break;
                    case ')':
                        if (brace_count > 0) {
                            brace_count--;
                        }
                        valid_end = 0;
                        break;
                    case ';':
                        valid_end = brace_count == 0 && brackets_count == 0;
                        break;
                    case ' ':
                    case '\r':
                    case '\n':
                    case '\t':
                        break;
                    case '\'':
                        code_type = sstring;
                        break;
                    case '"':
                        code_type = dstring;
                        break;
                    case '#':
                        if (code[i+1] == '[') {
                            valid_end = 0;
                            break;
                        }
                        code_type = comment_line;
                        break;
                    case '/':
                        if (code[i+1] == '/') {
                            i++;
                            code_type = comment_line;
                            break;
                        }
                        if (code[i+1] == '*') {
                            last_valid_end = valid_end;
                            valid_end = 0;
                            code_type = comment_block;
                            i++;
                            break;
                        }
                        valid_end = 0;
                        break;
                    case '?':
                        if (code[i+1] == '>') {
                            i++;
                            code_type = outside;
                            break;
                        }
                        valid_end = 0;
                        break;
                    case '<':
                        valid_end = 0;
                        if (i + 2 < len && code[i+1] == '<' && code[i+2] == '<') {
                            i += 2;
                            code_type = heredoc_start;
                            heredoc_tag = NULL;
                            heredoc_len = 0;
                        }
                        break;
                    default:
                        valid_end = 0;
                        break;
                }
                break;
            case sstring:
                if (code[i] == '\\') {
                    code_type = sstring_esc;
                } else {
                    if (code[i] == '\'') {
                        code_type = body;
                    }
                }
                break;
            case sstring_esc:
                code_type = sstring;
                break;
            case dstring:
                if (code[i] == '\\') {
                    code_type = dstring_esc;
                } else {
                    if (code[i] == '"') {
                        code_type = body;
                    }
                }
                break;
            case dstring_esc:
                code_type = dstring;
                break;
            case comment_line:
                if (code[i] == '\n') {
                    code_type = body;
                }
                break;
            case comment_block:
                if (code[i-1] == '*' && code[i] == '/') {
                    code_type = body;
                    valid_end = last_valid_end;
                }
                break;
            case heredoc_start:
                switch(code[i]) {
                    case ' ':
                    case '\t':
                    case '\'':
                        break;
                    case '\r':
                    case '\n':
                        if (heredoc_tag) {
                            code_type = heredoc;
                        } else {
                            /* Malformed heredoc without label */
                            code_type = body;
                        }
                        break;
                    default:
                        if (!heredoc_tag) {
                            heredoc_tag = code+i;
                        }
                        heredoc_len++;
                        break;
                }
                break;
            case heredoc:
                //ZEND_ASSERT(heredoc_tag);
                if (!strncmp(code + i - heredoc_len + 1, heredoc_tag, heredoc_len)) {
                    unsigned char c = code[i + 1];
                    char *p = code + i - heredoc_len;

                    if ((c >= 'A' && c <= 'Z') || (c >= 'a' && c <= 'z') || (c >= '0' && c <= '9') || c == '_' || c >= 0x80) break;
                    while (*p == ' ' || *p == '\t') p--;
                    if (*p != '\n') break;
                    code_type = body;
                }
                break;
            case outside:
                if ((CG(short_tags) && !strncmp(code+i-1, "<?", 2))
                ||  (i > 3 && !strncmp(code+i-4, "<?php", 5))
                ) {
                    code_type = body;
                }
                break;
        }
    }

    switch (code_type) {
        default:
            if (brace_count) {
                *prompt = "php " "( ";
            } else if (brackets_count) {
                *prompt = "php " "{ ";
            } else {
                *prompt = "php " "> ";
            }
            break;
        case sstring:
        case sstring_esc:
            *prompt = "php " "' ";
            break;
        case dstring:
        case dstring_esc:
            *prompt = "php " "\" ";
            break;
        case comment_block:
            *prompt = "/*  " "> ";
            break;
        case heredoc:
            *prompt = "<<< " "> ";
            break;
        case outside:
            *prompt = "    " "> ";
            break;
    }

    if (!valid_end || brackets_count) {
        return 0;
    } else {
        return 1;
    }
}

// END Stolen from PHP

int main(void) {
    ph7 *engine;
    ph7_vm *vm;
    char code[4096] = {0};
    size_t pos = 0;

    ph7_init(&engine);
    ph7_compile_v2(engine, "", -1, &vm, 0); // Initialize VM
    ph7_vm_config(vm, PH7_VM_CONFIG_OUTPUT, output_consumer, 0);

    static char *prompt = "php > ";

    size_t len = 0;
    while (1) {
        char *line = code + len;

        printf(prompt);
        if (fgets(code + len, sizeof(code) - len, stdin) == NULL) {
            break; // Exit on EOF
        }
        len = strlen(code);

        // printf("line: %s\n", line);
        // printf("code: %s\n", code);

        if (strncmp(line, "exit", 4) == 0) {
            break; // Exit on "exit" command
        }

        if (!cli_is_valid_code(&code, len, &prompt)) {
            //printf("Invalid code...\n");
            continue;
        }

        ph7_vm_eval(vm, 0, &code, strlen(code), len);

        code[0] = '\0';

        // if (ph7_compile_v2(engine, code, -1, &vm, PH7_PHP_ONLY) != PH7_OK) {
        //     fprintf(stderr, "Compilation failed\n");
        //     continue;
        // }

        //ph7_vm_exec(vm, 0);
    }

    ph7_vm_release(vm);
    ph7_release(engine);
    return 0;
}

