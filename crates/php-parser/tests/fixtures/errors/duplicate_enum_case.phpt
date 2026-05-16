===description===
PHP rejects redeclared enum cases with
"Cannot redefine class constant E::X". Detection is case-insensitive.
===config===
min_php=8.1
===source===
<?php
enum E {
    case A;
    case A;
}
===errors===
Cannot redefine class constant E::A
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "E",
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "A",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 19,
                "end": 26
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "A",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 31,
                "end": 38
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}
===php_error===
PHP Fatal error:  Cannot redefine class constant E::A in Standard input code on line 4
