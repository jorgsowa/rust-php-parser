===source===
<?php
static::$prop;
static::method();
static::class;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "Identifier": "static"
                },
                "span": {
                  "start": 6,
                  "end": 12,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "member": "prop"
            }
          },
          "span": {
            "start": 6,
            "end": 19,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "static"
                },
                "span": {
                  "start": 21,
                  "end": 27,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "method": "method",
              "args": []
            }
          },
          "span": {
            "start": 21,
            "end": 37,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 21,
        "end": 39,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Identifier": "static"
                },
                "span": {
                  "start": 39,
                  "end": 45,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "member": "class"
            }
          },
          "span": {
            "start": 39,
            "end": 52,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 39,
        "end": 53,
        "start_line": 4,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53,
    "start_line": 1,
    "start_col": 0
  }
}
