===source===
<?php #[Assert\Range(min: 1, max: 100)] class Foo {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
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
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
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
                  "value": {
                    "kind": {
                      "Int": 100
                    },
                    "span": {
                      "start": 34,
                      "end": 37
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
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
