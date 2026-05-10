===config===
min_php=7.4
===source===
<?php
// Backslash followed by multi-byte character in regular string
$a = "é\è";
$b = "{$x["è\é"]}";
// Multiple consecutive multi-byte escapes
$c = "test\è\é\ù";
// Escaped backslash before multi-byte
$d = "\\è";
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
                  "Variable": "a"
                },
                "span": {
                  "start": 70,
                  "end": 72
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "é\\è"
                },
                "span": {
                  "start": 75,
                  "end": 82
                }
              }
            }
          },
          "span": {
            "start": 70,
            "end": 82
          }
        }
      },
      "span": {
        "start": 70,
        "end": 83
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 84,
                  "end": 86
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "x"
                              },
                              "span": {
                                "start": 91,
                                "end": 93
                              }
                            },
                            "index": {
                              "kind": {
                                "String": "è\\é"
                              },
                              "span": {
                                "start": 94,
                                "end": 101
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 91,
                          "end": 102
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 89,
                  "end": 104
                }
              }
            }
          },
          "span": {
            "start": 84,
            "end": 104
          }
        }
      },
      "span": {
        "start": 84,
        "end": 105
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 149,
                  "end": 151
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "test\\è\\é\\ù"
                },
                "span": {
                  "start": 154,
                  "end": 169
                }
              }
            }
          },
          "span": {
            "start": 149,
            "end": 169
          }
        }
      },
      "span": {
        "start": 149,
        "end": 170
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "d"
                },
                "span": {
                  "start": 210,
                  "end": 212
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "\\è"
                },
                "span": {
                  "start": 215,
                  "end": 221
                }
              }
            }
          },
          "span": {
            "start": 210,
            "end": 221
          }
        }
      },
      "span": {
        "start": 210,
        "end": 222
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 222
  }
}
