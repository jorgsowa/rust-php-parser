===source===
<?php
$x = [
    // comment before first element
    1,
    /* comment before second element */
    2,
    /** doc comment */
    3, // comment after element
    # hash comment
    4,
];

$y = [
    'key1' => /* comment after key */ 'value1',
    'key2' => 'value2', // comment with trailing comma
];

$z = [
    /* comment */ 1, /* between */ 2, /* after */
];
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
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 53,
                          "end": 54
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 53,
                        "end": 54
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 100,
                          "end": 101
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 100,
                        "end": 101
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 3
                        },
                        "span": {
                          "start": 130,
                          "end": 131
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 130,
                        "end": 131
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 4
                        },
                        "span": {
                          "start": 181,
                          "end": 182
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 181,
                        "end": 182
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 185
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 185
          }
        }
      },
      "span": {
        "start": 6,
        "end": 186
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "y"
                },
                "span": {
                  "start": 188,
                  "end": 190
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "String": "key1"
                        },
                        "span": {
                          "start": 199,
                          "end": 205
                        }
                      },
                      "value": {
                        "kind": {
                          "String": "value1"
                        },
                        "span": {
                          "start": 233,
                          "end": 241
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 199,
                        "end": 241
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "key2"
                        },
                        "span": {
                          "start": 247,
                          "end": 253
                        }
                      },
                      "value": {
                        "kind": {
                          "String": "value2"
                        },
                        "span": {
                          "start": 257,
                          "end": 265
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 247,
                        "end": 265
                      }
                    }
                  ]
                },
                "span": {
                  "start": 193,
                  "end": 299
                }
              }
            }
          },
          "span": {
            "start": 188,
            "end": 299
          }
        }
      },
      "span": {
        "start": 188,
        "end": 300
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "z"
                },
                "span": {
                  "start": 302,
                  "end": 304
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 327,
                          "end": 328
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 327,
                        "end": 328
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 344,
                          "end": 345
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 344,
                        "end": 345
                      }
                    }
                  ]
                },
                "span": {
                  "start": 307,
                  "end": 360
                }
              }
            }
          },
          "span": {
            "start": 302,
            "end": 360
          }
        }
      },
      "span": {
        "start": 302,
        "end": 361
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 361
  }
}
