===source===
<?php $x = [1, 2
===errors===
expected ']', found end of file
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file, expecting ']' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  Unclosed '[' in Standard input code on line 1
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
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 12,
                            "end": 13
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 13
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 15,
                            "end": 16
                          }
                        }
                      },
                      "span": {
                        "start": 15,
                        "end": 16
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 16
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16
  }
}
