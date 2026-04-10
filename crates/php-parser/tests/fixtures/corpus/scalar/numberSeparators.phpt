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
===errors===
Invalid numeric literal
Invalid numeric literal
Invalid numeric literal
Invalid numeric literal
Invalid numeric literal
Invalid numeric literal
Invalid numeric literal
Invalid numeric literal
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
            "end": 20
          }
        }
      },
      "span": {
        "start": 7,
        "end": 22
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
            "end": 33
          }
        }
      },
      "span": {
        "start": 22,
        "end": 35
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
            "end": 46
          }
        }
      },
      "span": {
        "start": 35,
        "end": 48
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
            "end": 59
          }
        }
      },
      "span": {
        "start": 48,
        "end": 61
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
            "end": 69
          }
        }
      },
      "span": {
        "start": 61,
        "end": 105
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
            "end": 109
          }
        }
      },
      "span": {
        "start": 105,
        "end": 129
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
            "end": 133
          }
        }
      },
      "span": {
        "start": 129,
        "end": 135
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
            "end": 139
          }
        }
      },
      "span": {
        "start": 135,
        "end": 141
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
            "end": 145
          }
        }
      },
      "span": {
        "start": 141,
        "end": 147
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
            "end": 151
          }
        }
      },
      "span": {
        "start": 147,
        "end": 153
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
            "end": 159
          }
        }
      },
      "span": {
        "start": 153,
        "end": 161
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
            "end": 167
          }
        }
      },
      "span": {
        "start": 161,
        "end": 169
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
            "end": 173
          }
        }
      },
      "span": {
        "start": 169,
        "end": 175
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
            "end": 179
          }
        }
      },
      "span": {
        "start": 175,
        "end": 180
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 180
  }
}
