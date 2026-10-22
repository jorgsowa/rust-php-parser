===source===
<?php enum Suit { #[Description('Hearts')] case Hearts; }
===errors <=7.4===
'enums' requires PHP 8.1 or higher
'attributes' requires PHP 8.0 or higher
===errors 8.0===
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
                    "name": "Hearts",
                    "span": {
                      "start": 48,
                      "end": 54
                    }
                  },
                  "value": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Description"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 20,
                          "end": 31
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "String": "Hearts"
                              },
                              "span": {
                                "start": 32,
                                "end": 40
                              }
                            }
                          },
                          "span": {
                            "start": 32,
                            "end": 40
                          }
                        }
                      ],
                      "span": {
                        "start": 20,
                        "end": 41
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 43,
                "end": 55
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 57
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 57
  }
}
