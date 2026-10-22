===description===
PHP rejects a redeclared enum case, compared case-insensitively, with "Cannot redefine class constant E::X".
===source===
<?php
enum E {
    case A;
    case A;
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
Cannot redefine class constant E::A
===errors >=8.1===
Cannot redefine class constant E::A
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error >=8.1===
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
