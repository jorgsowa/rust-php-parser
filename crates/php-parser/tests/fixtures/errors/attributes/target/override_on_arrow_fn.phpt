===source===
<?php
$d = #[Override] fn() => 1;
===errors <=7.4===
expected expression, found end of file
===errors 8.3-8.4===
Attribute "Override" cannot target function (allowed targets: method)
===errors 8.5===
Attribute "Override" cannot target function (allowed targets: method, property)
===errors >=8.6===
Attribute "Override" cannot target function (allowed targets: method, property, class constant)
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file in Standard input code on line 2
===php_error 8.3-8.4===
PHP Fatal error:  Attribute "Override" cannot target function (allowed targets: method) in Standard input code on line 2
===php_error 8.5===
PHP Fatal error:  Attribute "Override" cannot target function (allowed targets: method, property) in Standard input code on line 2
===php_error >=8.6===
PHP Fatal error:  Attribute "Override" cannot target function (allowed targets: method, property, class constant) in Standard input code on line 2
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
                  "Variable": "d"
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
                  "Variable": "d"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 31,
                        "end": 32
                      }
                    },
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "Override"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 13,
                            "end": 21
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 13,
                          "end": 21
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 32
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 32
          }
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
