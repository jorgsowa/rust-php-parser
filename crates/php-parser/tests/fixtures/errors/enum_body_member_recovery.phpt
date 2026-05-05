===config===
min_php=8.3
===source===
<?php
enum Status {
    @invalid
    case Active;
    case Inactive;
}
===errors===
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
                "start": 37,
                "end": 49
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
                "start": 54,
                "end": 68
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 70
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 70
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "@", expecting "function" in Standard input code on line 3
