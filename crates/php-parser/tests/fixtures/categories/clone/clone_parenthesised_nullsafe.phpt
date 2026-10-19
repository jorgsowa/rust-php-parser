===source===
<?php
clone($a)?->b;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Clone": {
              "kind": {
                "NullsafePropertyAccess": {
                  "object": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 12,
                          "end": 14
                        }
                      }
                    },
                    "span": {
                      "start": 11,
                      "end": 15
                    }
                  },
                  "property": {
                    "kind": {
                      "Identifier": "b"
                    },
                    "span": {
                      "start": 18,
                      "end": 19
                    }
                  }
                }
              },
              "span": {
                "start": 11,
                "end": 19
              }
            }
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
