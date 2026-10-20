===source===
<?php enum Direction { case North; case South; case East; case West; }
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "Direction" in Standard input code on line 1
===ast >=8.1===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Direction",
            "span": {
              "start": 11,
              "end": 20
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "North",
                    "span": {
                      "start": 28,
                      "end": 33
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 34
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "South",
                    "span": {
                      "start": 40,
                      "end": 45
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 35,
                "end": 46
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "East",
                    "span": {
                      "start": 52,
                      "end": 56
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 47,
                "end": 57
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "West",
                    "span": {
                      "start": 63,
                      "end": 67
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 58,
                "end": 68
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 70
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 70
  }
}
