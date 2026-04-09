===source===
<?php class Foo { public static function create() { return new static(); } }
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
                "Method": {
                  "name": "create",
                  "visibility": "Public",
                  "is_static": true,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "Identifier": "static"
                                },
                                "span": {
                                  "start": 63,
                                  "end": 69,
                                  "start_line": 1,
                                  "start_col": 63
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 59,
                            "end": 71,
                            "start_line": 1,
                            "start_col": 59
                          }
                        }
                      },
                      "span": {
                        "start": 52,
                        "end": 73,
                        "start_line": 1,
                        "start_col": 52
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 75,
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
        "end": 76,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 76,
    "start_line": 1,
    "start_col": 0
  }
}
