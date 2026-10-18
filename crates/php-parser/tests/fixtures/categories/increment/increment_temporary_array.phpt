===source===
<?php ++[1][0];
===errors===
Cannot use temporary expression in write context
===php_error===
PHP Fatal error:  Cannot use temporary expression in write context in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "PreIncrement",
              "operand": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Array": [
                          {
                            "key": null,
                            "value": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 9,
                                "end": 10
                              }
                            },
                            "unpack": false,
                            "span": {
                              "start": 9,
                              "end": 10
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 8,
                        "end": 11
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 12,
                        "end": 13
                      }
                    }
                  }
                },
                "span": {
                  "start": 8,
                  "end": 14
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 14
          }
        }
      },
      "span": {
        "start": 6,
        "end": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 15
  }
}
