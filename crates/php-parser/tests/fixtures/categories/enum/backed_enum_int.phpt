===source===
<?php enum Status: int { case Active = 1; case Inactive = 0; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Status",
          "scalar_type": {
            "parts": [
              "int"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 19,
              "end": 23
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "Active",
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 39,
                      "end": 40
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 25,
                "end": 42
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "Inactive",
                  "value": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 58,
                      "end": 59
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 42,
                "end": 61
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 62
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62
  }
}
