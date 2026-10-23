===source===
<?php [$a, , ,] = ; echo $a;
===errors===
expected expression, found ';'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 1
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
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 7,
                            "end": 9
                          }
                        }
                      },
                      "span": {
                        "start": 7,
                        "end": 9
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": "Omit",
                          "span": {
                            "start": 11,
                            "end": 12
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 12
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": "Omit",
                          "span": {
                            "start": 13,
                            "end": 14
                          }
                        }
                      },
                      "span": {
                        "start": 13,
                        "end": 14
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 15
                }
              },
              "op": "Assign",
              "value": {
                "kind": "Error",
                "span": {
                  "start": 17,
                  "end": 17
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 25,
              "end": 27
            }
          }
        ]
      },
      "span": {
        "start": 20,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
