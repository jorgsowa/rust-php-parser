===source===
<?php $x = <<<EOT
hello
===errors===
expected expression
expected expression
expected ';' after expression
expected ';' after expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file, expecting variable (T_VARIABLE) or heredoc end (T_END_HEREDOC) or ${ (T_DOLLAR_OPEN_CURLY_BRACES) or {$ (T_CURLY_OPEN) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected end of file, expecting variable or heredoc end or "${" or "{$" in Standard input code on line 2
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
                  "Variable": "x"
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
                            "EOT"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 14,
                            "end": 17
                          }
                        }
                      },
                      "span": {
                        "start": 14,
                        "end": 17
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 17
                }
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
        "end": 17
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Name": {
              "parts": [
                "hello"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 18,
                "end": 23
              }
            }
          },
          "span": {
            "start": 18,
            "end": 23
          }
        }
      },
      "span": {
        "start": 18,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
