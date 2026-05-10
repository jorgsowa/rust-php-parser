===config===
min_php=7.4
===source===
<?php
$a = <<<EOT
    test\è with indent
    EOT;

$b = <<<EOT
    multi-line {$x["key\è"]}
    content \é here
    EOT;

$c = <<<'EOT'
    indented nowdoc \è literal
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
                        "Literal": "test\\è with indent"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 49
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 49
          }
        }
      },
      "span": {
        "start": 6,
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
                  "Variable": "b"
                },
                "span": {
                  "start": 52,
                  "end": 54
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "multi-line "
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
                                  "start": 80,
                                  "end": 82
                                }
                              },
                              "index": {
                                "kind": {
                                  "String": "key\\è"
                                },
                                "span": {
                                  "start": 83,
                                  "end": 91
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 80,
                            "end": 92
                          }
                        }
                      },
                      {
                        "Literal": "\ncontent \\é here"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 57,
                  "end": 122
                }
              }
            }
          },
          "span": {
            "start": 52,
            "end": 122
          }
        }
      },
      "span": {
        "start": 52,
        "end": 123
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
                  "start": 125,
                  "end": 127
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Nowdoc": {
                    "label": "EOT",
                    "value": "indented nowdoc \\è literal"
                  }
                },
                "span": {
                  "start": 130,
                  "end": 178
                }
              }
            }
          },
          "span": {
            "start": 125,
            "end": 178
          }
        }
      },
      "span": {
        "start": 125,
        "end": 179
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 179
  }
}
