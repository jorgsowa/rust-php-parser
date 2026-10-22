===source===
<?php
#[Attribute] abstract class A {}
#[Attribute] interface I {}
#[Attribute] trait T {}
#[Attribute] enum E {}
===errors >=8.5===
Cannot apply #[\Attribute] to abstract class A
Cannot apply #[\Attribute] to interface I
Cannot apply #[\Attribute] to trait T
Cannot apply #[\Attribute] to enum E
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "enum" in Standard input code on line 5
===php_error >=8.5===
PHP Fatal error:  Cannot apply #[\Attribute] to abstract class A in Standard input code on line 2
===ast >=8.4===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 34,
              "end": 35
            }
          },
          "modifiers": {
            "is_abstract": true,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 17
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 17
              }
            }
          ]
        }
      },
      "span": {
        "start": 28,
        "end": 38
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 62,
              "end": 63
            }
          },
          "extends": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 41,
                  "end": 50
                }
              },
              "args": [],
              "span": {
                "start": 41,
                "end": 50
              }
            }
          ]
        }
      },
      "span": {
        "start": 52,
        "end": 66
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 86,
              "end": 87
            }
          },
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 69,
                  "end": 78
                }
              },
              "args": [],
              "span": {
                "start": 69,
                "end": 78
              }
            }
          ]
        }
      },
      "span": {
        "start": 80,
        "end": 90
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 109,
              "end": 110
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 93,
                  "end": 102
                }
              },
              "args": [],
              "span": {
                "start": 93,
                "end": 102
              }
            }
          ]
        }
      },
      "span": {
        "start": 104,
        "end": 113
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 113
  }
}
