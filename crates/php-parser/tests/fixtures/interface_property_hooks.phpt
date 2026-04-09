===config===
min_php=8.4
===source===
<?php
interface HasName {
    public string $name { get; }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": "HasName",
          "extends": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": "name",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 37,
                          "end": 43,
                          "start_line": 3,
                          "start_col": 11
                        }
                      }
                    },
                    "span": {
                      "start": 37,
                      "end": 43,
                      "start_line": 3,
                      "start_col": 11
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 52,
                        "end": 57,
                        "start_line": 3,
                        "start_col": 26
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 30,
                "end": 59,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 60,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60,
    "start_line": 1,
    "start_col": 0
  }
}
