===source===
<?php
$naïve = "simple";
$café = "drink";
$ïce = "cold";
echo "Simple: $naïve";
echo "Dollar-brace ascii-start: ${café}";
echo "Dollar-brace nonascii-start: ${ïce}";
echo "Complex: {$naïve}";
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
                  "Variable": "naïve"
                },
                "span": {
                  "start": 6,
                  "end": 13
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "simple"
                },
                "span": {
                  "start": 16,
                  "end": 24
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "café"
                },
                "span": {
                  "start": 26,
                  "end": 32
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "drink"
                },
                "span": {
                  "start": 35,
                  "end": 42
                }
              }
            }
          },
          "span": {
            "start": 26,
            "end": 42
          }
        }
      },
      "span": {
        "start": 26,
        "end": 43
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "ïce"
                },
                "span": {
                  "start": 44,
                  "end": 49
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "cold"
                },
                "span": {
                  "start": 52,
                  "end": 58
                }
              }
            }
          },
          "span": {
            "start": 44,
            "end": 58
          }
        }
      },
      "span": {
        "start": 44,
        "end": 59
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Literal": "Simple: "
                },
                {
                  "Expr": {
                    "kind": {
                      "Variable": "naïve"
                    },
                    "span": {
                      "start": 74,
                      "end": 81
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 65,
              "end": 82
            }
          }
        ]
      },
      "span": {
        "start": 60,
        "end": 83
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Literal": "Dollar-brace ascii-start: "
                },
                {
                  "Expr": {
                    "kind": {
                      "Variable": "café"
                    },
                    "span": {
                      "start": 118,
                      "end": 123
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 89,
              "end": 125
            }
          }
        ]
      },
      "span": {
        "start": 84,
        "end": 126
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Literal": "Dollar-brace nonascii-start: "
                },
                {
                  "Expr": {
                    "kind": {
                      "Variable": "ïce"
                    },
                    "span": {
                      "start": 164,
                      "end": 168
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 132,
              "end": 170
            }
          }
        ]
      },
      "span": {
        "start": 127,
        "end": 171
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Literal": "Complex: "
                },
                {
                  "Expr": {
                    "kind": {
                      "Variable": "naïve"
                    },
                    "span": {
                      "start": 188,
                      "end": 195
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 177,
              "end": 197
            }
          }
        ]
      },
      "span": {
        "start": 172,
        "end": 198
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 198
  }
}
