===source===
<?php
$a = <<<X"
a
X;
===errors===
unterminated string literal
expected expression, found '<<'
expected expression, found '<'
expected ';' after expression
expected ';' after expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '<<' (T_SL) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "<<" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": "Error",
                            "span": {
                              "start": 11,
                              "end": 13
                            }
                          },
                          "op": "ShiftLeft",
                          "right": {
                            "kind": "Error",
                            "span": {
                              "start": 13,
                              "end": 14
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 14
                      }
                    },
                    "op": "Less",
                    "right": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "X"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 14,
                            "end": 15
                          }
                        }
                      },
                      "span": {
                        "start": 14,
                        "end": 15
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 15
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 15
          }
        }
      },
      "span": {
        "start": 6,
        "end": 15
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "\na\nX;"
          },
          "span": {
            "start": 15,
            "end": 21
          }
        }
      },
      "span": {
        "start": 15,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
