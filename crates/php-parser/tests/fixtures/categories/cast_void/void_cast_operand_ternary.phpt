===source===
<?php
(void) $a ? f() : g();
===errors <=8.4===
'void cast' requires PHP 8.5 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '$a' (T_VARIABLE) in Standard input code on line 2
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected variable "$a" in Standard input code on line 2
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
