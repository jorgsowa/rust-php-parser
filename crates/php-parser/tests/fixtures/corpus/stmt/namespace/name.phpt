===source===
<?php

A;
A\B;
\A\B;
namespace\A\B;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "A"
          },
          "span": {
            "start": 7,
            "end": 8
          }
        }
      },
      "span": {
        "start": 7,
        "end": 9
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "A\\B"
          },
          "span": {
            "start": 10,
            "end": 13
          }
        }
      },
      "span": {
        "start": 10,
        "end": 14
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "\\A\\B"
          },
          "span": {
            "start": 15,
            "end": 19
          }
        }
      },
      "span": {
        "start": 15,
        "end": 20
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "namespace\\A\\B"
          },
          "span": {
            "start": 21,
            "end": 34
          }
        }
      },
      "span": {
        "start": 21,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
