===source===
<?php clone $obj->getPrototype();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Clone": {
              "kind": {
                "MethodCall": {
                  "object": {
                    "kind": {
                      "Variable": "obj"
                    },
                    "span": {
                      "start": 12,
                      "end": 16,
                      "start_line": 1,
                      "start_col": 12
                    }
                  },
                  "method": {
                    "kind": {
                      "Identifier": "getPrototype"
                    },
                    "span": {
                      "start": 18,
                      "end": 30,
                      "start_line": 1,
                      "start_col": 18
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 12,
                "end": 32,
                "start_line": 1,
                "start_col": 12
              }
            }
          },
          "span": {
            "start": 6,
            "end": 32,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 33,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33,
    "start_line": 1,
    "start_col": 0
  }
}
