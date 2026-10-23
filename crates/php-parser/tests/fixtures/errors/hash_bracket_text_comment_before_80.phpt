===source===
<?php
$x = 1; #[some text]
$y = 2; #[unclosed ?>
<?php
$z = 3;
===errors >=8.0===
expected ']', found identifier
expected ']', found '?>'
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected identifier "text", expecting "]" in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 11,
                  "end": 12
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 12
          }
        }
      },
      "span": {
        "start": 6,
        "end": 13
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "y"
                },
                "span": {
                  "start": 27,
                  "end": 29
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 32,
                  "end": 33
                }
              }
            }
          },
          "span": {
            "start": 27,
            "end": 33
          }
        }
      },
      "span": {
        "start": 27,
        "end": 34
      }
    },
    {
      "kind": "Nop",
      "span": {
        "start": 46,
        "end": 49
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "z"
                },
                "span": {
                  "start": 55,
                  "end": 57
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 3
                },
                "span": {
                  "start": 60,
                  "end": 61
                }
              }
            }
          },
          "span": {
            "start": 55,
            "end": 61
          }
        }
      },
      "span": {
        "start": 55,
        "end": 62
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 11,
                  "end": 12
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 12
          }
        }
      },
      "span": {
        "start": 6,
        "end": 13
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 21,
        "end": 34
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 45,
        "end": 45
      }
    },
    {
      "kind": "Nop",
      "span": {
        "start": 46,
        "end": 49
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "z"
                },
                "span": {
                  "start": 55,
                  "end": 57
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 3
                },
                "span": {
                  "start": 60,
                  "end": 61
                }
              }
            }
          },
          "span": {
            "start": 55,
            "end": 61
          }
        }
      },
      "span": {
        "start": 55,
        "end": 62
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62
  }
}
