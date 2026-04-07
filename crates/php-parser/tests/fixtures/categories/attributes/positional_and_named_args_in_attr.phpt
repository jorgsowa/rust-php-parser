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
                  "end": 12
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
                      "end": 25
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 13,
                    "end": 25
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
                      "end": 39
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 27,
                    "end": 39
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
                      "end": 51
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 41,
                    "end": 51
                  }
                }
              ],
              "span": {
                "start": 8,
                "end": 52
              }
            }
          ]
        }
      },
      "span": {
        "start": 54,
        "end": 66
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 66
  }
}
