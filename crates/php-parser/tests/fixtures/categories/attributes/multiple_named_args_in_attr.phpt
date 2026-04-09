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
                  "end": 20,
                  "start_line": 1,
                  "start_col": 8
                }
              },
              "args": [
                {
                  "name": "min",
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 26,
                      "end": 27,
                      "start_line": 1,
                      "start_col": 26
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 21,
                    "end": 27,
                    "start_line": 1,
                    "start_col": 21
                  }
                },
                {
                  "name": "max",
                  "value": {
                    "kind": {
                      "Int": 100
                    },
                    "span": {
                      "start": 34,
                      "end": 37,
                      "start_line": 1,
                      "start_col": 34
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 29,
                    "end": 37,
                    "start_line": 1,
                    "start_col": 29
                  }
                }
              ],
              "span": {
                "start": 8,
                "end": 38,
                "start_line": 1,
                "start_col": 8
              }
            }
          ]
        }
      },
      "span": {
        "start": 40,
        "end": 52,
        "start_line": 1,
        "start_col": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52,
    "start_line": 1,
    "start_col": 0
  }
}
