===source===
<?php @$obj->method();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ErrorSuppress": {
              "kind": {
                "MethodCall": {
                  "object": {
                    "kind": {
                      "Variable": "obj"
                    },
                    "span": {
                      "start": 7,
                      "end": 11,
                      "start_line": 1,
                      "start_col": 7
                    }
                  },
                  "method": {
                    "kind": {
                      "Identifier": "method"
                    },
                    "span": {
                      "start": 13,
                      "end": 19,
                      "start_line": 1,
                      "start_col": 13
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 7,
                "end": 21,
                "start_line": 1,
                "start_col": 7
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22,
    "start_line": 1,
    "start_col": 0
  }
}
