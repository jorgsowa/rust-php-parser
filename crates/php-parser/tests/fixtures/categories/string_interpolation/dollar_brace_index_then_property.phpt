===source===
<?php
"${A[0]->b}";
===errors===
expected ']' to close the index in '${...}' string interpolation
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR), expecting '}' in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "->", expecting "}" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "VariableVariable": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "ArrayAccess": {
                                "array": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "A"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 9,
                                        "end": 10
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 9,
                                    "end": 10
                                  }
                                },
                                "index": {
                                  "kind": {
                                    "Int": 0
                                  },
                                  "span": {
                                    "start": 11,
                                    "end": 12
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 9,
                              "end": 13
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "b"
                            },
                            "span": {
                              "start": 15,
                              "end": 16
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 9,
                        "end": 16
                      }
                    }
                  },
                  "span": {
                    "start": 7,
                    "end": 17
                  }
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}
