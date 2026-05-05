===config===
min_php=8.3
===source===
<?php
enum Status {
    @invalid1
    case Active;
    @invalid2
    case Inactive;
    @invalid3
    case Pending;
}
===errors===
expected enum member, found '@'
expected enum member, found '@'
expected enum member, found '@'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Status",
          "scalar_type": null,
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
                "start": 38,
                "end": 50
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "Inactive",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 69,
                "end": 83
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "Pending",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 102,
                "end": 115
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 117
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 117
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "@", expecting "function" in Standard input code on line 3
