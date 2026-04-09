===config===
min_php=8.1
===source===
<?php
enum Status: string {
    case Active = 'active';
    case Inactive = 'inactive';
    case Pending = 'pending';
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Status",
          "scalar_type": {
            "parts": [
              "string"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 19,
              "end": 26,
              "start_line": 2,
              "start_col": 13
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
                      "String": "active"
                    },
                    "span": {
                      "start": 46,
                      "end": 54,
                      "start_line": 3,
                      "start_col": 18
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 32,
                "end": 60,
                "start_line": 3,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "Inactive",
                  "value": {
                    "kind": {
                      "String": "inactive"
                    },
                    "span": {
                      "start": 76,
                      "end": 86,
                      "start_line": 4,
                      "start_col": 20
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 60,
                "end": 92,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "Pending",
                  "value": {
                    "kind": {
                      "String": "pending"
                    },
                    "span": {
                      "start": 107,
                      "end": 116,
                      "start_line": 5,
                      "start_col": 19
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 92,
                "end": 118,
                "start_line": 5,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 119,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 119,
    "start_line": 1,
    "start_col": 0
  }
}
