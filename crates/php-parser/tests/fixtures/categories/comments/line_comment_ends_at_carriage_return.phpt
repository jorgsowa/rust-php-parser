===source===
<?php
// a$a = 1;
# b$b = 2;
$c = 3; // c$d = 4;
// e
$e = 5;
# f ?>X<?php
$g = 6;
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
                  "start": 11,
                  "end": 13
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 16,
                  "end": 17
                }
              }
            }
          },
          "span": {
            "start": 11,
            "end": 17
          }
        }
      },
      "span": {
        "start": 11,
        "end": 18
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
                  "start": 23,
                  "end": 25
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 28,
                  "end": 29
                }
              }
            }
          },
          "span": {
            "start": 23,
            "end": 29
          }
        }
      },
      "span": {
        "start": 23,
        "end": 30
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
                  "start": 31,
                  "end": 33
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 3
                },
                "span": {
                  "start": 36,
                  "end": 37
                }
              }
            }
          },
          "span": {
            "start": 31,
            "end": 37
          }
        }
      },
      "span": {
        "start": 31,
        "end": 38
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
                  "start": 44,
                  "end": 46
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 4
                },
                "span": {
                  "start": 49,
                  "end": 50
                }
              }
            }
          },
          "span": {
            "start": 44,
            "end": 50
          }
        }
      },
      "span": {
        "start": 44,
        "end": 51
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "e"
                },
                "span": {
                  "start": 58,
                  "end": 60
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 5
                },
                "span": {
                  "start": 63,
                  "end": 64
                }
              }
            }
          },
          "span": {
            "start": 58,
            "end": 64
          }
        }
      },
      "span": {
        "start": 58,
        "end": 65
      }
    },
    {
      "kind": "Nop",
      "span": {
        "start": 70,
        "end": 72
      }
    },
    {
      "kind": {
        "InlineHtml": "\rX"
      },
      "span": {
        "start": 72,
        "end": 74
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "g"
                },
                "span": {
                  "start": 80,
                  "end": 82
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 6
                },
                "span": {
                  "start": 85,
                  "end": 86
                }
              }
            }
          },
          "span": {
            "start": 80,
            "end": 86
          }
        }
      },
      "span": {
        "start": 80,
        "end": 87
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 87
  }
}
