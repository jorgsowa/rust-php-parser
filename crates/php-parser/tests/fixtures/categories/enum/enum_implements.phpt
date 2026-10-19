===config===
min_php=8.1
===source===
<?php enum Color implements HasLabel { case Red; public function label(): string { return 'red'; } }
===ast===
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
          "implements": [
            {
              "parts": [
                "HasLabel"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 28,
                "end": 36
              }
            }
          ],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Red",
                    "span": {
                      "start": 44,
                      "end": 47
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 39,
                "end": 48
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "label",
                    "span": {
                      "start": 65,
                      "end": 70
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 74,
                          "end": 80
                        }
                      }
                    },
                    "span": {
                      "start": 74,
                      "end": 80
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "String": "red"
                          },
                          "span": {
                            "start": 90,
                            "end": 95
                          }
                        }
                      },
                      "span": {
                        "start": 83,
                        "end": 96
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 49,
                "end": 98
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 100
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 100
  }
}
