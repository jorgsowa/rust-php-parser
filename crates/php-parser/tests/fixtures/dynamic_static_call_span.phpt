===source===
<?php Foo::{$m}();
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
                  "ClassConstAccessDynamic": {
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
                    "member": {
                      "kind": {
                        "Variable": "m"
                      },
                      "span": {
                        "start": 12,
                        "end": 14,
                        "start_line": 1,
                        "start_col": 12
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 17,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 17,
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
    }
  ],
  "span": {
    "start": 0,
    "end": 18,
    "start_line": 1,
    "start_col": 0
  }
}
