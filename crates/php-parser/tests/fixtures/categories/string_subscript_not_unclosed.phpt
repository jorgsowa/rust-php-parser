===source===
<?php
echo "$a[k] [x";
echo "$a [k";
echo "\$a[k";
echo "$a->b[k";
echo "{$a}[k";
echo "$a[k]";
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Expr": {
                    "kind": {
                      "ArrayAccess": {
                        "array": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 12,
                            "end": 14
                          }
                        },
                        "index": {
                          "kind": {
                            "String": "k"
                          },
                          "span": {
                            "start": 15,
                            "end": 16
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 12,
                      "end": 17
                    }
                  }
                },
                {
                  "Literal": " [x"
                }
              ]
            },
            "span": {
              "start": 11,
              "end": 21
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 22
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Expr": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 29,
                      "end": 31
                    }
                  }
                },
                {
                  "Literal": " [k"
                }
              ]
            },
            "span": {
              "start": 28,
              "end": 35
            }
          }
        ]
      },
      "span": {
        "start": 23,
        "end": 36
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "String": "$a[k"
            },
            "span": {
              "start": 42,
              "end": 49
            }
          }
        ]
      },
      "span": {
        "start": 37,
        "end": 50
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Expr": {
                    "kind": {
                      "PropertyAccess": {
                        "object": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 57,
                            "end": 59
                          }
                        },
                        "property": {
                          "kind": {
                            "Identifier": "b"
                          },
                          "span": {
                            "start": 61,
                            "end": 62
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 57,
                      "end": 62
                    }
                  }
                },
                {
                  "Literal": "[k"
                }
              ]
            },
            "span": {
              "start": 56,
              "end": 65
            }
          }
        ]
      },
      "span": {
        "start": 51,
        "end": 66
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Expr": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 74,
                      "end": 76
                    }
                  }
                },
                {
                  "Literal": "[k"
                }
              ]
            },
            "span": {
              "start": 72,
              "end": 80
            }
          }
        ]
      },
      "span": {
        "start": 67,
        "end": 81
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Expr": {
                    "kind": {
                      "ArrayAccess": {
                        "array": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 88,
                            "end": 90
                          }
                        },
                        "index": {
                          "kind": {
                            "String": "k"
                          },
                          "span": {
                            "start": 91,
                            "end": 92
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 88,
                      "end": 93
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 87,
              "end": 94
            }
          }
        ]
      },
      "span": {
        "start": 82,
        "end": 95
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 95
  }
}
