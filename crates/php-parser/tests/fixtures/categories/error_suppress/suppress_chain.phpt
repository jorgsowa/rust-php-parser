===source===
<?php @$a->b()->c;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ErrorSuppress": {
              "kind": {
                "PropertyAccess": {
                  "object": {
                    "kind": {
                      "MethodCall": {
                        "object": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 7,
                            "end": 9
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "b"
                          },
                          "span": {
                            "start": 11,
                            "end": 12
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 14
                    }
                  },
                  "property": {
                    "kind": {
                      "Identifier": "c"
                    },
                    "span": {
                      "start": 16,
                      "end": 17
                    }
                  }
                }
              },
              "span": {
                "start": 7,
                "end": 17
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
