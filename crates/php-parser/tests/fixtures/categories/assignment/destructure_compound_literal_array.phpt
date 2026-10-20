===source===
<?php
[1, 2] += 3;
===errors===
Cannot use a destructuring pattern with a compound assignment operator
===php_error===
PHP Parse error:  syntax error, unexpected token "+=" in Standard input code on line 2
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
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 7,
                            "end": 8
                          }
                        }
                      },
                      "span": {
                        "start": 7,
                        "end": 8
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 10,
                            "end": 11
                          }
                        }
                      },
                      "span": {
                        "start": 10,
                        "end": 11
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 12
                }
              },
              "op": "Plus",
              "value": {
                "kind": {
                  "Int": 3
                },
                "span": {
                  "start": 16,
                  "end": 17
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
