===source===
<?php
"\u{0}";
"\u{10FFFF}";
"\u{80}";
"\u{FF}";
"\u{100}";
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "\u0000"
          },
          "span": {
            "start": 6,
            "end": 13
          }
        }
      },
      "span": {
        "start": 6,
        "end": 14
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "􏿿"
          },
          "span": {
            "start": 15,
            "end": 27
          }
        }
      },
      "span": {
        "start": 15,
        "end": 28
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": ""
          },
          "span": {
            "start": 29,
            "end": 37
          }
        }
      },
      "span": {
        "start": 29,
        "end": 38
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "ÿ"
          },
          "span": {
            "start": 39,
            "end": 47
          }
        }
      },
      "span": {
        "start": 39,
        "end": 48
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "Ā"
          },
          "span": {
            "start": 49,
            "end": 58
          }
        }
      },
      "span": {
        "start": 49,
        "end": 59
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 59
  }
}
