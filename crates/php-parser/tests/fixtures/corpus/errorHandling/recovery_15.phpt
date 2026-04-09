===source===
<?php
Foo::$
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccessDynamic": {
              "class": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 6,
                  "end": 9,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "member": {
                "kind": {
                  "VariableVariable": {
                    "kind": "Error",
                    "span": {
                      "start": 12,
                      "end": 12,
                      "start_line": 0,
                      "start_col": 0
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 12,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 12,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 12,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 12,
    "start_line": 1,
    "start_col": 0
  }
}
