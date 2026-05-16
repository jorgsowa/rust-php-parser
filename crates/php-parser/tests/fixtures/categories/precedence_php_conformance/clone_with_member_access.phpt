===description===
PHP: clone ($a->b). Member access has highest precedence after primary.
===source===
<?php
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
                      "start": 12,
                      "end": 14
                    }
                  },
                  "property": {
                    "kind": {
                      "Identifier": "b"
                    },
                    "span": {
                      "start": 16,
                      "end": 17
                    }
                  }
                }
              },
              "span": {
                "start": 12,
                "end": 17
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
