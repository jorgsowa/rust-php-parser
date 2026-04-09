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
                            "end": 9,
                            "start_line": 1,
                            "start_col": 7
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "b"
                          },
                          "span": {
                            "start": 11,
                            "end": 12,
                            "start_line": 1,
                            "start_col": 11
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 14,
                      "start_line": 1,
                      "start_col": 7
                    }
                  },
                  "property": {
                    "kind": {
                      "Identifier": "c"
                    },
                    "span": {
                      "start": 16,
                      "end": 17,
                      "start_line": 1,
                      "start_col": 16
                    }
                  }
                }
              },
              "span": {
                "start": 7,
                "end": 17,
                "start_line": 1,
                "start_col": 7
              }
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
