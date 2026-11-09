===source===
<?php
<<<EOT
${A[0]->b}
EOT;
===errors===
expected ']' to close the index in '${...}' string interpolation
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR), expecting '}' in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "->", expecting "}" in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Heredoc": {
              "label": "EOT",
              "parts": [
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
                                          "start": 15,
                                          "end": 16
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 15,
                                      "end": 16
                                    }
                                  },
                                  "index": {
                                    "kind": {
                                      "Int": 0
                                    },
                                    "span": {
                                      "start": 17,
                                      "end": 18
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 15,
                                "end": 19
                              }
                            },
                            "property": {
                              "kind": {
                                "Identifier": "b"
                              },
                              "span": {
                                "start": 21,
                                "end": 22
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 15,
                          "end": 22
                        }
                      }
                    },
                    "span": {
                      "start": 13,
                      "end": 23
                    }
                  }
                }
              ]
            }
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
