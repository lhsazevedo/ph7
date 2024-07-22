# Compiler and Archiver
CC = gcc
AR = ar

# Flags
CFLAGS = -W -Wall -Wunused -Iinclude
ARFLAGS = rcs
PH7_MATH_FLAG = -DPH7_ENABLE_MATH_FUNC=1

# Directories
SRC_DIR = src
BUILD_DIR = build
LIB_DIR = lib

# Source files
LIB_SRC = $(wildcard $(LIB_DIR)/*.c)
EXEC_SRC = $(SRC_DIR)/ph7.c

# Object files
LIB_OBJ = $(patsubst %.c, $(BUILD_DIR)/%.o, $(notdir $(LIB_SRC)))
EXEC_OBJ = $(BUILD_DIR)/ph7.o

# Targets
TARGET_LIB = libph7.a
TARGET_EXEC = ph7

# Default target
all: $(BUILD_DIR) lib exec

lib: $(BUILD_DIR) $(BUILD_DIR)/$(TARGET_LIB)

exec: $(BUILD_DIR) $(BUILD_DIR)/$(TARGET_EXEC)


$(BUILD_DIR):
	mkdir -p $(BUILD_DIR)

# Build static library
$(BUILD_DIR)/$(TARGET_LIB): $(LIB_OBJ)
	$(AR) $(ARFLAGS) $@ $^

# Build executable
$(BUILD_DIR)/$(TARGET_EXEC): $(EXEC_OBJ) $(BUILD_DIR)/$(TARGET_LIB)
ifeq ($(PH7_ENABLE_MATH_FUNC),0)
	$(CC) $(CFLAGS) -o $@ $^
else
	$(CC) $(CFLAGS) $(PH7_MATH_FLAG) -o $@ $^ -lm
endif

$(BUILD_DIR)/%.o: $(LIB_DIR)/%.c
	$(CC) $(CFLAGS) -c $< -o $@

$(EXEC_OBJ): $(EXEC_SRC)
	$(CC) $(CFLAGS) -c $< -o $@

# Clean build directory
clean:
	rm -rf $(BUILD_DIR)

# Phony targets
.PHONY: all clean
