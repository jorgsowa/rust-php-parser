===config===
min_php=8.1
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
              "end": 23,
              "start_line": 1,
              "start_col": 19
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
                      "end": 40,
                      "start_line": 1,
                      "start_col": 39
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 25,
                "end": 42,
                "start_line": 1,
                "start_col": 25
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
                      "end": 59,
                      "start_line": 1,
                      "start_col": 58
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 42,
                "end": 61,
                "start_line": 1,
                "start_col": 42
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 62,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62,
    "start_line": 1,
    "start_col": 0
  }
}
