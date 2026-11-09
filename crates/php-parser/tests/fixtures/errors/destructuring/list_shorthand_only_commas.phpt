===source===
<?php [, , ,] = $arr;
===errors===
Cannot use empty list
===php_error===
PHP Fatal error:  Cannot use empty list in Standard input code on line 1
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
                          "kind": "Omit",
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
                          "kind": "Omit",
                          "span": {
                            "start": 9,
                            "end": 10
                          }
                        }
                      },
                      "span": {
                        "start": 9,
                        "end": 10
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": "Omit",
                          "span": {
                            "start": 11,
                            "end": 12
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 12
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 13
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 16,
                  "end": 20
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
