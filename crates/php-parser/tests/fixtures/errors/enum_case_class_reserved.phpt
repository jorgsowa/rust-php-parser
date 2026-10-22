===source===
<?php enum Suit { case class; }
===errors <=8.0===
'enums' requires PHP 8.1 or higher
'class' cannot be used as an enum case name
===errors >=8.1===
'class' cannot be used as an enum case name
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Suit' (T_STRING) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Suit" in Standard input code on line 1
===php_error >=8.1===
PHP Fatal error:  A class constant must not be called 'class'; it is reserved for class name fetching in Standard input code on line 1
===ast===
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
