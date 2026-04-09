===source===
<?php

6.674_083e-11;
299_792_458;
0x7AFE_F00D;
0b0101_1111;
0137_041;

// already a valid constant name
_100;

// syntax errors
100_;
1__1;
1_.0;
1._0;
0x_123;
0b_101;
1_e2;
1e_2;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Float": 6.674083e-11
          },
          "span": {
            "start": 7,
            "end": 20,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 22,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 299792458
          },
          "span": {
            "start": 22,
            "end": 33,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 22,
        "end": 35,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 2063527949
          },
          "span": {
            "start": 35,
            "end": 46,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 35,
        "end": 48,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 95
          },
          "span": {
            "start": 48,
            "end": 59,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 48,
        "end": 61,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 48673
          },
          "span": {
            "start": 61,
            "end": 69,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 61,
        "end": 105,
        "start_line": 7,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "_100"
          },
          "span": {
            "start": 105,
            "end": 109,
            "start_line": 10,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 105,
        "end": 129,
        "start_line": 10,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 0
          },
          "span": {
            "start": 129,
            "end": 133,
            "start_line": 13,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 129,
        "end": 135,
        "start_line": 13,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 0
          },
          "span": {
            "start": 135,
            "end": 139,
            "start_line": 14,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 135,
        "end": 141,
        "start_line": 14,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 0
          },
          "span": {
            "start": 141,
            "end": 145,
            "start_line": 15,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 141,
        "end": 147,
        "start_line": 15,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 0
          },
          "span": {
            "start": 147,
            "end": 151,
            "start_line": 16,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 147,
        "end": 153,
        "start_line": 16,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 0
          },
          "span": {
            "start": 153,
            "end": 159,
            "start_line": 17,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 153,
        "end": 161,
        "start_line": 17,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 0
          },
          "span": {
            "start": 161,
            "end": 167,
            "start_line": 18,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 161,
        "end": 169,
        "start_line": 18,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 0
          },
          "span": {
            "start": 169,
            "end": 173,
            "start_line": 19,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 169,
        "end": 175,
        "start_line": 19,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 0
          },
          "span": {
            "start": 175,
            "end": 179,
            "start_line": 20,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 175,
        "end": 180,
        "start_line": 20,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 180,
    "start_line": 1,
    "start_col": 0
  }
}
