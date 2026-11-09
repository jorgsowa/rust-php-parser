===source===
<?php
$y = 2; #[unclosed ?>
<?php
$z = 3;
===errors >=8.0===
expected ']', found '?>'
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";", expecting "]" in Standard input code on line 2
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
                  "Variable": "y"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 2
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
      "kind": "Nop",
      "span": {
        "start": 25,
        "end": 28
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
                  "start": 34,
                  "end": 36
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 3
                },
                "span": {
                  "start": 39,
                  "end": 40
                }
              }
            }
          },
          "span": {
            "start": 34,
            "end": 40
          }
        }
      },
      "span": {
        "start": 34,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
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
                  "Variable": "y"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 2
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
        "start": 14,
        "end": 24
      }
    },
    {
      "kind": "Nop",
      "span": {
        "start": 25,
        "end": 28
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
                  "start": 34,
                  "end": 36
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 3
                },
                "span": {
                  "start": 39,
                  "end": 40
                }
              }
            }
          },
          "span": {
            "start": 34,
            "end": 40
          }
        }
      },
      "span": {
        "start": 34,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
