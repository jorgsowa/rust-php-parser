===source===
<?php
switch ($x) {
    case 1
        echo "one";
        break;
    case 2:
        echo "two";
}
===errors===
expected ';', found 'echo'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Switch": {
          "expr": {
            "kind": {
              "Variable": "x"
            },
            "span": {
              "start": 14,
              "end": 16
            }
          },
          "cases": [
            {
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 29,
                  "end": 30
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "String": "one"
                        },
                        "span": {
                          "start": 44,
                          "end": 49
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 39,
                    "end": 50
                  }
                },
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 59,
                    "end": 65
                  }
                }
              ],
              "span": {
                "start": 24,
                "end": 65
              }
            },
            {
              "value": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 75,
                  "end": 76
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "String": "two"
                        },
                        "span": {
                          "start": 91,
                          "end": 96
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 86,
                    "end": 97
                  }
                }
              ],
              "span": {
                "start": 70,
                "end": 97
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 99
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 99
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "echo" in Standard input code on line 4
