===source===
<?php $class::$method();
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
                  "StaticPropertyAccess": {
                    "class": {
                      "kind": {
                        "Variable": "class"
                      },
                      "span": {
                        "start": 6,
                        "end": 12,
                        "start_line": 1,
                        "start_col": 6
                      }
                    },
                    "member": "method"
                  }
                },
                "span": {
                  "start": 6,
                  "end": 21,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 23,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24,
    "start_line": 1,
    "start_col": 0
  }
}
