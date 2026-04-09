===source===
<?php class Foo { public function f() { return static::DEFAULT; } }
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
                  "name": "f",
                  "visibility": "Public",
                  "is_static": false,
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
                            "ClassConstAccess": {
                              "class": {
                                "kind": {
                                  "Identifier": "static"
                                },
                                "span": {
                                  "start": 47,
                                  "end": 53,
                                  "start_line": 1,
                                  "start_col": 47
                                }
                              },
                              "member": "DEFAULT"
                            }
                          },
                          "span": {
                            "start": 47,
                            "end": 62,
                            "start_line": 1,
                            "start_col": 47
                          }
                        }
                      },
                      "span": {
                        "start": 40,
                        "end": 64,
                        "start_line": 1,
                        "start_col": 40
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 66,
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
        "end": 67,
        "start_line": 1,
        "start_col": 6
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
