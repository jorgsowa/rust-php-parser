===config===
min_php=8.5
===source===
<?php
(void) $a ? f() : g();
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
                  "Ternary": {
                    "condition": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 13,
                        "end": 15
                      }
                    },
                    "then_expr": {
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
                    "else_expr": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "g"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 24,
                                  "end": 25
                                }
                              }
                            },
                            "span": {
                              "start": 24,
                              "end": 25
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 24,
                        "end": 27
                      }
                    }
                  }
                },
                "span": {
                  "start": 13,
                  "end": 27
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 27
          }
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
