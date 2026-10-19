===source===
<?php
enum Status: string {
    case Active = 'active';
    case Inactive = 'inactive';
    case Pending = 'pending';
}
===ast >=8.1===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Status",
            "span": {
              "start": 11,
              "end": 17
            }
          },
          "scalar_type": {
            "parts": [
              "string"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 19,
              "end": 25
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Active",
                    "span": {
                      "start": 37,
                      "end": 43
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "active"
                    },
                    "span": {
                      "start": 46,
                      "end": 54
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 32,
                "end": 55
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Inactive",
                    "span": {
                      "start": 65,
                      "end": 73
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "inactive"
                    },
                    "span": {
                      "start": 76,
                      "end": 86
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 60,
                "end": 87
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Pending",
                    "span": {
                      "start": 97,
                      "end": 104
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "pending"
                    },
                    "span": {
                      "start": 107,
                      "end": 116
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 92,
                "end": 117
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 119
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 119
  }
}
