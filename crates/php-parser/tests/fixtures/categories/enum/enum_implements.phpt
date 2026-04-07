===source===
<?php enum Color implements HasLabel { case Red; public function label(): string { return 'red'; } }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Color",
          "scalar_type": null,
          "implements": [
            {
              "parts": [
                "HasLabel"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 28,
                "end": 37
              }
            }
          ],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "Red",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 39,
                "end": 49
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "label",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
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
                        "end": 97
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 49,
                "end": 99
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
