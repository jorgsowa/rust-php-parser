===source===
<?php
enum Enum: string {
    case A = "a";
    case B = "b";
}
===ast >=8.1===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Enum",
            "span": {
              "start": 11,
              "end": 15
            }
          },
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
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 35,
                      "end": 36
                    }
                  },
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
                  "name": {
                    "name": "B",
                    "span": {
                      "start": 53,
                      "end": 54
                    }
                  },
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
