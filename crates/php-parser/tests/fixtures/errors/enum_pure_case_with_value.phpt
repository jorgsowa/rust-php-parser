===source===
<?php
enum Direction {
    case North = 1;
    case South;
}
===errors===
Case North of pure enum Direction must not have a value
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Direction",
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "North",
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 40,
                      "end": 41
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 27,
                "end": 42
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "South",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 47,
                "end": 58
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 60
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60
  }
}
===php_error===
PHP Fatal error:  Case North of non-backed enum Direction must not have a value in Standard input code on line 3
