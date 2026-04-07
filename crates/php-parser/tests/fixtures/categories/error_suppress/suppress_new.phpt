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
                                "end": 15
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 8,
                          "end": 17
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 18
                    }
                  },
                  "method": {
                    "kind": {
                      "Identifier": "init"
                    },
                    "span": {
                      "start": 20,
                      "end": 24
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 7,
                "end": 26
              }
            }
          },
          "span": {
            "start": 6,
            "end": 26
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}
