# Compiler and Archiver
CC = gcc
AR = ar

# Flags
CFLAGS = -W -Wall -Wunused -Iinclude -static -g
# CFLAGS = -W -Wall -Wunused -Iinclude -O2 -static -g
CLIBS = -L$(BUILD_DIR) -lph7
ARFLAGS = rcs

PH7_ENABLE_MATH_FUNC ?= 1
ifeq ($(PH7_ENABLE_MATH_FUNC),1)
	CFLAGS += -DPH7_ENABLE_MATH_FUNC=1
	CLIBS += -lm
endif

# Directories
SRC_DIR = src
BUILD_DIR = build
LIB_DIR = lib

# Source files
LIB_SRC = $(wildcard $(LIB_DIR)/*.c)
EXEC_SRC = $(SRC_DIR)/ph7.c

# Object files
LIB_OBJ = $(patsubst %.c, $(BUILD_DIR)/%.o, $(notdir $(LIB_SRC)))
CLI_EXEC_OBJ = $(BUILD_DIR)/ph7.o
CGI_EXEC_OBJ = $(BUILD_DIR)/ph7-cgi.o

# Targets
TARGET_LIB = libph7.a
TARGET_CLI = ph7
TARGET_CGI = ph7-cgi

# Default target
all: $(BUILD_DIR) lib cli cgi

lib: $(BUILD_DIR) $(BUILD_DIR)/$(TARGET_LIB)

cli: $(BUILD_DIR) $(BUILD_DIR)/$(TARGET_CLI)

cgi: $(BUILD_DIR) $(BUILD_DIR)/$(TARGET_CGI)

$(BUILD_DIR):
	mkdir -p $(BUILD_DIR)

# Build static library
$(BUILD_DIR)/$(TARGET_LIB): $(LIB_OBJ)
	$(AR) $(ARFLAGS) $@ $^

# Build CLI executable
$(BUILD_DIR)/$(TARGET_CLI): $(CLI_EXEC_OBJ) $(BUILD_DIR)/$(TARGET_LIB)
	$(CC) $(CFLAGS) -o $@ $(CLI_EXEC_OBJ) $(CLIBS)

# Build CGI executable
$(BUILD_DIR)/$(TARGET_CGI): $(CGI_EXEC_OBJ) $(BUILD_DIR)/$(TARGET_LIB)
	$(CC) $(CFLAGS) -o $@ $(CGI_EXEC_OBJ) $(CLIBS)

$(BUILD_DIR)/%.o: $(LIB_DIR)/%.c
	$(CC) $(CFLAGS) -c $< -o $@

$(CLI_EXEC_OBJ): $(EXEC_SRC)
	$(CC) $(CFLAGS) -c $< -o $@

$(CGI_EXEC_OBJ): $(EXEC_SRC)
	$(CC) $(CFLAGS) -DPH7_ENABLE_CGI=1 -c $< -o $@

# Clean build directory
clean:
	rm -rf $(BUILD_DIR)

# Phony targets
.PHONY: all clean
