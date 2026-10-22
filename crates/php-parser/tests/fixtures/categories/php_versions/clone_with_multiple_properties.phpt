===source===
<?php $b = clone($obj, ['a' => 1, 'b' => 2, 'c' => 3]);
===errors <=8.4===
'clone with property overrides' requires PHP 8.5 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ',' in Standard input code on line 1
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected token "," in Standard input code on line 1
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
                  "Variable": "b"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CloneWith": [
                    {
                      "kind": {
                        "Variable": "obj"
                      },
                      "span": {
                        "start": 17,
                        "end": 21
                      }
                    },
                    {
                      "kind": {
                        "Array": [
                          {
                            "key": {
                              "kind": {
                                "String": "a"
                              },
                              "span": {
                                "start": 24,
                                "end": 27
                              }
                            },
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 31,
                                  "end": 32
                                }
                              }
                            },
                            "span": {
                              "start": 24,
                              "end": 32
                            }
                          },
                          {
                            "key": {
                              "kind": {
                                "String": "b"
                              },
                              "span": {
                                "start": 34,
                                "end": 37
                              }
                            },
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 41,
                                  "end": 42
                                }
                              }
                            },
                            "span": {
                              "start": 34,
                              "end": 42
                            }
                          },
                          {
                            "key": {
                              "kind": {
                                "String": "c"
                              },
                              "span": {
                                "start": 44,
                                "end": 47
                              }
                            },
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Int": 3
                                },
                                "span": {
                                  "start": 51,
                                  "end": 52
                                }
                              }
                            },
                            "span": {
                              "start": 44,
                              "end": 52
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 23,
                        "end": 53
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 54
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 54
          }
        }
      },
      "span": {
        "start": 6,
        "end": 55
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55
  }
}
