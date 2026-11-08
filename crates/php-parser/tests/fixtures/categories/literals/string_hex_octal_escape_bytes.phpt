===description===
Hex and octal escapes are single bytes, which need not be valid UTF-8; an overflowing octal escape keeps its low byte.
===source===
<?php
"\xff";
"a\x80b";
"\377\0";
"\400\501";
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": {
              "bytes": [
                255
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 12
          }
        }
      },
      "span": {
        "start": 6,
        "end": 13
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": {
              "bytes": [
                97,
                128,
                98
              ]
            }
          },
          "span": {
            "start": 14,
            "end": 22
          }
        }
      },
      "span": {
        "start": 14,
        "end": 23
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": {
              "bytes": [
                255,
                0
              ]
            }
          },
          "span": {
            "start": 24,
            "end": 32
          }
        }
      },
      "span": {
        "start": 24,
        "end": 33
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "\u0000A"
          },
          "span": {
            "start": 34,
            "end": 44
          }
        }
      },
      "span": {
        "start": 34,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}
