===source===
<?php
[$a, [$b]] = &$c;
===errors===
Cannot assign by reference to a destructuring pattern
===php_error <=8.1===
PHP Parse error:  syntax error, unexpected token "&" in Standard input code on line 2
===php_error 8.2===
PHP Parse error:  syntax error, unexpected token "&" in Standard input code on line 2
===php_error >=8.3===
PHP Parse error:  syntax error, unexpected token "&" in Standard input code on line 2
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
                          "kind": {
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Variable": "b"
                                    },
                                    "span": {
                                      "start": 12,
                                      "end": 14
                                    }
                                  }
                                },
                                "span": {
                                  "start": 12,
                                  "end": 14
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 11,
                            "end": 15
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 15
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 16
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 20,
                  "end": 22
                }
              },
              "by_ref": true
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
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
