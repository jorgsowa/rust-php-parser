===config===
min_php=8.5
===source===
<?php $fn = foo(1, ?, 3);
===errors===
'partial function application' requires PHP 8.6 or higher (targeting PHP 8.5)
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
                  "Variable": "fn"
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "foo"
                      },
                      "span": {
                        "start": 12,
                        "end": 15
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 16,
                            "end": 17
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 16,
                          "end": 17
                        }
                      },
                      {
                        "name": null,
                        "value": null,
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 19,
                          "end": 20
                        }
                      },
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "Int": 3
                          },
                          "span": {
                            "start": 22,
                            "end": 23
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 22,
                          "end": 23
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 12,
                  "end": 24
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "?", expecting ")" in Standard input code on line 1
