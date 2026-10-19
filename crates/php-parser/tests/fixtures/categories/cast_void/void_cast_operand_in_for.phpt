===config===
min_php=8.5
===source===
<?php
for ((void) f() + 1; ;) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "For": {
          "init": [
            {
              "kind": {
                "Cast": [
                  "Void",
                  {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "FunctionCall": {
                              "name": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "f"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 18,
                                      "end": 19
                                    }
                                  }
                                },
                                "span": {
                                  "start": 18,
                                  "end": 19
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 18,
                            "end": 21
                          }
                        },
                        "op": "Add",
                        "right": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 24,
                            "end": 25
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 18,
                      "end": 25
                    }
                  }
                ]
              },
              "span": {
                "start": 11,
                "end": 25
              }
            }
          ],
          "condition": [],
          "update": [],
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 30,
              "end": 32
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
