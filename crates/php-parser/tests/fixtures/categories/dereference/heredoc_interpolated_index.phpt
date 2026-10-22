===source===
<?php
$a = <<<X
$b
X[0];
===errors===
Cannot dereference this expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '[' in Standard input code on line 4
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "[" in Standard input code on line 4
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
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Heredoc": {
                          "label": "X",
                          "parts": [
                            {
                              "Expr": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 16,
                                  "end": 18
                                }
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 20
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 21,
                        "end": 22
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
