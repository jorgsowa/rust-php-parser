===config===
min_php=8.1
===source===
<?php
enum Status: string {
    case Active;
    case Inactive = 'inactive';
}
===errors===
Case Active of backed enum Status must have a value
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
              "end": 25
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "Active",
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
                  "name": "Inactive",
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
===php_error===
PHP Fatal error:  Case Active of backed enum Status must have a value in Standard input code on line 3
