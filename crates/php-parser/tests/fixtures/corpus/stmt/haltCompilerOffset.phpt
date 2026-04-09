===source===
<?php

var_dump(__HALT_COMPILER_OFFSET__);
__halt_compiler();
Foo
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "var_dump"
                },
                "span": {
                  "start": 7,
                  "end": 15,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Identifier": "__HALT_COMPILER_OFFSET__"
                    },
                    "span": {
                      "start": 16,
                      "end": 40,
                      "start_line": 3,
                      "start_col": 9
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 16,
                    "end": 40,
                    "start_line": 3,
                    "start_col": 9
                  }
                }
              ]
            }
          },
          "span": {
            "start": 7,
            "end": 41,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 43,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "HaltCompiler": "Foo"
      },
      "span": {
        "start": 43,
        "end": 65,
        "start_line": 4,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 65,
    "start_line": 1,
    "start_col": 0
  }
}
