===source===
<?php
echo 1;
declare(strict_types=1);
declare(ticks=1, strict_types=0);
function f() {
    declare(strict_types=1);
}
class A {
    function m() {
        declare(strict_types=1);
    }
}
$f = function () {
    declare(strict_types=1);
};
if (true) {
    declare(strict_types=1);
}
===errors===
strict_types declaration must be the very first statement in the script
strict_types declaration must be the very first statement in the script
strict_types declaration must be the very first statement in the script
strict_types declaration must be the very first statement in the script
strict_types declaration must be the very first statement in the script
strict_types declaration must be the very first statement in the script
===php_error===
PHP Fatal error:  strict_types declaration must be the very first statement in the script in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 11,
              "end": 12
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 13
      }
    },
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
                  "start": 35,
                  "end": 36
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 14,
        "end": 38
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
                  "start": 53,
                  "end": 54
                }
              }
            ],
            [
              "strict_types",
              {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 69,
                  "end": 70
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 39,
        "end": 72
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 82,
              "end": 83
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
                          "start": 113,
                          "end": 114
                        }
                      }
                    ]
                  ],
                  "body": null
                }
              },
              "span": {
                "start": 92,
                "end": 116
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 73,
        "end": 118
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 125,
              "end": 126
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 142,
                      "end": 143
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
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
                                  "start": 177,
                                  "end": 178
                                }
                              }
                            ]
                          ],
                          "body": null
                        }
                      },
                      "span": {
                        "start": 156,
                        "end": 180
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 133,
                "end": 186
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 119,
        "end": 188
      }
    },
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
                  "start": 189,
                  "end": 191
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": null,
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
                                    "start": 233,
                                    "end": 234
                                  }
                                }
                              ]
                            ],
                            "body": null
                          }
                        },
                        "span": {
                          "start": 212,
                          "end": 236
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 194,
                  "end": 238
                }
              }
            }
          },
          "span": {
            "start": 189,
            "end": 238
          }
        }
      },
      "span": {
        "start": 189,
        "end": 239
      }
    },
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 244,
              "end": 248
            }
          },
          "then_branch": {
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
                              "start": 277,
                              "end": 278
                            }
                          }
                        ]
                      ],
                      "body": null
                    }
                  },
                  "span": {
                    "start": 256,
                    "end": 280
                  }
                }
              ]
            },
            "span": {
              "start": 250,
              "end": 282
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 240,
        "end": 282
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 282
  }
}
