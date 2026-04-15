===config===
min_php=8.5
===source===
<?php [, , ,] = $arr;
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
                      "value": {
                        "kind": "Omit",
                        "span": {
                          "start": 7,
                          "end": 8
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 7,
                        "end": 8
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": "Omit",
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
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": "Omit",
                        "span": {
                          "start": 11,
                          "end": 12
                        }
                      },
                      "unpack": false,
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
===php_error===
PHP Fatal error:  Cannot use empty list in Standard input code on line 1
Stack trace:
#0 {main}
