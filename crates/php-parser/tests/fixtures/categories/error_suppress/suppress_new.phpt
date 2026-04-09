===source===
<?php @(new Foo())->init();
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
                      "Parenthesized": {
                        "kind": {
                          "New": {
                            "class": {
                              "kind": {
                                "Identifier": "Foo"
                              },
                              "span": {
                                "start": 12,
                                "end": 15,
                                "start_line": 1,
                                "start_col": 12
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 8,
                          "end": 17,
                          "start_line": 1,
                          "start_col": 8
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 18,
                      "start_line": 1,
                      "start_col": 7
                    }
                  },
                  "method": {
                    "kind": {
                      "Identifier": "init"
                    },
                    "span": {
                      "start": 20,
                      "end": 24,
                      "start_line": 1,
                      "start_col": 20
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 7,
                "end": 26,
                "start_line": 1,
                "start_col": 7
              }
            }
          },
          "span": {
            "start": 6,
            "end": 26,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27,
    "start_line": 1,
    "start_col": 0
  }
}
