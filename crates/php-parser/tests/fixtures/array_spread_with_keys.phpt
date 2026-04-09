===source===
<?php
$numbers = [1, 2, 3];
$expanded = [...$numbers, 4, 5];
$combined = ['a' => 1, ...$other, 'b' => 2];
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
                  "Variable": "numbers"
                },
                "span": {
                  "start": 6,
                  "end": 14,
                  "start_line": 2,
                  "start_col": 0
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
                          "start": 18,
                          "end": 19,
                          "start_line": 2,
                          "start_col": 12
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 18,
                        "end": 19,
                        "start_line": 2,
                        "start_col": 12
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 21,
                          "end": 22,
                          "start_line": 2,
                          "start_col": 15
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 21,
                        "end": 22,
                        "start_line": 2,
                        "start_col": 15
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 3
                        },
                        "span": {
                          "start": 24,
                          "end": 25,
                          "start_line": 2,
                          "start_col": 18
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 24,
                        "end": 25,
                        "start_line": 2,
                        "start_col": 18
                      }
                    }
                  ]
                },
                "span": {
                  "start": 17,
                  "end": 26,
                  "start_line": 2,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 26,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 28,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "expanded"
                },
                "span": {
                  "start": 28,
                  "end": 37,
                  "start_line": 3,
                  "start_col": 0
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
                          "Variable": "numbers"
                        },
                        "span": {
                          "start": 44,
                          "end": 52,
                          "start_line": 3,
                          "start_col": 16
                        }
                      },
                      "unpack": true,
                      "span": {
                        "start": 41,
                        "end": 52,
                        "start_line": 3,
                        "start_col": 13
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 4
                        },
                        "span": {
                          "start": 54,
                          "end": 55,
                          "start_line": 3,
                          "start_col": 26
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 54,
                        "end": 55,
                        "start_line": 3,
                        "start_col": 26
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 5
                        },
                        "span": {
                          "start": 57,
                          "end": 58,
                          "start_line": 3,
                          "start_col": 29
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 57,
                        "end": 58,
                        "start_line": 3,
                        "start_col": 29
                      }
                    }
                  ]
                },
                "span": {
                  "start": 40,
                  "end": 59,
                  "start_line": 3,
                  "start_col": 12
                }
              }
            }
          },
          "span": {
            "start": 28,
            "end": 59,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 28,
        "end": 61,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "combined"
                },
                "span": {
                  "start": 61,
                  "end": 70,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "String": "a"
                        },
                        "span": {
                          "start": 74,
                          "end": 77,
                          "start_line": 4,
                          "start_col": 13
                        }
                      },
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 81,
                          "end": 82,
                          "start_line": 4,
                          "start_col": 20
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 74,
                        "end": 82,
                        "start_line": 4,
                        "start_col": 13
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "other"
                        },
                        "span": {
                          "start": 87,
                          "end": 93,
                          "start_line": 4,
                          "start_col": 26
                        }
                      },
                      "unpack": true,
                      "span": {
                        "start": 84,
                        "end": 93,
                        "start_line": 4,
                        "start_col": 23
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "b"
                        },
                        "span": {
                          "start": 95,
                          "end": 98,
                          "start_line": 4,
                          "start_col": 34
                        }
                      },
                      "value": {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 102,
                          "end": 103,
                          "start_line": 4,
                          "start_col": 41
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 95,
                        "end": 103,
                        "start_line": 4,
                        "start_col": 34
                      }
                    }
                  ]
                },
                "span": {
                  "start": 73,
                  "end": 104,
                  "start_line": 4,
                  "start_col": 12
                }
              }
            }
          },
          "span": {
            "start": 61,
            "end": 104,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 61,
        "end": 105,
        "start_line": 4,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 105,
    "start_line": 1,
    "start_col": 0
  }
}
