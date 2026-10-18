===source===
<?php
echo "$a['k'] $a[ 0 ] $a[-x] $a[1.5]";
echo <<<EOT
  $a['k']
  EOT;
===errors===
invalid offset in simple string interpolation
invalid offset in simple string interpolation
invalid offset in simple string interpolation
invalid offset in simple string interpolation
invalid offset in simple string interpolation
===php_error===
PHP Parse error:  syntax error, unexpected string content "", expecting "-" or identifier or variable or number in Standard input code on line 2
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
                            "String": "'k'"
                          },
                          "span": {
                            "start": 15,
                            "end": 18
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 12,
                      "end": 19
                    }
                  }
                },
                {
                  "Literal": " "
                },
                {
                  "Expr": {
                    "kind": {
                      "ArrayAccess": {
                        "array": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 20,
                            "end": 22
                          }
                        },
                        "index": {
                          "kind": {
                            "String": " 0 "
                          },
                          "span": {
                            "start": 23,
                            "end": 26
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 20,
                      "end": 27
                    }
                  }
                },
                {
                  "Literal": " "
                },
                {
                  "Expr": {
                    "kind": {
                      "ArrayAccess": {
                        "array": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 28,
                            "end": 30
                          }
                        },
                        "index": {
                          "kind": {
                            "String": "-x"
                          },
                          "span": {
                            "start": 31,
                            "end": 33
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 28,
                      "end": 34
                    }
                  }
                },
                {
                  "Literal": " "
                },
                {
                  "Expr": {
                    "kind": {
                      "ArrayAccess": {
                        "array": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 35,
                            "end": 37
                          }
                        },
                        "index": {
                          "kind": {
                            "String": "1.5"
                          },
                          "span": {
                            "start": 38,
                            "end": 41
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 35,
                      "end": 42
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 11,
              "end": 43
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 44
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Heredoc": {
                "label": "EOT",
                "parts": [
                  {
                    "Expr": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 59,
                              "end": 61
                            }
                          },
                          "index": {
                            "kind": {
                              "String": "'k'"
                            },
                            "span": {
                              "start": 62,
                              "end": 65
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 59,
                        "end": 66
                      }
                    }
                  }
                ]
              }
            },
            "span": {
              "start": 50,
              "end": 72
            }
          }
        ]
      },
      "span": {
        "start": 45,
        "end": 73
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 73
  }
}
