===source===
<?php
while (true) {
    try {
    } finally {
        break;
    }
}
foreach ([] as $v) {
    try {
    } finally {
        continue;
    }
}
switch (1) {
    case 1:
        try {
        } finally {
            break 1;
        }
}
for (;;) {
    try {
    } finally {
        while (true) {
            continue 2;
        }
    }
}
===errors===
jump out of a finally block is disallowed
jump out of a finally block is disallowed
jump out of a finally block is disallowed
jump out of a finally block is disallowed
===php_error===
PHP Fatal error:  jump out of a finally block is disallowed in Standard input code on line 5
===ast===
{
  "stmts": [
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 13,
              "end": 17
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "TryCatch": {
                      "body": [],
                      "catches": [],
                      "finally": [
                        {
                          "kind": {
                            "Break": null
                          },
                          "span": {
                            "start": 55,
                            "end": 61
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 67
                  }
                }
              ]
            },
            "span": {
              "start": 19,
              "end": 69
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 69
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Array": []
            },
            "span": {
              "start": 79,
              "end": 81
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "v"
            },
            "span": {
              "start": 85,
              "end": 87
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "TryCatch": {
                      "body": [],
                      "catches": [],
                      "finally": [
                        {
                          "kind": {
                            "Continue": null
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
                    "start": 95,
                    "end": 140
                  }
                }
              ]
            },
            "span": {
              "start": 89,
              "end": 142
            }
          }
        }
      },
      "span": {
        "start": 70,
        "end": 142
      }
    },
    {
      "kind": {
        "Switch": {
          "expr": {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 151,
              "end": 152
            }
          },
          "cases": [
            {
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 165,
                  "end": 166
                }
              },
              "body": [
                {
                  "kind": {
                    "TryCatch": {
                      "body": [],
                      "catches": [],
                      "finally": [
                        {
                          "kind": {
                            "Break": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 220,
                                "end": 221
                              }
                            }
                          },
                          "span": {
                            "start": 214,
                            "end": 222
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 176,
                    "end": 232
                  }
                }
              ],
              "span": {
                "start": 160,
                "end": 232
              }
            }
          ]
        }
      },
      "span": {
        "start": 143,
        "end": 234
      }
    },
    {
      "kind": {
        "For": {
          "init": [],
          "condition": [],
          "update": [],
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "TryCatch": {
                      "body": [],
                      "catches": [],
                      "finally": [
                        {
                          "kind": {
                            "While": {
                              "condition": {
                                "kind": {
                                  "Bool": true
                                },
                                "span": {
                                  "start": 287,
                                  "end": 291
                                }
                              },
                              "body": {
                                "kind": {
                                  "Block": [
                                    {
                                      "kind": {
                                        "Continue": {
                                          "kind": {
                                            "Int": 2
                                          },
                                          "span": {
                                            "start": 316,
                                            "end": 317
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 307,
                                        "end": 318
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 293,
                                  "end": 328
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 280,
                            "end": 328
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 250,
                    "end": 334
                  }
                }
              ]
            },
            "span": {
              "start": 244,
              "end": 336
            }
          }
        }
      },
      "span": {
        "start": 235,
        "end": 336
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 336
  }
}
