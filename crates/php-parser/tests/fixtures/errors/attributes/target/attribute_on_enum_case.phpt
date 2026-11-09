===source===
<?php
enum E {
    #[Attribute] case A;
}
===errors <=7.4===
'enums' requires PHP 8.1 or higher
===errors 8.0===
'enums' requires PHP 8.1 or higher
Attribute "Attribute" cannot target class constant (allowed targets: class)
===errors >=8.1===
Attribute "Attribute" cannot target class constant (allowed targets: class)
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Attribute "Attribute" cannot target class constant (allowed targets: class) in Standard input code on line 3
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
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
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
                    "name": "A",
                    "span": {
                      "start": 37,
                      "end": 38
                    }
                  },
                  "value": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Attribute"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 21,
                          "end": 30
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 21,
                        "end": 30
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 19,
                "end": 39
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
