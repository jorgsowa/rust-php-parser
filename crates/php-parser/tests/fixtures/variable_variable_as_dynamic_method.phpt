===source===
<?php $obj->{$$method}();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "obj"
                },
                "span": {
                  "start": 6,
                  "end": 10,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "method": {
                "kind": {
                  "VariableVariable": {
                    "kind": {
                      "Variable": "method"
                    },
                    "span": {
                      "start": 14,
                      "end": 21,
                      "start_line": 1,
                      "start_col": 14
                    }
                  }
                },
                "span": {
                  "start": 13,
                  "end": 21,
                  "start_line": 1,
                  "start_col": 13
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 24,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25,
    "start_line": 1,
    "start_col": 0
  }
}
