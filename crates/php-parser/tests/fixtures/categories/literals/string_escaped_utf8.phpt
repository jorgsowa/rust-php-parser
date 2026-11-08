===description===
UTF-8 spelled with escapes equals the character; a lone byte does not.
===source===
<?php
"\xc3\xbf";
"\u{ff}";
"\xff";
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "ÿ"
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
            "String": "ÿ"
          },
          "span": {
            "start": 18,
            "end": 26
          }
        }
      },
      "span": {
        "start": 18,
        "end": 27
      }
    },
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
            "start": 28,
            "end": 34
          }
        }
      },
      "span": {
        "start": 28,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
