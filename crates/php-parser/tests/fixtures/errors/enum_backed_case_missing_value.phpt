===source===
<?php
enum Status: string {
    case Active;
    case Inactive = 'inactive';
}
===errors >=8.1===
Case Active of backed enum Status must have a value
===php_error===
PHP Fatal error:  Case Active of backed enum Status must have a value in Standard input code on line 3
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
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 32,
                "end": 44
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Inactive",
                    "span": {
                      "start": 54,
                      "end": 62
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "inactive"
                    },
                    "span": {
                      "start": 65,
                      "end": 75
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 49,
                "end": 76
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 78
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 78
  }
}
