===source===
<?php Foo::class; self::class; static::class;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 6,
                  "end": 9,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "member": "class"
            }
          },
          "span": {
            "start": 6,
            "end": 16,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Identifier": "self"
                },
                "span": {
                  "start": 18,
                  "end": 22,
                  "start_line": 1,
                  "start_col": 18
                }
              },
              "member": "class"
            }
          },
          "span": {
            "start": 18,
            "end": 29,
            "start_line": 1,
            "start_col": 18
          }
        }
      },
      "span": {
        "start": 18,
        "end": 31,
        "start_line": 1,
        "start_col": 18
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
                  "start": 31,
                  "end": 37,
                  "start_line": 1,
                  "start_col": 31
                }
              },
              "member": "class"
            }
          },
          "span": {
            "start": 31,
            "end": 44,
            "start_line": 1,
            "start_col": 31
          }
        }
      },
      "span": {
        "start": 31,
        "end": 45,
        "start_line": 1,
        "start_col": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45,
    "start_line": 1,
    "start_col": 0
  }
}
