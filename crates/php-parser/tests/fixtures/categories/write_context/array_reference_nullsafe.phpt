===source===
<?php $x = ["k" => &$a?->b];
===errors===
Can't use nullsafe operator in write context
===php_error===
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
                      "value": {
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
                      },
                      "unpack": false,
                      "by_ref": true,
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
