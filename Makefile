CC = gcc
AR = ar
CFLAGS = -W -Wall -Wunused
ARFLAGS = rcs

SRC = api.c \
    builtin.c \
    compile.c \
    constant.c \
    hashmap.c \
    lex.c \
    lib.c \
    memobj.c \
    oo.c \
    parse.c \
    vfs.c \
    vm.c

OBJ = $(SRC:.c=.o)

TARGET_LIB = libph7.a

BUILD_DIR = build

all: $(BUILD_DIR) $(TARGET_LIB)

$(BUILD_DIR):
	mkdir -p $(BUILD_DIR)

$(TARGET_LIB): $(OBJ)
	$(AR) $(ARFLAGS) $(BUILD_DIR)/$(TARGET_LIB) $(addprefix $(BUILD_DIR)/, $(notdir $(OBJ)))

%.o: %.c
	$(CC) $(CFLAGS) -c $< -o $(BUILD_DIR)/$@

clean:
	rm -rf $(BUILD_DIR)

.PHONY: all clean
