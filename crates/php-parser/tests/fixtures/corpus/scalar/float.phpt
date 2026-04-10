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
            "end": 10
          }
        }
      },
      "span": {
        "start": 7,
        "end": 11
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
            "end": 14
          }
        }
      },
      "span": {
        "start": 12,
        "end": 15
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
            "end": 18
          }
        }
      },
      "span": {
        "start": 16,
        "end": 19
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
            "end": 23
          }
        }
      },
      "span": {
        "start": 20,
        "end": 24
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
            "end": 28
          }
        }
      },
      "span": {
        "start": 25,
        "end": 29
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
            "end": 34
          }
        }
      },
      "span": {
        "start": 30,
        "end": 35
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
            "end": 40
          }
        }
      },
      "span": {
        "start": 36,
        "end": 41
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
            "end": 50
          }
        }
      },
      "span": {
        "start": 42,
        "end": 51
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
            "end": 63
          }
        }
      },
      "span": {
        "start": 52,
        "end": 64
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
            "end": 72
          }
        }
      },
      "span": {
        "start": 65,
        "end": 73
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
            "end": 206
          }
        }
      },
      "span": {
        "start": 186,
        "end": 207
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
            "end": 226
          }
        }
      },
      "span": {
        "start": 208,
        "end": 227
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
            "end": 246
          }
        }
      },
      "span": {
        "start": 228,
        "end": 247
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
            "end": 271
          }
        }
      },
      "span": {
        "start": 248,
        "end": 272
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
            "end": 298
          }
        }
      },
      "span": {
        "start": 273,
        "end": 299
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
            "end": 366
          }
        }
      },
      "span": {
        "start": 300,
        "end": 367
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 367
  }
}
