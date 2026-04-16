===source===
<?php $a = [1, 2, 3;
===errors===
expected ']', found ';'
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
                  "Variable": "a"
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
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 12,
                          "end": 13
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 12,
                        "end": 13
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 15,
                          "end": 16
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 15,
                        "end": 16
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 3
                        },
                        "span": {
                          "start": 18,
                          "end": 19
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 18,
                        "end": 19
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 19
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token ";", expecting "]" in Standard input code on line 1
