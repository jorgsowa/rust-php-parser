===config===
parse_version=8.3
===source===
<?php class Foo { public const string NAME = 'foo'; }
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
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": "NAME",
                  "visibility": "Public",
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 31,
                          "end": 37,
                          "start_line": 1,
                          "start_col": 31
                        }
                      }
                    },
                    "span": {
                      "start": 31,
                      "end": 37,
                      "start_line": 1,
                      "start_col": 31
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "foo"
                    },
                    "span": {
                      "start": 45,
                      "end": 50,
                      "start_line": 1,
                      "start_col": 45
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 52,
                "start_line": 1,
                "start_col": 18
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 53,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53,
    "start_line": 1,
    "start_col": 0
  }
}
