===description===
Surrogate code points keep their three UTF-8 bytes.
===source===
<?php
"\u{D800}";
"\u{DFFF}";
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": {
              "bytes": [
                237,
                160,
                128
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": {
              "bytes": [
                237,
                191,
                191
              ]
            }
          },
          "span": {
            "start": 18,
            "end": 28
          }
        }
      },
      "span": {
        "start": 18,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
