===source===
<?php
enum Color {
    case Red;
    case Green;
    case Blue;
}
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "Color" in Standard input code on line 2
===ast >=8.1===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Color",
            "span": {
              "start": 11,
              "end": 16
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Red",
                    "span": {
                      "start": 28,
                      "end": 31
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 32
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Green",
                    "span": {
                      "start": 42,
                      "end": 47
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 37,
                "end": 48
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Blue",
                    "span": {
                      "start": 58,
                      "end": 62
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 53,
                "end": 63
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 65
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 65
  }
}
