===source===
<?php

$a?->b;
$a?->b($c);
new $a?->b;
"{$a?->b}";
"$a?->b";
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "NullsafePropertyAccess": {
              "object": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 7,
                  "end": 9,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "property": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 12,
                  "end": 13,
                  "start_line": 3,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 7,
            "end": 13,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 15,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "NullsafeMethodCall": {
              "object": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 15,
                  "end": 17,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "method": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 20,
                  "end": 21,
                  "start_line": 4,
                  "start_col": 5
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "c"
                    },
                    "span": {
                      "start": 22,
                      "end": 24,
                      "start_line": 4,
                      "start_col": 7
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 22,
                    "end": 24,
                    "start_line": 4,
                    "start_col": 7
                  }
                }
              ]
            }
          },
          "span": {
            "start": 15,
            "end": 25,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 15,
        "end": 27,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "NullsafePropertyAccess": {
              "object": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 31,
                        "end": 33,
                        "start_line": 5,
                        "start_col": 4
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 27,
                  "end": 33,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "property": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 36,
                  "end": 37,
                  "start_line": 5,
                  "start_col": 9
                }
              }
            }
          },
          "span": {
            "start": 27,
            "end": 37,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 27,
        "end": 39,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "NullsafePropertyAccess": {
                      "object": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 41,
                          "end": 43,
                          "start_line": 6,
                          "start_col": 2
                        }
                      },
                      "property": {
                        "kind": {
                          "Identifier": "b"
                        },
                        "span": {
                          "start": 46,
                          "end": 47,
                          "start_line": 6,
                          "start_col": 7
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 41,
                    "end": 47,
                    "start_line": 6,
                    "start_col": 2
                  }
                }
              }
            ]
          },
          "span": {
            "start": 39,
            "end": 49,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 39,
        "end": 51,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "Variable": "a"
                  },
                  "span": {
                    "start": 52,
                    "end": 54,
                    "start_line": 7,
                    "start_col": 1
                  }
                }
              },
              {
                "Literal": "?->b"
              }
            ]
          },
          "span": {
            "start": 51,
            "end": 59,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 51,
        "end": 60,
        "start_line": 7,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60,
    "start_line": 1,
    "start_col": 0
  }
}
