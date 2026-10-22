===source===
<?php clone(object: $x, withProperties: ['foo' => 1]);
===errors <=7.4===
'named arguments' requires PHP 8.0 or higher
'named arguments' requires PHP 8.0 or higher
'clone function call' requires PHP 8.5 or higher
===errors 8.0-8.4===
'clone function call' requires PHP 8.5 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ':' in Standard input code on line 1
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected token ":" in Standard input code on line 1
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
                      "clone"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 11
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 11
                }
              },
              "args": [
                {
                  "name": {
                    "parts": [
                      "object"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 12,
                      "end": 18
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 20,
                        "end": 22
                      }
                    }
                  },
                  "span": {
                    "start": 12,
                    "end": 22
                  }
                },
                {
                  "name": {
                    "parts": [
                      "withProperties"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 24,
                      "end": 38
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Array": [
                          {
                            "key": {
                              "kind": {
                                "String": "foo"
                              },
                              "span": {
                                "start": 41,
                                "end": 46
                              }
                            },
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 50,
                                  "end": 51
                                }
                              }
                            },
                            "span": {
                              "start": 41,
                              "end": 51
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 40,
                        "end": 52
                      }
                    }
                  },
                  "span": {
                    "start": 24,
                    "end": 52
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 53
          }
        }
      },
      "span": {
        "start": 6,
        "end": 54
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 54
  }
}
