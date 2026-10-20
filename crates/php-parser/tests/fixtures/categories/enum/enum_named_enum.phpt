===source===
<?php
enum Enum {
    case A;
    case B;
}
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "Enum" in Standard input code on line 2
===ast >=8.1===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Enum",
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
                    "name": "A",
                    "span": {
                      "start": 27,
                      "end": 28
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 29
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "B",
                    "span": {
                      "start": 39,
                      "end": 40
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 34,
                "end": 41
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
