===source===
<?php
$f = function(): void {
    if ($a) { return 1; }
    foreach ($b as $c) { return 2; }
    try { return 3; } finally { return 4; }
};
===errors >=8.1===
A void function must not return a value
A void function must not return a value
A void function must not return a value
A void function must not return a value
===php_error===
PHP Fatal error:  A void function must not return a value in Standard input code on line 3
===ast >=8.1===
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
                    "use_vars": [],
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "void"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 23,
                            "end": 27
                          }
                        }
                      },
                      "span": {
                        "start": 23,
                        "end": 27
                      }
                    },
                    "body": [
                      {
                        "kind": {
                          "If": {
                            "condition": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 38,
                                "end": 40
                              }
                            },
                            "then_branch": {
                              "kind": {
                                "Block": [
                                  {
                                    "kind": {
                                      "Return": {
                                        "kind": {
                                          "Int": 1
                                        },
                                        "span": {
                                          "start": 51,
                                          "end": 52
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 44,
                                      "end": 53
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 42,
                                "end": 55
                              }
                            },
                            "elseif_branches": [],
                            "else_branch": null
                          }
                        },
                        "span": {
                          "start": 34,
                          "end": 55
                        }
                      },
                      {
                        "kind": {
                          "Foreach": {
                            "expr": {
                              "kind": {
                                "Variable": "b"
                              },
                              "span": {
                                "start": 69,
                                "end": 71
                              }
                            },
                            "key": null,
                            "value": {
                              "kind": {
                                "Variable": "c"
                              },
                              "span": {
                                "start": 75,
                                "end": 77
                              }
                            },
                            "body": {
                              "kind": {
                                "Block": [
                                  {
                                    "kind": {
                                      "Return": {
                                        "kind": {
                                          "Int": 2
                                        },
                                        "span": {
                                          "start": 88,
                                          "end": 89
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 81,
                                      "end": 90
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 79,
                                "end": 92
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 60,
                          "end": 92
                        }
                      },
                      {
                        "kind": {
                          "TryCatch": {
                            "body": [
                              {
                                "kind": {
                                  "Return": {
                                    "kind": {
                                      "Int": 3
                                    },
                                    "span": {
                                      "start": 110,
                                      "end": 111
                                    }
                                  }
                                },
                                "span": {
                                  "start": 103,
                                  "end": 112
                                }
                              }
                            ],
                            "catches": [],
                            "finally": [
                              {
                                "kind": {
                                  "Return": {
                                    "kind": {
                                      "Int": 4
                                    },
                                    "span": {
                                      "start": 132,
                                      "end": 133
                                    }
                                  }
                                },
                                "span": {
                                  "start": 125,
                                  "end": 134
                                }
                              }
                            ]
                          }
                        },
                        "span": {
                          "start": 97,
                          "end": 136
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 138
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 138
          }
        }
      },
      "span": {
        "start": 6,
        "end": 139
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 139
  }
}
