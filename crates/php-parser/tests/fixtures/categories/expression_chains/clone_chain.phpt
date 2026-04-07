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
                      "end": 16
                    }
                  },
                  "method": {
                    "kind": {
                      "Identifier": "getPrototype"
                    },
                    "span": {
                      "start": 18,
                      "end": 30
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 12,
                "end": 32
              }
            }
          },
          "span": {
            "start": 6,
            "end": 32
          }
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
