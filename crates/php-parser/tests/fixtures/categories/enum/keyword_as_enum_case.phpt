===source===
<?php enum Suit { case for; case function; case match; }
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
                "Case": {
                  "name": {
                    "name": "for",
                    "span": {
                      "start": 23,
                      "end": 26
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 27
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "function",
                    "span": {
                      "start": 33,
                      "end": 41
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 28,
                "end": 42
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "match",
                    "span": {
                      "start": 48,
                      "end": 53
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 43,
                "end": 54
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 56
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56
  }
}
