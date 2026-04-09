===source===
<?php #[Attr('positional', key: 'value', flag: true)] class Foo {}
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
                  "Attr"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 12,
                  "start_line": 1,
                  "start_col": 8
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "String": "positional"
                    },
                    "span": {
                      "start": 13,
                      "end": 25,
                      "start_line": 1,
                      "start_col": 13
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 13,
                    "end": 25,
                    "start_line": 1,
                    "start_col": 13
                  }
                },
                {
                  "name": "key",
                  "value": {
                    "kind": {
                      "String": "value"
                    },
                    "span": {
                      "start": 32,
                      "end": 39,
                      "start_line": 1,
                      "start_col": 32
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 27,
                    "end": 39,
                    "start_line": 1,
                    "start_col": 27
                  }
                },
                {
                  "name": "flag",
                  "value": {
                    "kind": {
                      "Bool": true
                    },
                    "span": {
                      "start": 47,
                      "end": 51,
                      "start_line": 1,
                      "start_col": 47
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 41,
                    "end": 51,
                    "start_line": 1,
                    "start_col": 41
                  }
                }
              ],
              "span": {
                "start": 8,
                "end": 52,
                "start_line": 1,
                "start_col": 8
              }
            }
          ]
        }
      },
      "span": {
        "start": 54,
        "end": 66,
        "start_line": 1,
        "start_col": 54
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 66,
    "start_line": 1,
    "start_col": 0
  }
}
