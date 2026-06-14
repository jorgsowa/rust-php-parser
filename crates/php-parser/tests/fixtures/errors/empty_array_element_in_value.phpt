===source===
<?php
$x = [1, , 3];
===errors===
Cannot use empty array elements in arrays
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
                        "kind": "Omit",
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
                          "start": 17,
                          "end": 18
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 17,
                        "end": 18
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
PHP Fatal error:  Cannot use empty array elements in arrays in Standard input code on line 2
