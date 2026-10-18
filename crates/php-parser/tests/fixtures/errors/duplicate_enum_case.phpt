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
===php_error===
PHP Fatal error:  Cannot redefine class constant E::A in Standard input code on line 4
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
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 24,
                      "end": 25
                    }
                  },
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
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 36,
                      "end": 37
                    }
                  },
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
