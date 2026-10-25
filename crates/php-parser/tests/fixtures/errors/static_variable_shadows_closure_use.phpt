===source===
<?php
$f = function () use (&$a, $b) {
    static $a;
    static $b = 1, $c;
};
===errors >=8.3===
Duplicate declaration of static variable $a
Duplicate declaration of static variable $b
===php_error >=8.3===
PHP Fatal error:  Duplicate declaration of static variable $a in Standard input code on line 3
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
                  "Variable": "f"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [
                      {
                        "name": {
                          "name": "a",
                          "span": {
                            "start": 29,
                            "end": 31
                          }
                        },
                        "by_ref": true,
                        "span": {
                          "start": 28,
                          "end": 31
                        }
                      },
                      {
                        "name": {
                          "name": "b",
                          "span": {
                            "start": 33,
                            "end": 35
                          }
                        },
                        "by_ref": false,
                        "span": {
                          "start": 33,
                          "end": 35
                        }
                      }
                    ],
                    "return_type": null,
                    "body": [
                      {
                        "kind": {
                          "StaticVar": [
                            {
                              "name": {
                                "name": "a",
                                "span": {
                                  "start": 50,
                                  "end": 52
                                }
                              },
                              "default": null,
                              "span": {
                                "start": 50,
                                "end": 52
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 43,
                          "end": 53
                        }
                      },
                      {
                        "kind": {
                          "StaticVar": [
                            {
                              "name": {
                                "name": "b",
                                "span": {
                                  "start": 65,
                                  "end": 67
                                }
                              },
                              "default": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 70,
                                  "end": 71
                                }
                              },
                              "span": {
                                "start": 65,
                                "end": 71
                              }
                            },
                            {
                              "name": {
                                "name": "c",
                                "span": {
                                  "start": 73,
                                  "end": 75
                                }
                              },
                              "default": null,
                              "span": {
                                "start": 73,
                                "end": 75
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 58,
                          "end": 76
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 78
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 78
          }
        }
      },
      "span": {
        "start": 6,
        "end": 79
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 79
  }
}
