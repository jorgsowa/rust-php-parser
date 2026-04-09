===source===
<?php

// empty strings
<<<'EOS'
EOS;
<<<EOS
EOS;

// constant encapsed strings
<<<'EOS'
Test '" $a \n
EOS;
<<<EOS
Test '" \$a \n
EOS;

// encapsed strings
<<<EOS
Test $a
EOS;
<<<EOS
Test $a and $b->c test
EOS;

b<<<EOS
Binary
EOS;

<<<EOS
$x\r
EOS;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Nowdoc": {
              "label": "EOS",
              "value": ""
            }
          },
          "span": {
            "start": 24,
            "end": 36,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 24,
        "end": 38,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Heredoc": {
              "label": "EOS",
              "parts": [
                {
                  "Literal": ""
                }
              ]
            }
          },
          "span": {
            "start": 38,
            "end": 48,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 38,
        "end": 80,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Nowdoc": {
              "label": "EOS",
              "value": "Test '\" $a \\n"
            }
          },
          "span": {
            "start": 80,
            "end": 106,
            "start_line": 10,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 80,
        "end": 108,
        "start_line": 10,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Heredoc": {
              "label": "EOS",
              "parts": [
                {
                  "Literal": "Test '\" \\$a \\n"
                }
              ]
            }
          },
          "span": {
            "start": 108,
            "end": 133,
            "start_line": 13,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 108,
        "end": 156,
        "start_line": 13,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Heredoc": {
              "label": "EOS",
              "parts": [
                {
                  "Literal": "Test "
                },
                {
                  "Expr": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 168,
                      "end": 170,
                      "start_line": 19,
                      "start_col": 5
                    }
                  }
                }
              ]
            }
          },
          "span": {
            "start": 156,
            "end": 174,
            "start_line": 18,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 156,
        "end": 176,
        "start_line": 18,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Heredoc": {
              "label": "EOS",
              "parts": [
                {
                  "Literal": "Test "
                },
                {
                  "Expr": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 188,
                      "end": 190,
                      "start_line": 22,
                      "start_col": 5
                    }
                  }
                },
                {
                  "Literal": " and "
                },
                {
                  "Expr": {
                    "kind": {
                      "PropertyAccess": {
                        "object": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 195,
                            "end": 197,
                            "start_line": 22,
                            "start_col": 12
                          }
                        },
                        "property": {
                          "kind": {
                            "Identifier": "c"
                          },
                          "span": {
                            "start": 199,
                            "end": 200,
                            "start_line": 22,
                            "start_col": 16
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 195,
                      "end": 200,
                      "start_line": 22,
                      "start_col": 12
                    }
                  }
                },
                {
                  "Literal": " test"
                }
              ]
            }
          },
          "span": {
            "start": 176,
            "end": 209,
            "start_line": 21,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 176,
        "end": 212,
        "start_line": 21,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Heredoc": {
              "label": "EOS",
              "parts": [
                {
                  "Literal": "Binary"
                }
              ]
            }
          },
          "span": {
            "start": 212,
            "end": 230,
            "start_line": 25,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 212,
        "end": 233,
        "start_line": 25,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Heredoc": {
              "label": "EOS",
              "parts": [
                {
                  "Expr": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 240,
                      "end": 242,
                      "start_line": 30,
                      "start_col": 0
                    }
                  }
                },
                {
                  "Literal": "\r"
                }
              ]
            }
          },
          "span": {
            "start": 233,
            "end": 248,
            "start_line": 29,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 233,
        "end": 249,
        "start_line": 29,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 249,
    "start_line": 1,
    "start_col": 0
  }
}
