===source===
<?php
final readonly class Coordinate {
    public function __construct(
        public float $lat,
        public float $lng,
    ) {}
}
===ast >=8.2===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Coordinate",
            "span": {
              "start": 27,
              "end": 37
            }
          },
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
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 60,
                      "end": 71
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "lat",
                        "span": {
                          "start": 94,
                          "end": 98
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "float"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 88,
                              "end": 93
                            }
                          }
                        },
                        "span": {
                          "start": 88,
                          "end": 93
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 81,
                        "end": 98
                      }
                    },
                    {
                      "name": {
                        "name": "lng",
                        "span": {
                          "start": 121,
                          "end": 125
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "float"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 115,
                              "end": 120
                            }
                          }
                        },
                        "span": {
                          "start": 115,
                          "end": 120
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 108,
                        "end": 125
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
                "end": 135
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 21,
        "end": 137
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 137
  }
}
