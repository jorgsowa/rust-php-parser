===source===
<?php $fn = foo(1, ?, 3);
===errors <=8.5===
'partial function application' requires PHP 8.6 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '?', expecting ')' in Standard input code on line 1
===php_error 8.0-8.5===
PHP Parse error:  syntax error, unexpected token "?", expecting ")" in Standard input code on line 1
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
                        "Name": {
                          "parts": [
                            "foo"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 12,
                            "end": 15
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 15
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 16,
                              "end": 17
                            }
                          }
                        },
                        "span": {
                          "start": 16,
                          "end": 17
                        }
                      },
                      {
                        "name": null,
                        "kind": "Placeholder",
                        "span": {
                          "start": 19,
                          "end": 20
                        }
                      },
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "Int": 3
                            },
                            "span": {
                              "start": 22,
                              "end": 23
                            }
                          }
                        },
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
