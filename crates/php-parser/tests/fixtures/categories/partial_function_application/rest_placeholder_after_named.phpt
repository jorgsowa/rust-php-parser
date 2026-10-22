===source===
<?php $fn = stuff(1, a: 5, ...);
===errors <=7.4===
'named arguments' requires PHP 8.0 or higher
'partial function application' requires PHP 8.6 or higher
===errors 8.0-8.5===
'partial function application' requires PHP 8.6 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ':', expecting ')' in Standard input code on line 1
===php_error 8.0-8.5===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 1
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
                            "stuff"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 12,
                            "end": 17
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 17
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
                              "start": 18,
                              "end": 19
                            }
                          }
                        },
                        "span": {
                          "start": 18,
                          "end": 19
                        }
                      },
                      {
                        "name": {
                          "parts": [
                            "a"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 21,
                            "end": 22
                          }
                        },
                        "kind": {
                          "Value": {
                            "kind": {
                              "Int": 5
                            },
                            "span": {
                              "start": 24,
                              "end": 25
                            }
                          }
                        },
                        "span": {
                          "start": 21,
                          "end": 25
                        }
                      },
                      {
                        "name": null,
                        "kind": "SpreadPlaceholder",
                        "span": {
                          "start": 27,
                          "end": 30
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 12,
                  "end": 31
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 31
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
