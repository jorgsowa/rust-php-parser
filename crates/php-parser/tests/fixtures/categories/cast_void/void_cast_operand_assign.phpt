===config===
min_php=8.5
===source===
<?php
(void) $a = f() + 1;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Void",
              {
                "kind": {
                  "Assign": {
                    "target": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 13,
                        "end": 15
                      }
                    },
                    "op": "Assign",
                    "value": {
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
                  }
                },
                "span": {
                  "start": 13,
                  "end": 25
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
