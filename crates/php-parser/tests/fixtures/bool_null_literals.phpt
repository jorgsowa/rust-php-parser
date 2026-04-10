===source===
<?php true; false; null; TRUE; FALSE; NULL;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Bool": true
          },
          "span": {
            "start": 6,
            "end": 10
          }
        }
      },
      "span": {
        "start": 6,
        "end": 11
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Bool": false
          },
          "span": {
            "start": 12,
            "end": 17
          }
        }
      },
      "span": {
        "start": 12,
        "end": 18
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": "Null",
          "span": {
            "start": 19,
            "end": 23
          }
        }
      },
      "span": {
        "start": 19,
        "end": 24
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Bool": true
          },
          "span": {
            "start": 25,
            "end": 29
          }
        }
      },
      "span": {
        "start": 25,
        "end": 30
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Bool": false
          },
          "span": {
            "start": 31,
            "end": 36
          }
        }
      },
      "span": {
        "start": 31,
        "end": 37
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": "Null",
          "span": {
            "start": 38,
            "end": 42
          }
        }
      },
      "span": {
        "start": 38,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
