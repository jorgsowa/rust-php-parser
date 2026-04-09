===source===
<?php

if ($a) $A;
elseif ($b) $B;
else $C;

for (;;) $foo;

foreach ($a as $b) $AB;

while ($a) $A;

do $A; while ($a);

declare (a='b') $C;
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 11,
              "end": 13,
              "start_line": 3,
              "start_col": 4
            }
          },
          "then_branch": {
            "kind": {
              "Expression": {
                "kind": {
                  "Variable": "A"
                },
                "span": {
                  "start": 15,
                  "end": 17,
                  "start_line": 3,
                  "start_col": 8
                }
              }
            },
            "span": {
              "start": 15,
              "end": 19,
              "start_line": 3,
              "start_col": 8
            }
          },
          "elseif_branches": [
            {
              "condition": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 27,
                  "end": 29,
                  "start_line": 4,
                  "start_col": 8
                }
              },
              "body": {
                "kind": {
                  "Expression": {
                    "kind": {
                      "Variable": "B"
                    },
                    "span": {
                      "start": 31,
                      "end": 33,
                      "start_line": 4,
                      "start_col": 12
                    }
                  }
                },
                "span": {
                  "start": 31,
                  "end": 35,
                  "start_line": 4,
                  "start_col": 12
                }
              },
              "span": {
                "start": 26,
                "end": 35,
                "start_line": 4,
                "start_col": 7
              }
            }
          ],
          "else_branch": {
            "kind": {
              "Expression": {
                "kind": {
                  "Variable": "C"
                },
                "span": {
                  "start": 40,
                  "end": 42,
                  "start_line": 5,
                  "start_col": 5
                }
              }
            },
            "span": {
              "start": 40,
              "end": 45,
              "start_line": 5,
              "start_col": 5
            }
          }
        }
      },
      "span": {
        "start": 7,
        "end": 45,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "For": {
          "init": [],
          "condition": [],
          "update": [],
          "body": {
            "kind": {
              "Expression": {
                "kind": {
                  "Variable": "foo"
                },
                "span": {
                  "start": 54,
                  "end": 58,
                  "start_line": 7,
                  "start_col": 9
                }
              }
            },
            "span": {
              "start": 54,
              "end": 61,
              "start_line": 7,
              "start_col": 9
            }
          }
        }
      },
      "span": {
        "start": 45,
        "end": 61,
        "start_line": 7,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 70,
              "end": 72,
              "start_line": 9,
              "start_col": 9
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 76,
              "end": 78,
              "start_line": 9,
              "start_col": 15
            }
          },
          "body": {
            "kind": {
              "Expression": {
                "kind": {
                  "Variable": "AB"
                },
                "span": {
                  "start": 80,
                  "end": 83,
                  "start_line": 9,
                  "start_col": 19
                }
              }
            },
            "span": {
              "start": 80,
              "end": 86,
              "start_line": 9,
              "start_col": 19
            }
          }
        }
      },
      "span": {
        "start": 61,
        "end": 86,
        "start_line": 9,
        "start_col": 0
      }
    },
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 93,
              "end": 95,
              "start_line": 11,
              "start_col": 7
            }
          },
          "body": {
            "kind": {
              "Expression": {
                "kind": {
                  "Variable": "A"
                },
                "span": {
                  "start": 97,
                  "end": 99,
                  "start_line": 11,
                  "start_col": 11
                }
              }
            },
            "span": {
              "start": 97,
              "end": 102,
              "start_line": 11,
              "start_col": 11
            }
          }
        }
      },
      "span": {
        "start": 86,
        "end": 102,
        "start_line": 11,
        "start_col": 0
      }
    },
    {
      "kind": {
        "DoWhile": {
          "body": {
            "kind": {
              "Expression": {
                "kind": {
                  "Variable": "A"
                },
                "span": {
                  "start": 105,
                  "end": 107,
                  "start_line": 13,
                  "start_col": 3
                }
              }
            },
            "span": {
              "start": 105,
              "end": 109,
              "start_line": 13,
              "start_col": 3
            }
          },
          "condition": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 116,
              "end": 118,
              "start_line": 13,
              "start_col": 14
            }
          }
        }
      },
      "span": {
        "start": 102,
        "end": 122,
        "start_line": 13,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "a",
              {
                "kind": {
                  "String": "b"
                },
                "span": {
                  "start": 133,
                  "end": 136,
                  "start_line": 15,
                  "start_col": 11
                }
              }
            ]
          ],
          "body": {
            "kind": {
              "Expression": {
                "kind": {
                  "Variable": "C"
                },
                "span": {
                  "start": 138,
                  "end": 140,
                  "start_line": 15,
                  "start_col": 16
                }
              }
            },
            "span": {
              "start": 138,
              "end": 141,
              "start_line": 15,
              "start_col": 16
            }
          }
        }
      },
      "span": {
        "start": 122,
        "end": 141,
        "start_line": 15,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 141,
    "start_line": 1,
    "start_col": 0
  }
}
