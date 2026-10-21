===source===
<?php
$a = <<<EOTaEOT;
$b = <<<"EOT"a $xbEOT;
$c = <<<'EOT'abEOT;
$d = <<<EOT  a    b {$x}  EOT;
$e = <<<'EOT'  a    b  EOT;
$f = <<<EOT
  a  b
  EOT;
$g = <<<EOT
  a
  b
  EOT;
$h = <<<EOT  a\  EOT;
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
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "a"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
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
                  "start": 25,
                  "end": 27
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "a "
                      },
                      {
                        "Expr": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 41,
                            "end": 43
                          }
                        }
                      },
                      {
                        "Literal": "\rb"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 30,
                  "end": 49
                }
              }
            }
          },
          "span": {
            "start": 25,
            "end": 49
          }
        }
      },
      "span": {
        "start": 25,
        "end": 50
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
                  "start": 51,
                  "end": 53
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Nowdoc": {
                    "label": "EOT",
                    "value": "a\rb"
                  }
                },
                "span": {
                  "start": 56,
                  "end": 72
                }
              }
            }
          },
          "span": {
            "start": 51,
            "end": 72
          }
        }
      },
      "span": {
        "start": 51,
        "end": 73
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
                  "start": 74,
                  "end": 76
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "a\r  b "
                      },
                      {
                        "Expr": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 97,
                            "end": 99
                          }
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 79,
                  "end": 106
                }
              }
            }
          },
          "span": {
            "start": 74,
            "end": 106
          }
        }
      },
      "span": {
        "start": 74,
        "end": 107
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
                  "start": 108,
                  "end": 110
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Nowdoc": {
                    "label": "EOT",
                    "value": "a\r\r  b"
                  }
                },
                "span": {
                  "start": 113,
                  "end": 138
                }
              }
            }
          },
          "span": {
            "start": 108,
            "end": 138
          }
        }
      },
      "span": {
        "start": 108,
        "end": 139
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "f"
                },
                "span": {
                  "start": 140,
                  "end": 142
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "a\rb"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 145,
                  "end": 165
                }
              }
            }
          },
          "span": {
            "start": 140,
            "end": 165
          }
        }
      },
      "span": {
        "start": 140,
        "end": 166
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
                  "start": 167,
                  "end": 169
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "a\r\nb"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 172,
                  "end": 195
                }
              }
            }
          },
          "span": {
            "start": 167,
            "end": 195
          }
        }
      },
      "span": {
        "start": 167,
        "end": 196
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "h"
                },
                "span": {
                  "start": 197,
                  "end": 199
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "a\\"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 202,
                  "end": 219
                }
              }
            }
          },
          "span": {
            "start": 197,
            "end": 219
          }
        }
      },
      "span": {
        "start": 197,
        "end": 220
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 220
  }
}
