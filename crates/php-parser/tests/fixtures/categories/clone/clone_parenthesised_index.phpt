===source===
<?php
clone($a)["k"];
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Clone": {
              "kind": {
                "ArrayAccess": {
                  "array": {
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
                  "index": {
                    "kind": {
                      "String": "k"
                    },
                    "span": {
                      "start": 16,
                      "end": 19
                    }
                  }
                }
              },
              "span": {
                "start": 11,
                "end": 20
              }
            }
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
