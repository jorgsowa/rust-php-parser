===config===
max_php=8.4
===source===
<?php [$a, null, $c] = $arr;
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
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 7,
                          "end": 9
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 7,
                        "end": 9
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": "Null",
                        "span": {
                          "start": 11,
                          "end": 15
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 11,
                        "end": 15
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "c"
                        },
                        "span": {
                          "start": 17,
                          "end": 19
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 17,
                        "end": 19
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 20
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 23,
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
===php_error===
PHP Fatal error:  Assignments can only happen to writable values in Standard input code on line 1
