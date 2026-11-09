===source===
<?php
enum E {
    #[Override] case B;
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
===errors 8.3-8.4===
Attribute "Override" cannot target class constant (allowed targets: method)
===errors 8.5===
Attribute "Override" cannot target class constant (allowed targets: method, property)
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error 8.3-8.4===
PHP Fatal error:  Attribute "Override" cannot target class constant (allowed targets: method) in Standard input code on line 3
===php_error 8.5===
PHP Fatal error:  Attribute "Override" cannot target class constant (allowed targets: method, property) in Standard input code on line 3
===ast <=7.4===
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
          "members": [],
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
===ast >=8.0===
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
                    "name": "B",
                    "span": {
                      "start": 36,
                      "end": 37
                    }
                  },
                  "value": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Override"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 21,
                          "end": 29
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 21,
                        "end": 29
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 19,
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
