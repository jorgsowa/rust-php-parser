===source===
<?php func(a: 1, ...['b' => 2]);
===errors <=7.4===
'named arguments' requires PHP 8.0 or higher
Cannot use argument unpacking after named arguments
===errors >=8.0===
Cannot use argument unpacking after named arguments
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ':', expecting ')' in Standard input code on line 1
===php_error 8.0===
PHP Fatal error:  Cannot combine named arguments and argument unpacking in Standard input code on line 1
===php_error >=8.1===
PHP Fatal error:  Cannot use argument unpacking after named arguments in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "func"
                    ],
                    "kind": "Unqualified",
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
              },
              "args": [
                {
                  "name": {
                    "parts": [
                      "a"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 11,
                      "end": 12
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 14,
                        "end": 15
                      }
                    }
                  },
                  "span": {
                    "start": 11,
                    "end": 15
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Spread": {
                      "kind": {
                        "Array": [
                          {
                            "key": {
                              "kind": {
                                "String": "b"
                              },
                              "span": {
                                "start": 21,
                                "end": 24
                              }
                            },
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 28,
                                  "end": 29
                                }
                              }
                            },
                            "span": {
                              "start": 21,
                              "end": 29
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 20,
                        "end": 30
                      }
                    }
                  },
                  "span": {
                    "start": 17,
                    "end": 30
                  }
                }
              ]
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
