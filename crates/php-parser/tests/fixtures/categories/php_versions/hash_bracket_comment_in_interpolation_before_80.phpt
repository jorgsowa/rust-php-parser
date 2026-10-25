===source===
<?php
echo "{$a[1 #[x
]}";
$b = <<<EOT
  {$a #[
  }
  EOT;
===errors >=8.0===
expected ']', found '#['
expected '}', found '#['
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "#[", expecting "]" in Standard input code on line 2
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
                            "start": 13,
                            "end": 15
                          }
                        },
                        "index": {
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
                      "start": 13,
                      "end": 23
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 11,
              "end": 25
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 26
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
                  "start": 27,
                  "end": 29
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Expr": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 42,
                            "end": 44
                          }
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 32,
                  "end": 57
                }
              }
            }
          },
          "span": {
            "start": 27,
            "end": 57
          }
        }
      },
      "span": {
        "start": 27,
        "end": 58
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 58
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
                            "start": 13,
                            "end": 15
                          }
                        },
                        "index": {
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
                      "start": 13,
                      "end": 17
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 11,
              "end": 25
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 26
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
                  "start": 27,
                  "end": 29
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Expr": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 42,
                            "end": 44
                          }
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 32,
                  "end": 57
                }
              }
            }
          },
          "span": {
            "start": 27,
            "end": 57
          }
        }
      },
      "span": {
        "start": 27,
        "end": 58
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 58
  }
}
