===source===
<?php enum Suit { #[Description('Hearts')] case Hearts; }
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "Suit" in Standard input code on line 1
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
