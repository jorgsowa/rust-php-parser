===config===
min_php=8.4
===source===
<?php class A { public string $x { get { ?> <?php } } }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "A",
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
                "Property": {
                  "name": "x",
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
                          "start": 23,
                          "end": 29,
                          "start_line": 1,
                          "start_col": 23
                        }
                      }
                    },
                    "span": {
                      "start": 23,
                      "end": 29,
                      "start_line": 1,
                      "start_col": 23
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "InlineHtml": " "
                            },
                            "span": {
                              "start": 43,
                              "end": 44,
                              "start_line": 1,
                              "start_col": 43
                            }
                          },
                          {
                            "kind": "Nop",
                            "span": {
                              "start": 50,
                              "end": 51,
                              "start_line": 1,
                              "start_col": 50
                            }
                          }
                        ]
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 35,
                        "end": 52,
                        "start_line": 1,
                        "start_col": 35
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 54,
                "start_line": 1,
                "start_col": 16
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 55,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55,
    "start_line": 1,
    "start_col": 0
  }
}
