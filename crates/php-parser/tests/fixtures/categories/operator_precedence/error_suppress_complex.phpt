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
                      "end": 11
                    }
                  },
                  "method": {
                    "kind": {
                      "Identifier": "method"
                    },
                    "span": {
                      "start": 13,
                      "end": 19
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 7,
                "end": 21
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
