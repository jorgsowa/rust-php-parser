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
              "end": 13
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
                  "end": 17
                }
              }
            },
            "span": {
              "start": 15,
              "end": 18
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
                  "end": 29
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
                      "end": 33
                    }
                  }
                },
                "span": {
                  "start": 31,
                  "end": 34
                }
              },
              "span": {
                "start": 26,
                "end": 34
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
                  "end": 42
                }
              }
            },
            "span": {
              "start": 40,
              "end": 43
            }
          }
        }
      },
      "span": {
        "start": 7,
        "end": 43
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
                  "end": 58
                }
              }
            },
            "span": {
              "start": 54,
              "end": 59
            }
          }
        }
      },
      "span": {
        "start": 45,
        "end": 59
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
              "end": 72
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 76,
              "end": 78
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
                  "end": 83
                }
              }
            },
            "span": {
              "start": 80,
              "end": 84
            }
          }
        }
      },
      "span": {
        "start": 61,
        "end": 84
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
              "end": 95
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
                  "end": 99
                }
              }
            },
            "span": {
              "start": 97,
              "end": 100
            }
          }
        }
      },
      "span": {
        "start": 86,
        "end": 100
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
                  "end": 107
                }
              }
            },
            "span": {
              "start": 105,
              "end": 108
            }
          },
          "condition": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 116,
              "end": 118
            }
          }
        }
      },
      "span": {
        "start": 102,
        "end": 120
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
                  "end": 136
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
                  "end": 140
                }
              }
            },
            "span": {
              "start": 138,
              "end": 141
            }
          }
        }
      },
      "span": {
        "start": 122,
        "end": 141
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 141
  }
}
