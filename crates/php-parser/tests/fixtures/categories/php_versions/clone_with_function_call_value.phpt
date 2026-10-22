===source===
<?php $b = clone($obj, ['prop' => strtolower('A')]);
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
                                "String": "prop"
                              },
                              "span": {
                                "start": 24,
                                "end": 30
                              }
                            },
                            "kind": {
                              "Value": {
                                "kind": {
                                  "FunctionCall": {
                                    "name": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "strtolower"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 34,
                                            "end": 44
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 34,
                                        "end": 44
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "String": "A"
                                            },
                                            "span": {
                                              "start": 45,
                                              "end": 48
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 45,
                                          "end": 48
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 34,
                                  "end": 49
                                }
                              }
                            },
                            "span": {
                              "start": 24,
                              "end": 49
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 23,
                        "end": 50
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 51
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 51
          }
        }
      },
      "span": {
        "start": 6,
        "end": 52
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52
  }
}
