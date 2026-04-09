===config===
min_php=8.1
===source===
<?php enum Color { case Red; public static function default(): self { return self::Red; } }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Color",
          "scalar_type": null,
          "implements": [],
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
                "start": 19,
                "end": 29,
                "start_line": 1,
                "start_col": 19
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "default",
                  "visibility": "Public",
                  "is_static": true,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "self"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 63,
                          "end": 67,
                          "start_line": 1,
                          "start_col": 63
                        }
                      }
                    },
                    "span": {
                      "start": 63,
                      "end": 67,
                      "start_line": 1,
                      "start_col": 63
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "ClassConstAccess": {
                              "class": {
                                "kind": {
                                  "Identifier": "self"
                                },
                                "span": {
                                  "start": 77,
                                  "end": 81,
                                  "start_line": 1,
                                  "start_col": 77
                                }
                              },
                              "member": "Red"
                            }
                          },
                          "span": {
                            "start": 77,
                            "end": 86,
                            "start_line": 1,
                            "start_col": 77
                          }
                        }
                      },
                      "span": {
                        "start": 70,
                        "end": 88,
                        "start_line": 1,
                        "start_col": 70
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 29,
                "end": 90,
                "start_line": 1,
                "start_col": 29
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 91,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 91,
    "start_line": 1,
    "start_col": 0
  }
}
