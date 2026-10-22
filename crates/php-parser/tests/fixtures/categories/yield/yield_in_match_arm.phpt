===source===
<?php
function gen($x) {
    $v = match(true) {
        $x > 0 => yield $x,
        default => yield 0,
    };
}
===errors <=7.4===
'match expressions' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '=>' (T_DOUBLE_ARROW) in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "gen",
            "span": {
              "start": 15,
              "end": 18
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 19,
                  "end": 21
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 19,
                "end": 21
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "v"
                        },
                        "span": {
                          "start": 29,
                          "end": 31
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Match": {
                            "subject": {
                              "kind": {
                                "Bool": true
                              },
                              "span": {
                                "start": 40,
                                "end": 44
                              }
                            },
                            "arms": [
                              {
                                "conditions": [
                                  {
                                    "kind": {
                                      "Binary": {
                                        "left": {
                                          "kind": {
                                            "Variable": "x"
                                          },
                                          "span": {
                                            "start": 56,
                                            "end": 58
                                          }
                                        },
                                        "op": "Greater",
                                        "right": {
                                          "kind": {
                                            "Int": 0
                                          },
                                          "span": {
                                            "start": 61,
                                            "end": 62
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 56,
                                      "end": 62
                                    }
                                  }
                                ],
                                "body": {
                                  "kind": {
                                    "Yield": {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "Variable": "x"
                                        },
                                        "span": {
                                          "start": 72,
                                          "end": 74
                                        }
                                      },
                                      "is_from": false
                                    }
                                  },
                                  "span": {
                                    "start": 66,
                                    "end": 74
                                  }
                                },
                                "span": {
                                  "start": 56,
                                  "end": 74
                                }
                              },
                              {
                                "conditions": null,
                                "body": {
                                  "kind": {
                                    "Yield": {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "Int": 0
                                        },
                                        "span": {
                                          "start": 101,
                                          "end": 102
                                        }
                                      },
                                      "is_from": false
                                    }
                                  },
                                  "span": {
                                    "start": 95,
                                    "end": 102
                                  }
                                },
                                "span": {
                                  "start": 84,
                                  "end": 102
                                }
                              }
                            ]
                          }
                        },
                        "span": {
                          "start": 34,
                          "end": 109
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 29,
                    "end": 109
                  }
                }
              },
              "span": {
                "start": 29,
                "end": 110
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 112
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 112
  }
}
