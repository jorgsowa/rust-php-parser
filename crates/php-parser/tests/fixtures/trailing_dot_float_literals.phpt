===source===
<?php 0.; 1.; 42.;
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
            "Float": 1.0
          },
          "span": {
            "start": 10,
            "end": 12
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
            "Float": 42.0
          },
          "span": {
            "start": 14,
            "end": 17
          }
        }
      },
      "span": {
        "start": 14,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
