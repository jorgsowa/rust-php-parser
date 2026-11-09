===source===
<?php $x = [&f()];
===errors===
Can't use function return value in write context
===php_error===
PHP Fatal error:  Can't use function return value in write context in Standard input code on line 1
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
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "FunctionCall": {
                              "name": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "f"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 13,
                                      "end": 14
                                    }
                                  }
                                },
                                "span": {
                                  "start": 13,
                                  "end": 14
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 13,
                            "end": 16
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 16
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
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
