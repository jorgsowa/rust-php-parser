===source===
<?php
if ($a) $A;
elseif ($b) $B;
else $C;
for (;;) $foo;
foreach ($a as $b) $AB;
while ($a) $A;
do $A; while ($a);
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
              "start": 10,
              "end": 12,
              "start_line": 2,
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
                  "start": 14,
                  "end": 16,
                  "start_line": 2,
                  "start_col": 8
                }
              }
            },
            "span": {
              "start": 14,
              "end": 18,
              "start_line": 2,
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
                  "start": 26,
                  "end": 28,
                  "start_line": 3,
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
                      "start": 30,
                      "end": 32,
                      "start_line": 3,
                      "start_col": 12
                    }
                  }
                },
                "span": {
                  "start": 30,
                  "end": 34,
                  "start_line": 3,
                  "start_col": 12
                }
              },
              "span": {
                "start": 25,
                "end": 34,
                "start_line": 3,
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
                  "start": 39,
                  "end": 41,
                  "start_line": 4,
                  "start_col": 5
                }
              }
            },
            "span": {
              "start": 39,
              "end": 43,
              "start_line": 4,
              "start_col": 5
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 43,
        "start_line": 2,
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
                  "start": 52,
                  "end": 56,
                  "start_line": 5,
                  "start_col": 9
                }
              }
            },
            "span": {
              "start": 52,
              "end": 58,
              "start_line": 5,
              "start_col": 9
            }
          }
        }
      },
      "span": {
        "start": 43,
        "end": 58,
        "start_line": 5,
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
              "start": 67,
              "end": 69,
              "start_line": 6,
              "start_col": 9
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 73,
              "end": 75,
              "start_line": 6,
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
                  "start": 77,
                  "end": 80,
                  "start_line": 6,
                  "start_col": 19
                }
              }
            },
            "span": {
              "start": 77,
              "end": 82,
              "start_line": 6,
              "start_col": 19
            }
          }
        }
      },
      "span": {
        "start": 58,
        "end": 82,
        "start_line": 6,
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
              "start": 89,
              "end": 91,
              "start_line": 7,
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
                  "start": 93,
                  "end": 95,
                  "start_line": 7,
                  "start_col": 11
                }
              }
            },
            "span": {
              "start": 93,
              "end": 97,
              "start_line": 7,
              "start_col": 11
            }
          }
        }
      },
      "span": {
        "start": 82,
        "end": 97,
        "start_line": 7,
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
                  "start": 100,
                  "end": 102,
                  "start_line": 8,
                  "start_col": 3
                }
              }
            },
            "span": {
              "start": 100,
              "end": 104,
              "start_line": 8,
              "start_col": 3
            }
          },
          "condition": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 111,
              "end": 113,
              "start_line": 8,
              "start_col": 14
            }
          }
        }
      },
      "span": {
        "start": 97,
        "end": 115,
        "start_line": 8,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 115,
    "start_line": 1,
    "start_col": 0
  }
}
