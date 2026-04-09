===source===
<?php
if ($x === 1) {
    echo 'one';
} elseif ($x === 2) {
    echo 'two';
} elseif ($x === 3) {
    echo 'three';
} elseif ($x === 4) {
    echo 'four';
} else {
    echo 'other';
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Binary": {
                "left": {
                  "kind": {
                    "Variable": "x"
                  },
                  "span": {
                    "start": 10,
                    "end": 12,
                    "start_line": 2,
                    "start_col": 4
                  }
                },
                "op": "Identical",
                "right": {
                  "kind": {
                    "Int": 1
                  },
                  "span": {
                    "start": 17,
                    "end": 18,
                    "start_line": 2,
                    "start_col": 11
                  }
                }
              }
            },
            "span": {
              "start": 10,
              "end": 18,
              "start_line": 2,
              "start_col": 4
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "String": "one"
                        },
                        "span": {
                          "start": 31,
                          "end": 36,
                          "start_line": 3,
                          "start_col": 9
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 26,
                    "end": 38,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 39,
              "start_line": 2,
              "start_col": 14
            }
          },
          "elseif_branches": [
            {
              "condition": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 48,
                        "end": 50,
                        "start_line": 4,
                        "start_col": 10
                      }
                    },
                    "op": "Identical",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 55,
                        "end": 56,
                        "start_line": 4,
                        "start_col": 17
                      }
                    }
                  }
                },
                "span": {
                  "start": 48,
                  "end": 56,
                  "start_line": 4,
                  "start_col": 10
                }
              },
              "body": {
                "kind": {
                  "Block": [
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "String": "two"
                            },
                            "span": {
                              "start": 69,
                              "end": 74,
                              "start_line": 5,
                              "start_col": 9
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 64,
                        "end": 76,
                        "start_line": 5,
                        "start_col": 4
                      }
                    }
                  ]
                },
                "span": {
                  "start": 58,
                  "end": 77,
                  "start_line": 4,
                  "start_col": 20
                }
              },
              "span": {
                "start": 47,
                "end": 77,
                "start_line": 4,
                "start_col": 9
              }
            },
            {
              "condition": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 86,
                        "end": 88,
                        "start_line": 6,
                        "start_col": 10
                      }
                    },
                    "op": "Identical",
                    "right": {
                      "kind": {
                        "Int": 3
                      },
                      "span": {
                        "start": 93,
                        "end": 94,
                        "start_line": 6,
                        "start_col": 17
                      }
                    }
                  }
                },
                "span": {
                  "start": 86,
                  "end": 94,
                  "start_line": 6,
                  "start_col": 10
                }
              },
              "body": {
                "kind": {
                  "Block": [
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "String": "three"
                            },
                            "span": {
                              "start": 107,
                              "end": 114,
                              "start_line": 7,
                              "start_col": 9
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 102,
                        "end": 116,
                        "start_line": 7,
                        "start_col": 4
                      }
                    }
                  ]
                },
                "span": {
                  "start": 96,
                  "end": 117,
                  "start_line": 6,
                  "start_col": 20
                }
              },
              "span": {
                "start": 85,
                "end": 117,
                "start_line": 6,
                "start_col": 9
              }
            },
            {
              "condition": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 126,
                        "end": 128,
                        "start_line": 8,
                        "start_col": 10
                      }
                    },
                    "op": "Identical",
                    "right": {
                      "kind": {
                        "Int": 4
                      },
                      "span": {
                        "start": 133,
                        "end": 134,
                        "start_line": 8,
                        "start_col": 17
                      }
                    }
                  }
                },
                "span": {
                  "start": 126,
                  "end": 134,
                  "start_line": 8,
                  "start_col": 10
                }
              },
              "body": {
                "kind": {
                  "Block": [
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "String": "four"
                            },
                            "span": {
                              "start": 147,
                              "end": 153,
                              "start_line": 9,
                              "start_col": 9
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 142,
                        "end": 155,
                        "start_line": 9,
                        "start_col": 4
                      }
                    }
                  ]
                },
                "span": {
                  "start": 136,
                  "end": 156,
                  "start_line": 8,
                  "start_col": 20
                }
              },
              "span": {
                "start": 125,
                "end": 156,
                "start_line": 8,
                "start_col": 9
              }
            }
          ],
          "else_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "String": "other"
                        },
                        "span": {
                          "start": 173,
                          "end": 180,
                          "start_line": 11,
                          "start_col": 9
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 168,
                    "end": 182,
                    "start_line": 11,
                    "start_col": 4
                  }
                }
              ]
            },
            "span": {
              "start": 162,
              "end": 183,
              "start_line": 10,
              "start_col": 7
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 183,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 183,
    "start_line": 1,
    "start_col": 0
  }
}
