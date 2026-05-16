===source===
<?php
// PHP: clone ($a->b). Member access has highest precedence after primary.
clone $a->b;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Clone": {
              "kind": {
                "PropertyAccess": {
                  "object": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 87,
                      "end": 89
                    }
                  },
                  "property": {
                    "kind": {
                      "Identifier": "b"
                    },
                    "span": {
                      "start": 91,
                      "end": 92
                    }
                  }
                }
              },
              "span": {
                "start": 87,
                "end": 92
              }
            }
          },
          "span": {
            "start": 81,
            "end": 92
          }
        }
      },
      "span": {
        "start": 81,
        "end": 93
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 93
  }
}
