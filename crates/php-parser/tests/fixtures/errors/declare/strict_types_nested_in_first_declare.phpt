===source===
<?php
declare(ticks=1): declare(strict_types=1); enddeclare;
declare(ticks=1) {
    declare(strict_types=1);
    function f() {
        declare(strict_types=1);
    }
}
===errors===
strict_types declaration must be the very first statement in the script
strict_types declaration must be the very first statement in the script
strict_types declaration must be the very first statement in the script
===php_error===
PHP Fatal error:  strict_types declaration must be the very first statement in the script in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "ticks",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 20,
                  "end": 21
                }
              }
            ]
          ],
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Declare": {
                      "directives": [
                        [
                          "strict_types",
                          {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 45,
                              "end": 46
                            }
                          }
                        ]
                      ],
                      "body": null
                    }
                  },
                  "span": {
                    "start": 24,
                    "end": 48
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 60
            }
          },
          "uses_alternative": true
        }
      },
      "span": {
        "start": 6,
        "end": 60
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "ticks",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 75,
                  "end": 76
                }
              }
            ]
          ],
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Declare": {
                      "directives": [
                        [
                          "strict_types",
                          {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 105,
                              "end": 106
                            }
                          }
                        ]
                      ],
                      "body": null
                    }
                  },
                  "span": {
                    "start": 84,
                    "end": 108
                  }
                },
                {
                  "kind": {
                    "Function": {
                      "name": {
                        "name": "f",
                        "span": {
                          "start": 122,
                          "end": 123
                        }
                      },
                      "params": [],
                      "body": [
                        {
                          "kind": {
                            "Declare": {
                              "directives": [
                                [
                                  "strict_types",
                                  {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 157,
                                      "end": 158
                                    }
                                  }
                                ]
                              ],
                              "body": null
                            }
                          },
                          "span": {
                            "start": 136,
                            "end": 160
                          }
                        }
                      ],
                      "return_type": null,
                      "by_ref": false,
                      "attributes": []
                    }
                  },
                  "span": {
                    "start": 113,
                    "end": 166
                  }
                }
              ]
            },
            "span": {
              "start": 78,
              "end": 168
            }
          }
        }
      },
      "span": {
        "start": 61,
        "end": 168
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 168
  }
}
