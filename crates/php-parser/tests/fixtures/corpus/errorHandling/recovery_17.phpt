===source===
<?php
namespace Foo
use A
use function a
use A\{B}
const A = 1
break
break 2
continue
continue 2
return
return 2
echo $a
unset($a)
throw $x
goto label
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "Foo"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 20,
              "start_line": 2,
              "start_col": 10
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 20,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "A"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 24,
                  "end": 26,
                  "start_line": 3,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 24,
                "end": 26,
                "start_line": 3,
                "start_col": 4
              }
            }
          ]
        }
      },
      "span": {
        "start": 20,
        "end": 26,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Function",
          "uses": [
            {
              "name": {
                "parts": [
                  "a"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 39,
                  "end": 41,
                  "start_line": 4,
                  "start_col": 13
                }
              },
              "alias": null,
              "span": {
                "start": 39,
                "end": 41,
                "start_line": 4,
                "start_col": 13
              }
            }
          ]
        }
      },
      "span": {
        "start": 26,
        "end": 41,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "A",
                  "B"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 45,
                  "end": 49,
                  "start_line": 5,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 48,
                "end": 49,
                "start_line": 5,
                "start_col": 7
              }
            }
          ]
        }
      },
      "span": {
        "start": 41,
        "end": 51,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "A",
            "value": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 61,
                "end": 62,
                "start_line": 6,
                "start_col": 10
              }
            },
            "attributes": [],
            "span": {
              "start": 57,
              "end": 62,
              "start_line": 6,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 51,
        "end": 63,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Break": {
          "kind": "Error",
          "span": {
            "start": 69,
            "end": 74,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 63,
        "end": 69,
        "start_line": 7,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Break": {
          "kind": {
            "Int": 2
          },
          "span": {
            "start": 75,
            "end": 76,
            "start_line": 8,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 69,
        "end": 77,
        "start_line": 8,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Continue": {
          "kind": "Error",
          "span": {
            "start": 86,
            "end": 94,
            "start_line": 10,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 77,
        "end": 86,
        "start_line": 9,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Continue": {
          "kind": {
            "Int": 2
          },
          "span": {
            "start": 95,
            "end": 96,
            "start_line": 10,
            "start_col": 9
          }
        }
      },
      "span": {
        "start": 86,
        "end": 97,
        "start_line": 10,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Return": {
          "kind": "Error",
          "span": {
            "start": 104,
            "end": 110,
            "start_line": 12,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 97,
        "end": 104,
        "start_line": 11,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Return": {
          "kind": {
            "Int": 2
          },
          "span": {
            "start": 111,
            "end": 112,
            "start_line": 12,
            "start_col": 7
          }
        }
      },
      "span": {
        "start": 104,
        "end": 113,
        "start_line": 12,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 118,
              "end": 120,
              "start_line": 13,
              "start_col": 5
            }
          }
        ]
      },
      "span": {
        "start": 113,
        "end": 121,
        "start_line": 13,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 127,
              "end": 129,
              "start_line": 14,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 121,
        "end": 131,
        "start_line": 14,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Throw": {
          "kind": {
            "Variable": "x"
          },
          "span": {
            "start": 137,
            "end": 139,
            "start_line": 15,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 131,
        "end": 140,
        "start_line": 15,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Goto": "label"
      },
      "span": {
        "start": 140,
        "end": 150,
        "start_line": 16,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 150,
    "start_line": 1,
    "start_col": 0
  }
}
