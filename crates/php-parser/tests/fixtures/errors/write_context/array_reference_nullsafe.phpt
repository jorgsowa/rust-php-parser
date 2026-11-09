===source===
<?php $x = ["k" => &$a?->b];
===errors <=7.4===
'nullsafe operator (?->)' requires PHP 8.0 or higher
Can't use nullsafe operator in write context
===errors >=8.0===
Can't use nullsafe operator in write context
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '?', expecting :: (T_PAAMAYIM_NEKUDOTAYIM) in Standard input code on line 1
===php_error >=8.0===
PHP Fatal error:  Can't use nullsafe operator in write context in Standard input code on line 1
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
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 12,
                          "end": 15
                        }
                      },
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "NullsafePropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 20,
                                  "end": 22
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "b"
                                },
                                "span": {
                                  "start": 25,
                                  "end": 26
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 20,
                            "end": 26
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 26
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 27
                }
              }
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
