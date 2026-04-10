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
              "end": 12
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
                  "end": 16
                }
              }
            },
            "span": {
              "start": 14,
              "end": 17
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
                  "end": 28
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
                      "end": 32
                    }
                  }
                },
                "span": {
                  "start": 30,
                  "end": 33
                }
              },
              "span": {
                "start": 25,
                "end": 33
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
                  "end": 41
                }
              }
            },
            "span": {
              "start": 39,
              "end": 42
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 42
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
                  "end": 56
                }
              }
            },
            "span": {
              "start": 52,
              "end": 57
            }
          }
        }
      },
      "span": {
        "start": 43,
        "end": 57
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
              "end": 69
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 73,
              "end": 75
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
                  "end": 80
                }
              }
            },
            "span": {
              "start": 77,
              "end": 81
            }
          }
        }
      },
      "span": {
        "start": 58,
        "end": 81
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
              "end": 91
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
                  "end": 95
                }
              }
            },
            "span": {
              "start": 93,
              "end": 96
            }
          }
        }
      },
      "span": {
        "start": 82,
        "end": 96
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
                  "end": 102
                }
              }
            },
            "span": {
              "start": 100,
              "end": 103
            }
          },
          "condition": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 111,
              "end": 113
            }
          }
        }
      },
      "span": {
        "start": 97,
        "end": 115
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 115
  }
}
