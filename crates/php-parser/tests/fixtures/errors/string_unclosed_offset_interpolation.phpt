===source===
<?php $s = "${arr[";
===errors===
unterminated string literal
unclosed '${' in string interpolation
expected ';' after expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file, expecting variable (T_VARIABLE) or ${ (T_DOLLAR_OPEN_CURLY_BRACES) or {$ (T_CURLY_OPEN) in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  Unclosed '[' in Standard input code on line 1
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
                  "Variable": "s"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "VariableVariable": {
                            "kind": {
                              "ArrayAccess": {
                                "array": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "arr"
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
                                },
                                "index": {
                                  "kind": {
                                    "String": ";"
                                  },
                                  "span": {
                                    "start": 18,
                                    "end": 20
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 14,
                              "end": 20
                            }
                          }
                        },
                        "span": {
                          "start": 12,
                          "end": 20
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 20
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
