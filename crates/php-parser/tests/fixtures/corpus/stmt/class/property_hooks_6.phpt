===source===
<?php
class Test
{

    public $foo, $bar { get { return 42; } }

}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Test",
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
                  "name": "foo",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 35,
                "start_line": 5,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "bar",
                  "visibility": null,
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "Return": {
                                "kind": {
                                  "Int": 42
                                },
                                "span": {
                                  "start": 57,
                                  "end": 59,
                                  "start_line": 5,
                                  "start_col": 37
                                }
                              }
                            },
                            "span": {
                              "start": 50,
                              "end": 61,
                              "start_line": 5,
                              "start_col": 30
                            }
                          }
                        ]
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 44,
                        "end": 63,
                        "start_line": 5,
                        "start_col": 24
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 24,
                "end": 66,
                "start_line": 5,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 67,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67,
    "start_line": 1,
    "start_col": 0
  }
}
