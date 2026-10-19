===source===
<?php enum Suit { case class; }
===errors >=8.1===
'class' cannot be used as an enum case name
===php_error===
PHP Fatal error:  A class constant must not be called 'class'; it is reserved for class name fetching in Standard input code on line 1
===ast >=8.1===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Suit",
            "span": {
              "start": 11,
              "end": 15
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "class",
                    "span": {
                      "start": 23,
                      "end": 28
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 29
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
