===source===
<?php
echo "$a[x]", "$a[1]";
===errors >=8.0===
invalid offset in simple string interpolation
invalid offset in simple string interpolation
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected character 0x01, expecting "-" or identifier or variable or number in Standard input code on line 2
===ast <=7.4===
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
                            "String": "x"
                          },
                          "span": {
                            "start": 16,
                            "end": 17
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 12,
                      "end": 18
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 11,
              "end": 19
            }
          },
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
                            "start": 22,
                            "end": 24
                          }
                        },
                        "index": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 25,
                            "end": 26
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 22,
                      "end": 28
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 21,
              "end": 29
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
===ast >=8.0===
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
                            "String": "\u0001x"
                          },
                          "span": {
                            "start": 15,
                            "end": 17
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 12,
                      "end": 18
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 11,
              "end": 19
            }
          },
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
                            "start": 22,
                            "end": 24
                          }
                        },
                        "index": {
                          "kind": {
                            "String": "1\u0002"
                          },
                          "span": {
                            "start": 25,
                            "end": 27
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 22,
                      "end": 28
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 21,
              "end": 29
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
