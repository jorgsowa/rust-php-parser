===source===
<?php class Foo { public static $x = 1; public function f() { return self::$x; } }
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
                "Property": {
                  "name": "x",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": true,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 37,
                      "end": 38,
                      "start_line": 1,
                      "start_col": 37
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 38,
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
                            "StaticPropertyAccess": {
                              "class": {
                                "kind": {
                                  "Identifier": "self"
                                },
                                "span": {
                                  "start": 69,
                                  "end": 73,
                                  "start_line": 1,
                                  "start_col": 69
                                }
                              },
                              "member": "x"
                            }
                          },
                          "span": {
                            "start": 69,
                            "end": 77,
                            "start_line": 1,
                            "start_col": 69
                          }
                        }
                      },
                      "span": {
                        "start": 62,
                        "end": 79,
                        "start_line": 1,
                        "start_col": 62
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 40,
                "end": 81,
                "start_line": 1,
                "start_col": 40
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 82,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 82,
    "start_line": 1,
    "start_col": 0
  }
}
