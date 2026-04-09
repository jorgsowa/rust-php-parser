===source===
<?php

if      ($a) {}
elseif  ($b) {}
elseif  ($c) {}
else         {}

if ($a) {} // without else

if      ($a):
elseif  ($b):
elseif  ($c):
else        :
endif;

if ($a): endif; // without else
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
              "start": 16,
              "end": 18,
              "start_line": 3,
              "start_col": 9
            }
          },
          "then_branch": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 20,
              "end": 22,
              "start_line": 3,
              "start_col": 13
            }
          },
          "elseif_branches": [
            {
              "condition": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 32,
                  "end": 34,
                  "start_line": 4,
                  "start_col": 9
                }
              },
              "body": {
                "kind": {
                  "Block": []
                },
                "span": {
                  "start": 36,
                  "end": 38,
                  "start_line": 4,
                  "start_col": 13
                }
              },
              "span": {
                "start": 31,
                "end": 38,
                "start_line": 4,
                "start_col": 8
              }
            },
            {
              "condition": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 48,
                  "end": 50,
                  "start_line": 5,
                  "start_col": 9
                }
              },
              "body": {
                "kind": {
                  "Block": []
                },
                "span": {
                  "start": 52,
                  "end": 54,
                  "start_line": 5,
                  "start_col": 13
                }
              },
              "span": {
                "start": 47,
                "end": 54,
                "start_line": 5,
                "start_col": 8
              }
            }
          ],
          "else_branch": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 68,
              "end": 70,
              "start_line": 6,
              "start_col": 13
            }
          }
        }
      },
      "span": {
        "start": 7,
        "end": 70,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 76,
              "end": 78,
              "start_line": 8,
              "start_col": 4
            }
          },
          "then_branch": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 80,
              "end": 82,
              "start_line": 8,
              "start_col": 8
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 72,
        "end": 82,
        "start_line": 8,
        "start_col": 0
      }
    },
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 109,
              "end": 111,
              "start_line": 10,
              "start_col": 9
            }
          },
          "then_branch": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 100,
              "end": 114,
              "start_line": 10,
              "start_col": 0
            }
          },
          "elseif_branches": [
            {
              "condition": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 123,
                  "end": 125,
                  "start_line": 11,
                  "start_col": 9
                }
              },
              "body": {
                "kind": {
                  "Block": []
                },
                "span": {
                  "start": 122,
                  "end": 128,
                  "start_line": 11,
                  "start_col": 8
                }
              },
              "span": {
                "start": 122,
                "end": 128,
                "start_line": 11,
                "start_col": 8
              }
            },
            {
              "condition": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 137,
                  "end": 139,
                  "start_line": 12,
                  "start_col": 9
                }
              },
              "body": {
                "kind": {
                  "Block": []
                },
                "span": {
                  "start": 136,
                  "end": 142,
                  "start_line": 12,
                  "start_col": 8
                }
              },
              "span": {
                "start": 136,
                "end": 142,
                "start_line": 12,
                "start_col": 8
              }
            }
          ],
          "else_branch": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 100,
              "end": 156,
              "start_line": 10,
              "start_col": 0
            }
          }
        }
      },
      "span": {
        "start": 100,
        "end": 164,
        "start_line": 10,
        "start_col": 0
      }
    },
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 168,
              "end": 170,
              "start_line": 16,
              "start_col": 4
            }
          },
          "then_branch": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 164,
              "end": 173,
              "start_line": 16,
              "start_col": 0
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 164,
        "end": 195,
        "start_line": 16,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 195,
    "start_line": 1,
    "start_col": 0
  }
}
