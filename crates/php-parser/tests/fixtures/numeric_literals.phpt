===source===
<?php 42; 0xFF; 0b1010; 077; 3.14; 1e10; 2.5e-3;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 42
          },
          "span": {
            "start": 6,
            "end": 8,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 10,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 255
          },
          "span": {
            "start": 10,
            "end": 14,
            "start_line": 1,
            "start_col": 10
          }
        }
      },
      "span": {
        "start": 10,
        "end": 16,
        "start_line": 1,
        "start_col": 10
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 10
          },
          "span": {
            "start": 16,
            "end": 22,
            "start_line": 1,
            "start_col": 16
          }
        }
      },
      "span": {
        "start": 16,
        "end": 24,
        "start_line": 1,
        "start_col": 16
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 63
          },
          "span": {
            "start": 24,
            "end": 27,
            "start_line": 1,
            "start_col": 24
          }
        }
      },
      "span": {
        "start": 24,
        "end": 29,
        "start_line": 1,
        "start_col": 24
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Float": 3.14
          },
          "span": {
            "start": 29,
            "end": 33,
            "start_line": 1,
            "start_col": 29
          }
        }
      },
      "span": {
        "start": 29,
        "end": 35,
        "start_line": 1,
        "start_col": 29
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Float": 10000000000.0
          },
          "span": {
            "start": 35,
            "end": 39,
            "start_line": 1,
            "start_col": 35
          }
        }
      },
      "span": {
        "start": 35,
        "end": 41,
        "start_line": 1,
        "start_col": 35
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Float": 0.0025
          },
          "span": {
            "start": 41,
            "end": 47,
            "start_line": 1,
            "start_col": 41
          }
        }
      },
      "span": {
        "start": 41,
        "end": 48,
        "start_line": 1,
        "start_col": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48,
    "start_line": 1,
    "start_col": 0
  }
}
