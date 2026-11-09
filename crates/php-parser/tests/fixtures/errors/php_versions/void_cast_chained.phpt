===source===
<?php (void)(void)$x;
===errors <=8.4===
expected ';' after expression
===errors >=8.5===
(void) cast cannot be used in an expression context
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '$x' (T_VARIABLE) in Standard input code on line 1
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected variable "$x" in Standard input code on line 1
===php_error >=8.5===
PHP Parse error:  syntax error, unexpected token "(void)" in Standard input code on line 1
===ast <=8.4===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 7,
                          "end": 11
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 11
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 12
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "void"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 13,
                            "end": 17
                          }
                        }
                      },
                      "span": {
                        "start": 13,
                        "end": 17
                      }
                    }
                  },
                  "span": {
                    "start": 13,
                    "end": 17
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Variable": "x"
          },
          "span": {
            "start": 18,
            "end": 20
          }
        }
      },
      "span": {
        "start": 18,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
===ast >=8.5===
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
                  "Cast": [
                    "Void",
                    {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 18,
                        "end": 20
                      }
                    }
                  ]
                },
                "span": {
                  "start": 12,
                  "end": 20
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
