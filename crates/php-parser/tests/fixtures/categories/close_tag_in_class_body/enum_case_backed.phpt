===source===
<?php enum E: int { case A = 1 ?><?php case B = 2 ?><?php }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 11,
              "end": 12
            }
          },
          "scalar_type": {
            "parts": [
              "int"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 14,
              "end": 17
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
                      "start": 25,
                      "end": 26
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 29,
                      "end": 30
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 38
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "B",
                    "span": {
                      "start": 44,
                      "end": 45
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 48,
                      "end": 49
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 39,
                "end": 57
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 59
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 59
  }
}
