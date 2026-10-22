===source===
<?php enum Suit { use SuitTrait; case Hearts; }
===errors <=8.0===
'enums' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Suit' (T_STRING) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Suit" in Standard input code on line 1
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
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "SuitTrait"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 22,
                        "end": 31
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 18,
                "end": 32
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Hearts",
                    "span": {
                      "start": 38,
                      "end": 44
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 33,
                "end": 45
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}
