===config===
min_php=8.2
===source===
<?php
final readonly class Coordinate {
    public function __construct(
        public float $lat,
        public float $lng,
    ) {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Coordinate",
          "modifiers": {
            "is_abstract": false,
            "is_final": true,
            "is_readonly": true
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "__construct",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "lat",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "float"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 88,
                              "end": 93,
                              "start_line": 4,
                              "start_col": 15
                            }
                          }
                        },
                        "span": {
                          "start": 88,
                          "end": 93,
                          "start_line": 4,
                          "start_col": 15
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 81,
                        "end": 98,
                        "start_line": 4,
                        "start_col": 8
                      }
                    },
                    {
                      "name": "lng",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "float"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 115,
                              "end": 120,
                              "start_line": 5,
                              "start_col": 15
                            }
                          }
                        },
                        "span": {
                          "start": 115,
                          "end": 120,
                          "start_line": 5,
                          "start_col": 15
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 108,
                        "end": 125,
                        "start_line": 5,
                        "start_col": 8
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 44,
                "end": 136,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 21,
        "end": 137,
        "start_line": 2,
        "start_col": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 137,
    "start_line": 1,
    "start_col": 0
  }
}
