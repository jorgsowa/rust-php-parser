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
                "end": 37,
                "start_line": 1,
                "start_col": 28
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
                "end": 49,
                "start_line": 1,
                "start_col": 39
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
                          "end": 80,
                          "start_line": 1,
                          "start_col": 74
                        }
                      }
                    },
                    "span": {
                      "start": 74,
                      "end": 80,
                      "start_line": 1,
                      "start_col": 74
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
                            "end": 95,
                            "start_line": 1,
                            "start_col": 90
                          }
                        }
                      },
                      "span": {
                        "start": 83,
                        "end": 97,
                        "start_line": 1,
                        "start_col": 83
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 49,
                "end": 99,
                "start_line": 1,
                "start_col": 49
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 100,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 100,
    "start_line": 1,
    "start_col": 0
  }
}
