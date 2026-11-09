===source===
<?php
$x = <<<EOT
    a {$b[
1]} c
  d
    EOT;
===errors===
Invalid body indentation level
===php_error===
PHP Parse error:  Invalid body indentation level (expecting an indentation level of at least 4) in Standard input code on line 5
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
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "a "
                      },
                      {
                        "Expr": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 25,
                                  "end": 27
                                }
                              },
                              "index": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 29,
                                  "end": 30
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 25,
                            "end": 31
                          }
                        }
                      },
                      {
                        "Literal": " c\nd"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 46
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 46
          }
        }
      },
      "span": {
        "start": 6,
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}
