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
                  "end": 9
                }
              },
              "property": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 12,
                  "end": 13
                }
              }
            }
          },
          "span": {
            "start": 7,
            "end": 13
          }
        }
      },
      "span": {
        "start": 7,
        "end": 14
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
                  "end": 17
                }
              },
              "method": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 20,
                  "end": 21
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
                      "end": 24
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 22,
                    "end": 24
                  }
                }
              ]
            }
          },
          "span": {
            "start": 15,
            "end": 25
          }
        }
      },
      "span": {
        "start": 15,
        "end": 26
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
                        "end": 33
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 27,
                  "end": 33
                }
              },
              "property": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 36,
                  "end": 37
                }
              }
            }
          },
          "span": {
            "start": 27,
            "end": 37
          }
        }
      },
      "span": {
        "start": 27,
        "end": 38
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
                          "end": 43
                        }
                      },
                      "property": {
                        "kind": {
                          "Identifier": "b"
                        },
                        "span": {
                          "start": 46,
                          "end": 47
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 41,
                    "end": 47
                  }
                }
              }
            ]
          },
          "span": {
            "start": 39,
            "end": 49
          }
        }
      },
      "span": {
        "start": 39,
        "end": 50
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
                    "end": 54
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
            "end": 59
          }
        }
      },
      "span": {
        "start": 51,
        "end": 60
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60
  }
}
