===config===
min_php=8.1
===source===
<?php
enum Enum: string {
    case A = "a";
    case B = "b";
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Enum",
          "scalar_type": {
            "parts": [
              "string"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 17,
              "end": 23
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "A",
                  "value": {
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 39,
                      "end": 42
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 30,
                "end": 43
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "B",
                  "value": {
                    "kind": {
                      "String": "b"
                    },
                    "span": {
                      "start": 57,
                      "end": 60
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 48,
                "end": 61
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 63
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63
  }
}
