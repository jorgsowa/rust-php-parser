===source===
<?php
$c = #[NoDiscard] function (): void {};
===errors <=7.4===
expected expression, found end of file
===errors >=8.5===
A void function does not return a value, but #[\NoDiscard] requires a return value
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  A void function does not return a value, but #[\NoDiscard] requires a return value in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": "Error",
                "span": {
                  "start": 10,
                  "end": 10
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 10
          }
        }
      },
      "span": {
        "start": 6,
        "end": 10
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 10
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "void"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 37,
                            "end": 41
                          }
                        }
                      },
                      "span": {
                        "start": 37,
                        "end": 41
                      }
                    },
                    "body": [],
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "NoDiscard"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 13,
                            "end": 22
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 13,
                          "end": 22
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 44
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 44
          }
        }
      },
      "span": {
        "start": 6,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}
