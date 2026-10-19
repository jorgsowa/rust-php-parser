===source===
<?php
clone($a)::X;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Clone": {
              "kind": {
                "ClassConstAccess": {
                  "class": {
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
                  "member": {
                    "kind": {
                      "Identifier": "X"
                    },
                    "span": {
                      "start": 17,
                      "end": 18
                    }
                  }
                }
              },
              "span": {
                "start": 11,
                "end": 18
              }
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}
