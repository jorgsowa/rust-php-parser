===source===
<?php class Foo extends Bar { public function f() { return parent::VERSION; } }
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
          "extends": {
            "parts": [
              "Bar"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 24,
              "end": 28,
              "start_line": 1,
              "start_col": 24
            }
          },
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
                                  "Identifier": "parent"
                                },
                                "span": {
                                  "start": 59,
                                  "end": 65,
                                  "start_line": 1,
                                  "start_col": 59
                                }
                              },
                              "member": "VERSION"
                            }
                          },
                          "span": {
                            "start": 59,
                            "end": 74,
                            "start_line": 1,
                            "start_col": 59
                          }
                        }
                      },
                      "span": {
                        "start": 52,
                        "end": 76,
                        "start_line": 1,
                        "start_col": 52
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 30,
                "end": 78,
                "start_line": 1,
                "start_col": 30
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 79,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 79,
    "start_line": 1,
    "start_col": 0
  }
}
