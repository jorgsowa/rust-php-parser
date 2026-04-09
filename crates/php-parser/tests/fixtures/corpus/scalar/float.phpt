===source===
<?php

0.0;
0.;
.0;
0e0;
0E0;
0e+0;
0e-0;
30.20e10;
300.200e100;
1e10000;

// various integer -> float overflows
// (all are actually the same number, just in different representations)
18446744073709551615;
0xFFFFFFFFFFFFFFFF;
0xEEEEEEEEEEEEEEEE;
01777777777777777777777;
0177777777777777777777787;
0b1111111111111111111111111111111111111111111111111111111111111111;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Float": 0.0
          },
          "span": {
            "start": 7,
            "end": 10,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 12,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Float": 0.0
          },
          "span": {
            "start": 12,
            "end": 14,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 12,
        "end": 16,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Float": 0.0
          },
          "span": {
            "start": 16,
            "end": 18,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 16,
        "end": 20,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Float": 0.0
          },
          "span": {
            "start": 20,
            "end": 23,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 20,
        "end": 25,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Float": 0.0
          },
          "span": {
            "start": 25,
            "end": 28,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 25,
        "end": 30,
        "start_line": 7,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Float": 0.0
          },
          "span": {
            "start": 30,
            "end": 34,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 30,
        "end": 36,
        "start_line": 8,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Float": 0.0
          },
          "span": {
            "start": 36,
            "end": 40,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 36,
        "end": 42,
        "start_line": 9,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Float": 302000000000.0
          },
          "span": {
            "start": 42,
            "end": 50,
            "start_line": 10,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 42,
        "end": 52,
        "start_line": 10,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Float": 3.002e+102
          },
          "span": {
            "start": 52,
            "end": 63,
            "start_line": 11,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 52,
        "end": 65,
        "start_line": 11,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Float": null
          },
          "span": {
            "start": 65,
            "end": 72,
            "start_line": 12,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 65,
        "end": 186,
        "start_line": 12,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Float": 1.8446744073709552e+19
          },
          "span": {
            "start": 186,
            "end": 206,
            "start_line": 16,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 186,
        "end": 208,
        "start_line": 16,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Float": 1.8446744073709552e+19
          },
          "span": {
            "start": 208,
            "end": 226,
            "start_line": 17,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 208,
        "end": 228,
        "start_line": 17,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Float": 1.7216961135462248e+19
          },
          "span": {
            "start": 228,
            "end": 246,
            "start_line": 18,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 228,
        "end": 248,
        "start_line": 18,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Float": 1.8446744073709552e+19
          },
          "span": {
            "start": 248,
            "end": 271,
            "start_line": 19,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 248,
        "end": 273,
        "start_line": 19,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Float": 1.4757395258967641e+20
          },
          "span": {
            "start": 273,
            "end": 298,
            "start_line": 20,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 273,
        "end": 300,
        "start_line": 20,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Float": 1.8446744073709552e+19
          },
          "span": {
            "start": 300,
            "end": 366,
            "start_line": 21,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 300,
        "end": 367,
        "start_line": 21,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 367,
    "start_line": 1,
    "start_col": 0
  }
}
