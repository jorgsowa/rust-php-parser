===source===
<?php class Foo { const X = 1; public function f() { return self::X; } }
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
                  "name": "X",
                  "visibility": null,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 28,
                      "end": 29,
                      "start_line": 1,
                      "start_col": 28
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 31,
                "start_line": 1,
                "start_col": 18
              }
            },
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
                                  "Identifier": "self"
                                },
                                "span": {
                                  "start": 60,
                                  "end": 64,
                                  "start_line": 1,
                                  "start_col": 60
                                }
                              },
                              "member": "X"
                            }
                          },
                          "span": {
                            "start": 60,
                            "end": 67,
                            "start_line": 1,
                            "start_col": 60
                          }
                        }
                      },
                      "span": {
                        "start": 53,
                        "end": 69,
                        "start_line": 1,
                        "start_col": 53
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 31,
                "end": 71,
                "start_line": 1,
                "start_col": 31
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 72,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 72,
    "start_line": 1,
    "start_col": 0
  }
}
