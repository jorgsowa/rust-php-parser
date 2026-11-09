===source===
<?php
$c = #[Attribute] function () {};
===errors <=7.4===
expected expression, found end of file
===errors >=8.0===
Attribute "Attribute" cannot target function (allowed targets: class)
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Attribute "Attribute" cannot target function (allowed targets: class) in Standard input code on line 2
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
                    "return_type": null,
                    "body": [],
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "Attribute"
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
                  "end": 38
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 38
          }
        }
      },
      "span": {
        "start": 6,
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
