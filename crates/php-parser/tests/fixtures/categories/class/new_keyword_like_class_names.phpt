===source===
<?php
new enum;
new mixed;
new namespace\A;
new \A\fn;
new A\match;
new true;
===errors <=7.4===
'reserved keyword in namespaced name' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'fn' (T_FN), expecting identifier (T_STRING) in Standard input code on line 5
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "enum"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 10,
                      "end": 14
                    }
                  }
                },
                "span": {
                  "start": 10,
                  "end": 14
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 14
          }
        }
      },
      "span": {
        "start": 6,
        "end": 15
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "mixed"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 20,
                      "end": 25
                    }
                  }
                },
                "span": {
                  "start": 20,
                  "end": 25
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 16,
            "end": 25
          }
        }
      },
      "span": {
        "start": 16,
        "end": 26
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "A"
                    ],
                    "kind": "Relative",
                    "span": {
                      "start": 31,
                      "end": 42
                    }
                  }
                },
                "span": {
                  "start": 31,
                  "end": 42
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 27,
            "end": 42
          }
        }
      },
      "span": {
        "start": 27,
        "end": 43
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "A",
                      "fn"
                    ],
                    "kind": "FullyQualified",
                    "span": {
                      "start": 48,
                      "end": 53
                    }
                  }
                },
                "span": {
                  "start": 48,
                  "end": 53
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 44,
            "end": 53
          }
        }
      },
      "span": {
        "start": 44,
        "end": 54
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "A",
                      "match"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 59,
                      "end": 66
                    }
                  }
                },
                "span": {
                  "start": 59,
                  "end": 66
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 55,
            "end": 66
          }
        }
      },
      "span": {
        "start": 55,
        "end": 67
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "true"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 72,
                      "end": 76
                    }
                  }
                },
                "span": {
                  "start": 72,
                  "end": 76
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 68,
            "end": 76
          }
        }
      },
      "span": {
        "start": 68,
        "end": 77
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 77
  }
}
