===source===
<?php
$x = array(1, 2,
===errors===
expected expression, found end of file
expected ')', found end of file
expected ';' after expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file, expecting ')' in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  Unclosed '(' in Standard input code on line 2
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
                            "start": 17,
                            "end": 18
                          }
                        }
                      },
                      "span": {
                        "start": 17,
                        "end": 18
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
                            "start": 20,
                            "end": 21
                          }
                        }
                      },
                      "span": {
                        "start": 20,
                        "end": 21
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": "Error",
                          "span": {
                            "start": 22,
                            "end": 22
                          }
                        }
                      },
                      "span": {
                        "start": 22,
                        "end": 22
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 22
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 22
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
