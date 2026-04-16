===source===
<?php

$i = 0;
while

$j = 1;
$k = 2;
===errors===
expected '(', found variable
unclosed '')'' opened at Span { start: 22, end: 24 }
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
                  "Variable": "i"
                },
                "span": {
                  "start": 7,
                  "end": 9
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 12,
                  "end": 13
                }
              }
            }
          },
          "span": {
            "start": 7,
            "end": 13
          }
        }
      },
      "span": {
        "start": 7,
        "end": 14
      }
    },
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Assign": {
                "target": {
                  "kind": {
                    "Variable": "j"
                  },
                  "span": {
                    "start": 22,
                    "end": 24
                  }
                },
                "op": "Assign",
                "value": {
                  "kind": {
                    "Int": 1
                  },
                  "span": {
                    "start": 27,
                    "end": 28
                  }
                }
              }
            },
            "span": {
              "start": 22,
              "end": 28
            }
          },
          "body": {
            "kind": "Nop",
            "span": {
              "start": 28,
              "end": 29
            }
          }
        }
      },
      "span": {
        "start": 15,
        "end": 29
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "k"
                },
                "span": {
                  "start": 30,
                  "end": 32
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 35,
                  "end": 36
                }
              }
            }
          },
          "span": {
            "start": 30,
            "end": 36
          }
        }
      },
      "span": {
        "start": 30,
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected variable "$j", expecting "(" in Standard input code on line 6
