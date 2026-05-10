===config===
min_php=7.4
===source===
<?php
// Heredoc with multi-byte escape sequences (supports interpolation)
$a = <<<EOT
test\è
EOT;

$b = <<<EOT
prefix {$x["key\è"]} suffix
EOT;

// Multiple escapes
$c = <<<EOT
\è\é\ù mixed
EOT;

// Escaped backslash before multi-byte
$d = <<<EOT
\\è escaped
EOT;
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
                  "start": 75,
                  "end": 77
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "test\\è"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 80,
                  "end": 98
                }
              }
            }
          },
          "span": {
            "start": 75,
            "end": 98
          }
        }
      },
      "span": {
        "start": 75,
        "end": 99
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
                  "start": 101,
                  "end": 103
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "prefix "
                      },
                      {
                        "Expr": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "Variable": "x"
                                },
                                "span": {
                                  "start": 121,
                                  "end": 123
                                }
                              },
                              "index": {
                                "kind": {
                                  "String": "key\\è"
                                },
                                "span": {
                                  "start": 124,
                                  "end": 132
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 121,
                            "end": 133
                          }
                        }
                      },
                      {
                        "Literal": " suffix"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 106,
                  "end": 145
                }
              }
            }
          },
          "span": {
            "start": 101,
            "end": 145
          }
        }
      },
      "span": {
        "start": 101,
        "end": 146
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
                  "start": 168,
                  "end": 170
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "\\è\\é\\ù mixed"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 173,
                  "end": 199
                }
              }
            }
          },
          "span": {
            "start": 168,
            "end": 199
          }
        }
      },
      "span": {
        "start": 168,
        "end": 200
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
                  "start": 241,
                  "end": 243
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "\\è escaped"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 246,
                  "end": 269
                }
              }
            }
          },
          "span": {
            "start": 241,
            "end": 269
          }
        }
      },
      "span": {
        "start": 241,
        "end": 270
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 270
  }
}
