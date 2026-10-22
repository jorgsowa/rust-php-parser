===source===
<?php $x = #[Attr] function() { return 1; };
===errors <=7.4===
expected expression, found end of file
expected ';' after expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file in Standard input code on line 1
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
                  "Variable": "x"
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
                  "start": 44,
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
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": null,
                    "body": [
                      {
                        "kind": {
                          "Return": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 39,
                              "end": 40
                            }
                          }
                        },
                        "span": {
                          "start": 32,
                          "end": 41
                        }
                      }
                    ],
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "Attr"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 13,
                            "end": 17
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 13,
                          "end": 17
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 43
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 43
          }
        }
      },
      "span": {
        "start": 6,
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}
