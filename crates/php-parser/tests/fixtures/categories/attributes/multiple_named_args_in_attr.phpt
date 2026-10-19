===source===
<?php #[Assert\Range(min: 1, max: 100)] class Foo {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 46,
              "end": 49
            }
          },
          "modifiers": {
            "is_abstract": false,
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
                  "Assert",
                  "Range"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 8,
                  "end": 20
                }
              },
              "args": [
                {
                  "name": {
                    "parts": [
                      "min"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 21,
                      "end": 24
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 26,
                        "end": 27
                      }
                    }
                  },
                  "span": {
                    "start": 21,
                    "end": 27
                  }
                },
                {
                  "name": {
                    "parts": [
                      "max"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 29,
                      "end": 32
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 100
                      },
                      "span": {
                        "start": 34,
                        "end": 37
                      }
                    }
                  },
                  "span": {
                    "start": 29,
                    "end": 37
                  }
                }
              ],
              "span": {
                "start": 8,
                "end": 38
              }
            }
          ]
        }
      },
      "span": {
        "start": 40,
        "end": 52
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52
  }
}
