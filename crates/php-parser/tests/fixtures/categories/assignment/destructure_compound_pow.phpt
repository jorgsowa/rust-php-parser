===source===
<?php
[[$a]] **= 2;
===errors===
Cannot use a destructuring pattern with a compound assignment operator
===php_error===
PHP Parse error:  syntax error, unexpected token "**=" in Standard input code on line 2
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
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Variable": "a"
                                    },
                                    "span": {
                                      "start": 8,
                                      "end": 10
                                    }
                                  }
                                },
                                "span": {
                                  "start": 8,
                                  "end": 10
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 7,
                            "end": 11
                          }
                        }
                      },
                      "span": {
                        "start": 7,
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
              "op": "Pow",
              "value": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 17,
                  "end": 18
                }
              }
            }
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
