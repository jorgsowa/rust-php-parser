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
            "end": 8
          }
        }
      },
      "span": {
        "start": 6,
        "end": 10
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
            "end": 14
          }
        }
      },
      "span": {
        "start": 10,
        "end": 16
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
            "end": 22
          }
        }
      },
      "span": {
        "start": 16,
        "end": 24
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
            "end": 27
          }
        }
      },
      "span": {
        "start": 24,
        "end": 29
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
            "end": 33
          }
        }
      },
      "span": {
        "start": 29,
        "end": 35
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
            "end": 39
          }
        }
      },
      "span": {
        "start": 35,
        "end": 41
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
            "end": 47
          }
        }
      },
      "span": {
        "start": 41,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
