===source===
<?php $r = match($x) { 1 => 'ok', default => throw new Exception() };
===errors <=7.4===
'match expressions' requires PHP 8.0 or higher
'throw expressions' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '=>' (T_DOUBLE_ARROW) in Standard input code on line 1
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
                  "Variable": "r"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Match": {
                    "subject": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 17,
                        "end": 19
                      }
                    },
                    "arms": [
                      {
                        "conditions": [
                          {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 23,
                              "end": 24
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "ok"
                          },
                          "span": {
                            "start": 28,
                            "end": 32
                          }
                        },
                        "span": {
                          "start": 23,
                          "end": 32
                        }
                      },
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "Throw": {
                              "kind": {
                                "New": {
                                  "class": {
                                    "kind": {
                                      "Name": {
                                        "parts": [
                                          "Exception"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 55,
                                          "end": 64
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 55,
                                      "end": 64
                                    }
                                  },
                                  "args": []
                                }
                              },
                              "span": {
                                "start": 51,
                                "end": 66
                              }
                            }
                          },
                          "span": {
                            "start": 45,
                            "end": 66
                          }
                        },
                        "span": {
                          "start": 34,
                          "end": 66
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 68
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 68
          }
        }
      },
      "span": {
        "start": 6,
        "end": 69
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 69
  }
}
