===source===
<?php enum Suit: string { const TOTAL = 4; case Hearts = 'H'; }
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
          "scalar_type": {
            "parts": [
              "string"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 17,
              "end": 23
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "TOTAL",
                    "span": {
                      "start": 32,
                      "end": 37
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 4
                    },
                    "span": {
                      "start": 40,
                      "end": 41
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 26,
                "end": 42
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Hearts",
                    "span": {
                      "start": 48,
                      "end": 54
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "H"
                    },
                    "span": {
                      "start": 57,
                      "end": 60
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 43,
                "end": 61
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 63
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63
  }
}
