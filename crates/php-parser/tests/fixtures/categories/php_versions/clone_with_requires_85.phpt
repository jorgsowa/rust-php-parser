===source===
<?php $b = clone($a, ['alpha' => 128]);
===errors 8.4===
'clone with property overrides' requires PHP 8.5 or higher
===php_error <=8.4===
PHP Parse error:  syntax error, unexpected token "," in Standard input code on line 1
===ast >=8.4===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CloneWith": [
                    {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 17,
                        "end": 19
                      }
                    },
                    {
                      "kind": {
                        "Array": [
                          {
                            "key": {
                              "kind": {
                                "String": "alpha"
                              },
                              "span": {
                                "start": 22,
                                "end": 29
                              }
                            },
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Int": 128
                                },
                                "span": {
                                  "start": 33,
                                  "end": 36
                                }
                              }
                            },
                            "span": {
                              "start": 22,
                              "end": 36
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 21,
                        "end": 37
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 38
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 38
          }
        }
      },
      "span": {
        "start": 6,
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
