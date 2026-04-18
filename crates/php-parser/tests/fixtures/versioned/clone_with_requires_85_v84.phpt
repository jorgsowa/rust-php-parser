===config===
min_php=8.4
max_php=8.4
===source===
<?php $b = clone($a, ['alpha' => 128]);
===errors===
'clone with property overrides' requires PHP 8.5 or higher (targeting PHP 8.4)
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
                            "value": {
                              "kind": {
                                "Int": 128
                              },
                              "span": {
                                "start": 33,
                                "end": 36
                              }
                            },
                            "unpack": false,
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
===php_error===
PHP Parse error:  syntax error, unexpected token "," in Standard input code on line 1
